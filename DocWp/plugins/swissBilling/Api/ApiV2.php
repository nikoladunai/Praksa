<?php

require_once __DIR__ . '/v2/autoload.php';

class ApiV2
{
    /** @var WC_Order */
    protected $order;
    protected $config;
    protected $testMode = true;
    protected $wsdlUrl;
    protected $isB2B = false;
    protected $paymentId;

    /** @var arrayofitemsV2 */
    protected $items;
    protected $physicalDelivery = 1;
    /** @var merchantV2 */
    protected $merchant;

    protected $requestParams = ['trace' => 1, 'exceptions' => 1];
    protected $invoiceType;
    protected $successStatus;

    /** @var transactionV2 */
    protected $transaction;
    /** @var debtorV2 */
    protected $debtor;

    protected $swbTransactionId;

    /** @var TransactionStatusValuesV2*/
    protected $swbTransactionStatus;

    protected $swbTransactionTimestemp;
    /**
     * @var string
     */
    protected $FailureTextDebtor;
    /**
     * @var string
     */
    protected $redirectUrl;


    /**
     * ApiV2 constructor.
     * @param $config
     * @param WC_Order $order
     */
    public function __construct($config, $order)
    {
        $this->config = $config;
        $this->order = $order;

        $this->resolveMode();
        $this->resolvePhysDelivery();
        $this->resolveWsdlUrl();
        $this->resolveB2BMode();
        $this->resolveItems();

        if ($this->config['paymentMode'] === 'direct') {
            $this->resolveInvoiceType();
            $this->resolveSuccessStatus();
        }

        $this->makeMerchant();
        $this->makeTransaction();
        $this->makeDebtor();
    }

    public function transactionDirect()
    {
        try {
            $transactionRequest = new EShopRequestService($this->requestParams, $this->wsdlUrl);
            $response = $transactionRequest->EshopTransactionDirect(
                $this->merchant,
                $this->transaction,
                $this->debtor,
                count($this->items),
                $this->items
            );
            if ($response->getStatus() !== $this->successStatus) {
                $messageMerchant = $response->getFailure_text_merchant() . "\n" . $response->getFailure_text_debtor();
                $logger = wc_get_logger();
                $logger->debug($messageMerchant ."\n". var_export([
                    'merchant'    => $this->merchant,
                    'transaction' => $this->merchant,
                    'debtor'      => $this->merchant,
                    'items'       => $this->items
                ],true));
                $this->FailureTextDebtor = strip_tags($response->getFailure_text_debtor());
                return false;
            }
            $this->swbTransactionId = $response->getSwb_transaction_id();
            $this->swbTransactionStatus = $response->getStatus();
            $this->swbTransactionTimestemp = $this->transaction->getOrder_timestamp()->getTimestamp();
            return true;
        } catch (Exception $e) {
            $logger = wc_get_logger();
            $logger->error($e->getMessage());
            return false;
        }
    }


    public function transactionRedirect()
    {
        try {
            $transactionRequest = new EShopRequestService($this->requestParams, $this->wsdlUrl);
            $response = $transactionRequest->EshopTransactionRequest(
                $this->merchant,
                $this->transaction,
                $this->debtor,
                count($this->items),
                $this->items
            );

            if ($response->getStatus() !== transactionStatusValuesV2::Membershipvalidation) {
                $message = $response->getFailure_text_merchant() . "\n" . $response->getFailure_text_debtor() ;
                $logger = wc_get_logger();
                $logger->debug($message . "\n" . var_export([
                    'merchant' => $this->merchant,
                    'transaction' => $this->transaction,
                    'debtor' => $this->debtor,
                    'items' => $this->items,
                ],true));
                return false;
            }

            $this->redirectUrl = $response->getUrl();
            return true;
        } catch (Exception $e) {
            $logger = wc_get_logger();
            $logger->error($e->getMessage());
            return false;
        }
    }

    public function transactionConfirmation($transactionRef, $orderTimestamp)
    {
        $transactionRequest = new EShopRequestService($this->requestParams, $this->wsdlUrl);
        $response = $transactionRequest->EshopTransactionConfirmation($this->merchant, $transactionRef, $orderTimestamp);
        $this->swbTransactionStatus = $response->getStatus();
        return $response;
    }

    public function transactionAcknowledge($transactionRef, $orderTimestamp)
    {
        $transactionRequest = new EShopRequestService($this->requestParams, $this->wsdlUrl);
        $response = $transactionRequest->EshopTransactionAcknowledge($this->merchant, $transactionRef, $orderTimestamp);
        $this->swbTransactionStatus = $response->getStatus();
        return $response;
    }

    public function transactionCancel($transactionRef, $orderTimestamp)
    {
        $transactionRequest = new EShopRequestService($this->requestParams, $this->wsdlUrl);
        $response = $transactionRequest->EshopTransactionCancel($this->merchant, $transactionRef, $orderTimestamp);
        $this->swbTransactionStatus = $response->getStatus();
        return $response;
    }

    public function transactionStatusRequest($transactionRef, $orderTimestamp)
    {
        $transactionRequest = new EShopRequestService($this->requestParams, $this->wsdlUrl);
        $response = $transactionRequest->EshopTransactionStatusRequest($this->merchant, $transactionRef, $orderTimestamp);
        return $response->getStatus();
    }



    protected function resolveMode()
    {
        if ($this->config['testmode'] === "no") {
            $this->testMode = false;
        }
    }

    protected function resolveWsdlUrl()
    {
        $schema = 'https';

        if ($this->testMode) {
            $this->wsdlUrl = $schema . '://sr-pp.swissbilling.ch/EShopRequestV2StdSec.wsdl';
        } else {
            $this->wsdlUrl = $schema . '://secure.safebill.ch/EShopRequestV2StdSec.wsdl';
        }
    }

    protected function resolveB2BMode()
    {
        if ($this->config['enableB2B'] === "yes") {
            $company = $this->order->get_billing_company();
            if (!empty($company)) {
                $this->isB2B = true;
            }
        }
    }

    protected function resolveInvoiceType()
    {
        $typeFromPost = $_POST['swissbilling_invoice'][0];

        if (!in_array($typeFromPost, ['email', 'post'])) {
            $typeFromPost = 'email';
        }

        $this->invoiceType = ($typeFromPost === 'email') ? 1 : 0;
    }

    protected function resolveSuccessStatus()
    {
        if ($this->config['successStatus'] == 'answered') {
            $this->successStatus = transactionStatusValuesV2::Answered;
        } else {
            $this->successStatus = transactionStatusValuesV2::Acknowledged;
        }
    }

    protected function resolveItems()
    {
        $items = [];

        if (!empty($this->order->get_items())) {
            //reset(WC_Tax::get_rates($item->get_product()->get_tax_class()))['rate']
            /** @var WC_Order_Item_Product $item */
            foreach ($this->order->get_items() as $item) {
                $product = $item->get_product();
                $withTax = (float)wc_get_price_including_tax($product);
                $taxAmount = $withTax - (float)wc_get_price_excluding_tax($product);

                $taxInfo = WC_Tax::get_rates($product->get_tax_class());
                $taxPercent = !empty(reset($taxInfo)['rate']) ? reset($taxInfo)['rate'] : 0.00;

                $invoiceItem = new InvoiceItemV2();
                $invoiceItem->setQuantity($item->get_quantity());
                $invoiceItem->setUnit_price($withTax);
                $invoiceItem->setVAT_rate($taxPercent);
                $invoiceItem->setVAT_amount($taxAmount);
                $invoiceItem->setShort_desc($product->get_name());
                $invoiceItem->setDesc($product->get_description());
                $items[] = $invoiceItem;
            }
        }

        $this->items = $items;
    }

    protected function resolvePhysDelivery()
    {
        if (!empty($this->order->get_items())) {

            /** @var WC_Order_Item_Product $item */
            foreach ($this->order->get_items() as $item) {
                $product = $item->get_product();
                if ($product->get_virtual() || $product->get_downloadable()) {
                    $this->physicalDelivery = false;
                }
            }
        }
    }

    protected function resolveCouponDiscount()
    {
        $totalDiscount = 0.0;
        foreach ($this->order->get_used_coupons() as $coupon_name) {

            // Retrieving the coupon ID
            $coupon_post_obj = get_page_by_title($coupon_name, OBJECT, 'shop_coupon');
            $coupon_id = $coupon_post_obj->ID;

            // Get an instance of WC_Coupon object in an array(necesary to use WC_Coupon methods)
            $coupons_obj = new WC_Coupon($coupon_id);
            $totalDiscount += $coupons_obj->get_amount();
        }
        return $totalDiscount;
    }

    protected function resolveDebtorIp()
    {
        if ($this->testMode) {
            return '5.44.112.65';
        } else {
            return $_SERVER['REMOTE_ADDR'];
        }
    }

    protected function resolveLanguage()
    {
        $swbLanguage = !empty($this->config['swisbillingLanguage']) ? $this->config['swisbillingLanguage'] : '';

        switch ($swbLanguage) {
            case 'fr':
                return 'FR';
            case 'de':
                return 'DE';
            case 'stl':
                $locale = get_locale();
                $localeParts = explode('_', $locale);
                return $localeParts[0] == 'de' ? 'DE' : 'FR';
            default:
                return 'DE';
        }
    }

    protected function makeTransaction()
    {
        try {
            $dateTime = new DateTime('now');
            $dateTime->setTimezone(new DateTimeZone('Europe/Paris'));
            /** @var TransactionTypeV2 $transType */
            $transType = transactionTypeV2::Real;

            $amount = (float)$this->order->get_total();
            $deliveryAmount = (float)$this->order->get_shipping_total() + (float)$this->order->get_shipping_tax();
            $vatAmount = (float)$this->order->get_total_tax();
            $discountWithTax = (float)$this->order->get_discount_total() + (float)$this->order->get_discount_tax();

            /** @var deliveryStatusV2 $deliveryStatus */
            $deliveryStatus = deliveryStatusV2::pending;

            $transaction = new transactionV2();
            $transaction->setType($transType);
            $transaction->setIs_B2B($this->isB2B);
            $transaction->setOrder_timestamp($dateTime);
            $transaction->setAmount($amount);
            $transaction->setVAT_amount($vatAmount);
            $transaction->setAdmin_fee_amount(0.00);//todo EVALUATE AND SET THIS ADMIN FEE (HARDCODED VALUE)
            $transaction->setDelivery_fee_amount($deliveryAmount);
            $transaction->setCoupon_discount_amount($discountWithTax);
            $transaction->setVol_discount(0.00);
            $transaction->setPhys_delivery($this->physicalDelivery);
            $transaction->setDelivery_status($deliveryStatus);
            $transaction->setCurrency(get_option('woocommerce_currency')); //or $this->order->get_currency()
            $transaction->setDebtor_IP($this->resolveDebtorIp());
            $transaction->setEshop_ID($this->config['shopId']);
            $transaction->setEshop_ref($this->order->get_order_key());
            $transaction->setIs_DirectInvoiceByEmail($this->invoiceType);
            $transaction->setDirectSuccessStatus($this->successStatus);

            $this->transaction = $transaction;
        } catch (Exception $e) {
            $this->transaction = null;
            $logger = wc_get_logger();
            $logger->error($e->getMessage());
        }
    }

    protected function makeDebtor()
    {
        $debtor = new debtorV2();

        $debtor->setCompany_name($this->order->get_billing_company());
        $debtor->setFirstname($this->order->get_billing_first_name());
        $debtor->setLastname($this->order->get_billing_last_name());
        $debtor->setBirthdate(!empty($_POST['billing_birth_date']) ? $_POST['billing_birth_date'] : null);
        $debtor->setAdr1($this->order->get_billing_address_1());
        $debtor->setAdr2($this->order->get_billing_address_2());
        $debtor->setZip($this->order->get_billing_postcode());
        $debtor->setCity($this->order->get_billing_city());
        $debtor->setCountry($this->order->get_billing_country());
        $debtor->setEmail($this->order->get_billing_email());
        $debtor->setPhone($this->order->get_billing_phone());
        $debtor->setUser_ID($this->order->get_user_id());
        $debtor->setLanguage($this->resolveLanguage());

        $debtor->setDeliv_company_name($this->order->get_shipping_company());
        $debtor->setDeliv_title($this->order->get_shipping_method());
        $debtor->setDeliv_firstname($this->order->get_shipping_first_name());
        $debtor->setDeliv_lastname($this->order->get_shipping_last_name());
        $debtor->setDeliv_adr1($this->order->get_shipping_address_1());
        $debtor->setDeliv_adr2($this->order->get_shipping_address_2());
        $debtor->setDeliv_city($this->order->get_shipping_city());
        $debtor->setDeliv_country($this->order->get_shipping_country());
        $debtor->setDeliv_zip($this->order->get_shipping_postcode());

        $this->debtor = $debtor;
    }

    protected function makeMerchant()
    {
        $merchant = new merchantV2();
        $merchant->setId($this->config['merchantId']);
        $merchant->setPwd($this->config['merchantPassword']);

        $merchant->setSuccess_url(wc()->api_request_url("swissbilling_success"));
        $merchant->setCancel_url(wc()->api_request_url("swissbilling_error") );
        $merchant->setError_url(wc()->api_request_url("swissbilling_cancel") );

        $this->merchant = $merchant;
    }

    /**
     * @return mixed
     */
    public function getSwbTransactionId()
    {
        return $this->swbTransactionId;
    }

    /**
     * @return TransactionStatusValuesV2
     */
    public function getSwbTransactionStatus()
    {
        return $this->swbTransactionStatus;
    }

    /**
     * @return mixed
     */
    public function getSwbTransactionTimestemp()
    {
        return $this->swbTransactionTimestemp;
    }

    /**
     * @return string
     */
    public function getFailureTextDebtor()
    {
        return $this->FailureTextDebtor;
    }

    /**
     * @return string
     */
    public function getRedirectUrl()
    {
        return $this->redirectUrl;
    }
}