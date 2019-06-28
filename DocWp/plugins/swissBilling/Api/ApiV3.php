<?php

require_once __DIR__ . '/v3/autoload.php';

class ApiV3
{
    protected $config;

    protected $requestParams = ['trace' => 1, 'exceptions' => 1];
    protected $physicalDelivery = 1;
    protected $isB2B = false;
    protected $testMode = true;
    protected $wsdlUrl;
    /** @var WC_Customer */
    protected $customer;
    /** @var WC_Cart */
    protected $cart;
    /** @var merchantV3 */
    protected $merchant;

    /** @var arrayofitemsV3 */
    protected $items;

    protected $billingInfoFromPost;
    /**
     * @var transactionV3
     */
    protected $transaction;
    /**
     * @var debtorV3
     */
    protected $debtor;

    /**
     * ApiV3 constructor.
     * @param $config
     * @param $billingInfoFromPost
     * @param $woocommerce
     */
    public function __construct($config, $billingInfoFromPost, $woocommerce)
    {
        $this->config = $config;
        $this->customer = $woocommerce->customer;
        $this->cart = $woocommerce->cart;
        $this->billingInfoFromPost = $billingInfoFromPost;

        $this->resolveMode();
        $this->resolveWsdlUrl();
        $this->resolveB2BMode();
        $this->resolveItems();
        $this->resolvePhysDelivery();
        $this->makeMerchant();
        $this->makeTransaction();
        $this->makeDebtor();
    }

    public function checkPreScreening()
    {
        try {
            $preScreening = new EshopTransactionPreScreening(
                $this->merchant,
                $this->transaction,
                $this->debtor,
                count($this->items),
                $this->items
            );

            $screeningRequest = new EshopRequestV3($this->requestParams, $this->wsdlUrl);
            $preScreeningResponse = $screeningRequest->EshopTransactionPreScreening($preScreening)
                ->getEshopTransactionPreScreeningResult();

            if ($preScreeningResponse->getStatus() === transactionStatusValuesV3::Failed) {
                $message = $preScreeningResponse->getFailure_text_merchant() . "\n";
                return false;
            }

            return true;
        } catch (Exception $e) {
            $logger = wc_get_logger();
            $logger->error($e->getMessage());
            return false;
        }
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
            $this->wsdlUrl = $schema . '://ws-pp.swissbilling.ch/ws/EshopRequestV3.svc?WSDL';
        } else {
            $this->wsdlUrl = $schema . '://ws.swissbilling.ch/ws/EshopRequestV3.svc?WSDL';
        }
    }

    protected function resolveB2BMode()
    {
        if ($this->config['enableB2B'] === "yes") {
            $company = empty($this->customer->get_billing_company()) ? $this->billingInfoFromPost['billing_company'] : $this->customer->get_billing_company();
            if (!empty($company)) {
                $this->isB2B = true;
            }
        }
    }

    protected function resolveItems()
    {
        $items = [];

        if (isset($this->cart->cart_contents)) {
            foreach ($this->cart->cart_contents as $item) {
                $product = wc_get_product($item['data']->get_id());
                $withTax = (float)wc_get_price_including_tax($product);
                $taxAmount = $withTax - (float)wc_get_price_excluding_tax($product);

                $taxInfo = WC_Tax::get_rates($product->get_tax_class());
                $taxPercent = !empty(reset($taxInfo)['rate']) ? reset($taxInfo)['rate'] : 0.00;

                $invoiceItem = new invoiceitemV3(
                    $item['quantity'],
                    $withTax,
                    $taxPercent,
                    $taxAmount
                );
                $invoiceItem->setShort_desc($product->get_name());
                $invoiceItem->setDesc($product->get_description());
                $items[] = $invoiceItem;
            }
        }

        $this->items = $items;
    }

    public function resolvePhysDelivery()
    {
        if (isset($this->cart->cart_contents)) {
            foreach ($this->cart->cart_contents as $item) {
                if ($item['data']->get_virtual() || $item['data']->get_downloadable()) {
                    $this->physicalDelivery = false;
                }
            }
        }
    }

    protected function makeMerchant()
    {
        $merchant = new merchantV3();
        $merchant->setId($this->config['merchantId']);
        $merchant->setPwd($this->config['merchantPassword']);

        $merchant->setSuccess_url('');
        $merchant->setCancel_url('');
        $merchant->setError_url('');

        $this->merchant = $merchant;
    }

    protected function makeTransaction()
    {
        try {
            $dateTime = new DateTime('now');
            $dateTime->setTimezone(new DateTimeZone('Europe/Paris'));
            if ($this->testMode){
                $transType = transactionTypeV3::Test;
            } else {
                $transType = transactionTypeV3::Real;
            }

            $total = $this->cart->get_totals()['total'];
            $deliveryAmount = (float)$this->cart->get_shipping_total() + (float)$this->cart->get_shipping_tax();
            $vatAmount = (float)$this->cart->get_total_tax();
            $discountWithTax = (float)$this->cart->get_discount_total() + (float)$this->cart->get_discount_tax();

            /** @var deliveryStatusV2 $deliveryStatus */
            $deliveryStatus = deliveryStatusV2::pending;

            $transaction = new transactionV3(
                $transType, //type
                $this->isB2B, //is_B2B
                $dateTime, //order_timestamp
                $total, //amount
                $vatAmount, //vat amount
                0.00, //admin_fee_amount //todo EVALUATE AND SET THIS ADMIN FEE (HARDCODED VALUE)
                $deliveryAmount, //delivery_fee_amount
                $discountWithTax, //coupon_discount_amount
                0.00, //vol_discount
                $this->physicalDelivery, //phys_delivery
                $deliveryStatus //delivery_status
            );

            $transaction->setCurrency(get_option('woocommerce_currency')); //or $this->order->get_currency()
            $transaction->setDebtor_IP($this->resolveDebtorIp());
            $transaction->setEshop_ID($this->config['shopId']);
            //notice order_key is used for eshop ref but order does not exist yet so value is set to payment id ->
            $transaction->setEshop_ref(WC()->session->get('chosen_payment_method'));

            $this->transaction = $transaction;

        } catch (Exception $e) {
            $this->transaction = null;
            $logger = wc_get_logger();
            $logger->error($e->getMessage());
        }
    }

    protected function resolveDebtorIp()
    {
        if ($this->testMode) {
            return '5.44.112.65';
        } else {
            return $_SERVER['REMOTE_ADDR'];
        }
    }

    protected function makeDebtor()
    {
        //billing from post array-
        $billingCompanyFromPost = !empty($this->billingInfoFromPost['billing_company']) ? $this->billingInfoFromPost['billing_company'] : null;
        $billingFirstNameFromPost = !empty($this->billingInfoFromPost['billing_first_name']) ? $this->billingInfoFromPost['billing_first_name'] : null;
        $billingLastNameFromPost = !empty($this->billingInfoFromPost['billing_last_name']) ? $this->billingInfoFromPost['billing_last_name'] : null;
        $billingAddress1FromPost = !empty($this->billingInfoFromPost['billing_address_1']) ? $this->billingInfoFromPost['billing_address_1'] : null;
        $billingAddress2FromPost = !empty($this->billingInfoFromPost['billing_address_2']) ? $this->billingInfoFromPost['billing_address_2'] : null;
        $billingZipFromPost = !empty($this->billingInfoFromPost['billing_postcode']) ? $this->billingInfoFromPost['billing_postcode'] : null;
        $billingCityFromPost = !empty($this->billingInfoFromPost['billing_city']) ? $this->billingInfoFromPost['billing_city'] : null;
        $billingCountryFromPost = !empty($this->billingInfoFromPost['billing_country']) ? $this->billingInfoFromPost['billing_country'] : null;
        $billingEmailFromPost = !empty($this->billingInfoFromPost['billing_email']) ? $this->billingInfoFromPost['billing_email'] : null;
        $billingPhoneFromPost = !empty($this->billingInfoFromPost['billing_phone']) ? $this->billingInfoFromPost['billing_phone'] : null;

        $billingCountry = empty($this->customer->get_billing_country()) ? $billingCountryFromPost : $this->customer->get_billing_country();

        //shipping from post array
        $shippingCompanyFromPost = !empty($this->billingInfoFromPost['shipping_company']) ? $this->billingInfoFromPost['billing_company'] : null;
        $shippingFirstNameFromPost = !empty($this->billingInfoFromPost['shipping_first_name']) ? $this->billingInfoFromPost['billing_first_name'] : null;
        $shippingLastNameFromPost = !empty($this->billingInfoFromPost['shipping_last_name']) ? $this->billingInfoFromPost['billing_last_name'] : null;
        $shippingAddress1FromPost = !empty($this->billingInfoFromPost['shipping_address_1']) ? $this->billingInfoFromPost['billing_address_1'] : null;
        $shippingAddress2FromPost = !empty($this->billingInfoFromPost['shipping_address_2']) ? $this->billingInfoFromPost['billing_address_2'] : null;
        $shippingZipFromPost = !empty($this->billingInfoFromPost['shipping_postcode']) ? $this->billingInfoFromPost['billing_postcode'] : null;
        $shippingCityFromPost = !empty($this->billingInfoFromPost['shipping_city']) ? $this->billingInfoFromPost['billing_city'] : null;
        $shippingCountryFromPost = !empty($this->billingInfoFromPost['shipping_country']) ? $this->billingInfoFromPost['billing_country'] : null;

        $shippingCountry = empty($this->customer->get_shipping_country()) ? $shippingCountryFromPost : $this->customer->get_shipping_country();

        $debtor = new debtorV3(0);
        $debtor->setCompany_name(empty($this->customer->get_billing_company()) ? $billingCompanyFromPost : $this->customer->get_billing_company());
        $debtor->setFirstname(empty($this->customer->get_billing_first_name()) ? $billingFirstNameFromPost : $this->customer->get_billing_first_name());
        $debtor->setLastname(empty($this->customer->get_billing_last_name()) ? $billingLastNameFromPost : $this->customer->get_billing_last_name());
        $debtor->setBirthdate(!empty($this->billingInfoFromPost['billing_birth_date'])? $this->billingInfoFromPost['billing_birth_date'] : null);
        $debtor->setAdr1(empty($this->customer->get_billing_address_1()) ? $billingAddress1FromPost : $this->customer->get_billing_address_1());
        $debtor->setAdr2(empty($this->customer->get_billing_address_2()) ? $billingAddress2FromPost : $this->customer->get_billing_address_2());
        $debtor->setZip(empty($this->customer->get_billing_postcode()) ? $billingZipFromPost : $this->customer->get_billing_postcode());
        $debtor->setCity(empty($this->customer->get_billing_city()) ? $billingCityFromPost : $this->customer->get_billing_city());
        $debtor->setCountry($billingCountry);
        $debtor->setEmail(empty($this->customer->get_billing_email()) ? $billingEmailFromPost : $this->customer->get_billing_email());
        $debtor->setPhone(empty($this->customer->get_billing_phone()) ? $billingPhoneFromPost : $this->customer->get_billing_phone());
        $debtor->setUser_ID(!empty($this->customer->get_id()) ? $this->customer->get_id() : null);
        $debtor->setLanguage($this->resolveLanguage());

        $debtor->setDeliv_company_name(empty($this->customer->get_shipping_company()) ? $shippingCompanyFromPost : $this->customer->get_shipping_company());
        $debtor->setDeliv_title(""); //todo check this
        $debtor->setDeliv_firstname(empty($this->customer->get_shipping_first_name()) ? $shippingFirstNameFromPost : $this->customer->get_shipping_first_name());
        $debtor->setDeliv_lastname(empty($this->customer->get_shipping_last_name()) ? $shippingLastNameFromPost : $this->customer->get_shipping_last_name());
        $debtor->setDeliv_adr1(empty($this->customer->get_shipping_address_1()) ? $shippingAddress1FromPost : $this->customer->get_shipping_address_1());
        $debtor->setDeliv_adr2(empty($this->customer->get_shipping_address_2()) ? $shippingAddress2FromPost : $this->customer->get_shipping_address_2());
        $debtor->setDeliv_city(empty($this->customer->get_shipping_city()) ? $shippingCityFromPost : $this->customer->get_shipping_city());
        $debtor->setDeliv_country($shippingCountry);
        $debtor->setDeliv_zip(empty($this->customer->get_shipping_postcode()) ? $shippingZipFromPost : $this->customer->get_shipping_postcode());

        $this->debtor = $debtor;
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
}

