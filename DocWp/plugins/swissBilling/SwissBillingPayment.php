<?php

/**
 * Swissbilling Payment Gateway Class
 * Class SwissBillingPayment
 */
class SwissBillingPayment extends WC_Payment_Gateway
{
    /**
     * SwissBillingPayment constructor.
     */
    public function __construct()
    {
        $this->id = 'swissbilling'; // payment gateway plugin ID
        $this->icon = plugins_url('/images/swb_logo.png',__FILE__); // URL of the icon that will be displayed on checkout page near gateway name
        $this->has_fields = false; // custom credit card form
        $this->method_title = 'Swissbilling Gateway';
        $this->method_description =
        '<div>
            <img style="vertical-align:middle" src="http://wp.swissbilling.php.in.rs/wp-content/plugins/swissBilling/images/swb_logo.png">
            <label style="margin-top: 10px"> &nbsp;' . __('Swissbilling Payment plugin for WooCommerce', 'swissbilling-gateway') . '</label>
        </div>';

        $this->supports = array(
            'products'
        );

        // Method with all the options fields
        $this->init_form_fields();

        // Load the settings.
        $this->init_settings();
        $this->title = $this->get_option('title');
        $this->description = $this->get_option('description');
        $this->enabled = $this->get_option('enabled');
        $this->order_button_text    = __('Place order with Swissbilling', 'swissbilling-gateway');

        $this->testmode =  $this->get_option('testmode') === 'yes';
        $this->publishable_key = $this->get_option('merchantId');
        $this->private_key = $this->get_option('merchantPassword');

        // This action hook saves the settings
        add_action('woocommerce_update_options_payment_gateways_' . $this->id, array($this, 'process_admin_options'));

        //Register a webhook
        add_action('woocommerce_api_swissbilling_success', array($this, 'onSuccessRedirect'));
        add_action('woocommerce_api_swissbilling_error', array($this, 'onErrorRedirect'));
        add_action('woocommerce_api_swissbilling_cancel', array($this, 'onCancelRedirect'));
    }

    /**
     * add plugin config options needed for Swissbilling payment
     * user configurable form wordpress backend
     */
    public function init_form_fields()
    {
        $this->form_fields = array(
            'enabled'            => array(
                'title'       => __('Active', 'swissbilling-gateway'),
                'label'       => __('Activate SWISSBILLING Invoice in your shop', 'swissbilling-gateway'),
                'type'        => 'checkbox',
                'description' => '',
                'default'     => 'no'
            ),
            'title'              => array(
                'title'       => __('Title', 'swissbilling-gateway') . " <abbr class=\"required\" title=\"required\">*</abbr>",
                'type'        => 'text',
                'description' => __( 'This controls the title which the user sees during checkout.', 'swissbilling-gateway'),
                'default'     => __('Swissbilling', 'swissbilling-gateway'),
                'desc_tip'    => true,
            ),
            'description'        => array(
                'title'       => __('Description', 'swissbilling-gateway') . " <abbr class=\"required\" title=\"required\">*</abbr>",
                'type'        => 'textarea',
                'css'         => 'width:400px; height: 75px;',
                'description' => __( 'This controls the description which the user sees during checkout.', 'swissbilling-gateway'),
                'default'     => 'SWISSBILLING',
            ),
            'testmode'           => array(
                'title'       => __('Test mode', 'swissbilling-gateway'),
                'label'       => __('Enable Test Mode', 'swissbilling-gateway'),
                'type'        => 'checkbox',
                'description' => __('Place the payment gateway in test mode using test API keys.', 'swissbilling-gateway'),
                'default'     => 'yes',
                'desc_tip'    => true,
            ),
            'enablePreScreening' => array(
                'title'   => __('Pre Screening', 'swissbilling-gateway'),
                'label'   => __('Enable Prescreening', 'swissbilling-gateway'),
                'type'    => 'checkbox',
                'default' => 'yes',
            ),
            'paymentMode'        => array(
                'title'   => __('Payment Mode', 'swissbilling-gateway'),
                'type'    => 'select',
                'class'       => 'wc-enhanced-select',
                'options' => [
                    'direct'   => __('Direct', 'swissbilling-gateway'),
                    'redirect' => __('Redirect', 'swissbilling-gateway')
                ],
                'default' => 'direct',
            ),
            'enableB2B'          => array(
                'title'   => __('Enable B2B Mode', 'swissbilling-gateway'),
                'label'   => __('Is B2B Mode available', 'swissbilling-gateway'),
                'type'    => 'checkbox',
                'default' => 'no',
            ),
            'merchantId'         => array(
                'title' => __('Merchant ID', 'swissbilling-gateway') . " <abbr class=\"required\" title=\"required\">*</abbr>",
                'type'  => 'text'
            ),
            'merchantPassword'   => array(
                'title' => __('Password', 'swissbilling-gateway') . " <abbr class=\"required\" title=\"required\">*</abbr>",
                'type'  => 'password',
            ),
            'shopId'             => array(
                'title'    => __('Shop ID', 'swissbilling-gateway') . " <abbr class=\"required\" title=\"required\">*</abbr>",
                'type'     => 'number',
                'default'  => 1,
                'desc_tip' => false,
            ),
            'emailInvoiceFee'    => array(
                'title'    => __('Email Invoice Fee', 'swissbilling-gateway') . " <abbr class=\"required\" title=\"required\">*</abbr>",
                'type'     => 'text',
                'desc_tip' => false,
            ),
            'paperInvoiceFee'    => array(
                'title'    => __('Paper Invoice Fee', 'swissbilling-gateway') . " <abbr class=\"required\" title=\"required\">*</abbr>",
                'type'     => 'text',
                'desc_tip' => false,
            ),
            'swisbillingLanguage' => array(
                'title'       => __('Invoice langauge', 'swissbilling-gateway'),
                'type'        => 'select',
                'class'       => 'wc-enhanced-select',
                'options'     => [
                    'de'  => __('German', 'swissbilling-gateway'),
                    'fr'  => __('Franch', 'swissbilling-gateway'),
                    'stl' => __('Store Local', 'swissbilling-gateway')
                ],
                'default'     => 'DE',
                'description' => __('Language in which redirect mode swb window will be displayed', 'swissbilling-gateway'),
                'desc_tip'    => true,
            ),
            'successStatus'      => array(
                'title'       => __('Success Status', 'swissbilling-gateway'),
                'type'        => 'select',
                'class'       => 'wc-enhanced-select',
                'options'     => [
                    'answered'     => 'Answered',
                    'acknowledged' => 'Acknowledged'
                ],
                'default'     => 'answered',
                'description' => __(
                    'Expected status on success : “Answered” (the transaction is to be validated) or “Acknowledged” (the transaction is committed and will be generated invoice)',
                    'swissbilling-gateway'
                ),
                'desc_tip'    => true,
            ),
        );
    }

    /**
     * echo's additional description and fields needed for Swissbilling payment on checkout page
     */
    public function payment_fields()
    {
        //echo description defined in backend config for swissbilling
        echo '<p>' . $this->description . '</p>' ;

        //echo terms and conditions checkbox
        echo '</br>
            <p class="form-row custom-checkboxes">
                <label for="swissbilling_terms" class="woocommerce-form__label checkbox swissbilling_terms">
                    <input type="checkbox" required="required" value="1" class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox" name="swissbilling_terms" > '
            . sprintf(
                __("I agree with SWISSBILLING %s terms and conditions. %s", 'swissbilling-gateway'),
                "<a target=\"_blank\" href=\"http://www.swissbilling.ch/FILES/DE/SWB_AGB.pdf\" rel=\"nofollow noopener\">",
                "</a>"
            ) .
            '<span class="required">*</span>
                </label>
            </p>';

        if ($this->get_option('paymentMode') == 'direct') {
            echo '<fieldset id="wc-' . esc_attr($this->id)
                . '-cc-form" class="wc-credit-card-form wc-payment-form" style="background:transparent;">';

            // Add this action hook so custom gateway can support it
            do_action('woocommerce_credit_card_form_start', $this->id);

            echo '<div class="form-row form-row-wide">
                        <label>
                            <input name="swissbilling_invoice[]" id="swissbilling_invoice_email" type="radio" autocomplete="off" 
                            value="email" checked="checked" style="outline-width: 0;"> '
                            . __('Invoice by email.', 'swissbilling-gateway') .' (CHF ' . $this->get_option('emailInvoiceFee') . ')
                        </label> 
                    </div>
                    <div class="form-row form-row-wide">
                        <label>
                            <input name="swissbilling_invoice[]" id="swissbilling_invoice_post" type="radio" autocomplete="off"
                             value="post" style="outline-width: 0;"> '
                            . __('Invoice by post.', 'swissbilling-gateway') . ' (CHF ' . $this->get_option('paperInvoiceFee') . ')
                        </label>
                    </div>
                    <div class="clear"></div>';
            do_action('woocommerce_credit_card_form_end', $this->id);
        }
    }

    /**
     * validates user input after submissions from checkout page
     * @return bool
     */
    public function validate_fields()
    {
        if (empty($_POST['swissbilling_invoice'][0]) && $this->get_option('paymentMode') == 'direct') {
            wc_add_notice(__('Swissbilling invoice type is required!', 'swissbilling-gateway'), 'error');
            return false;
        }

        if (empty($_POST['swissbilling_terms'])) {
            wc_add_notice(__('You must agree with SWISSBILLING terms and conditions if you want to use this payment method.', 'swissbilling-gateway'), 'error');
            return false;
        }

        return true;
    }

    /**
     * process submitted order from checkout page,
     * - if direct mode: makes api call to submit transaction in direct mode and saves order to db if no error occurs,
     * else notice is added to display error to user
     *
     * - if redirect mode: makes api call to submit transaction in redirect mode,
     * onSuccessRedirect or onErrorRedirect or onCancelRedirect hook can be triggered
     * depending of possible redirection from Swissbilling side
     *
     * returns response array described in abstract class
     * @param int $orderId
     * @return array
     */
    public function process_payment($orderId)
    {
        global $woocommerce;
        $order = wc_get_order($orderId);
        $apiClientV2 = new ApiV2($this->settings, $order);

        if ($this->settings['paymentMode'] == 'direct') {
            $transaction = $apiClientV2->transactionDirect();
        } else {
            if ($apiClientV2->transactionRedirect()) {
                //depending of user input onSuccessRedirect/onErrorRedirect/onCancelRedirect hook can be triggered
                return array(
                    'result'   => 'success',
                    'redirect' => $apiClientV2->getRedirectUrl()
                );
            }
            wc_add_notice(__('Oops something went wrong, please try again. (Payment not completed)', 'swissbilling-gateway'), 'error' );
        }

        //!! this part of code is executed only in "direct" mode only ->

        if (empty($transaction)) {
            $message = !empty($apiClientV2->getFailureTextDebtor())
                ? $apiClientV2->getFailureTextDebtor()
                : 'An error has occurred and the order could not be finished.';
            wc_add_notice($message, 'error');
            return [];
        }

        $dateFromTimestamp = date('Y-m-d h:m:s',$apiClientV2->getSwbTransactionTimestemp());
        $transStatus = $apiClientV2->getSwbTransactionStatus();

        $this->saveSwissBillingOrder(
            $apiClientV2->getSwbTransactionId(),
            $orderId,
            $transStatus,
            $dateFromTimestamp
        );

        if ($transStatus == transactionStatusValuesV2::Acknowledged) {
            $order->update_status('completed');
        }

        $order->payment_complete();
        wc_reduce_stock_levels($orderId);
        $woocommerce->cart->empty_cart();

        // Redirect to the thank you page
        return array(
            'result'   => 'success',
            'redirect' => $this->get_return_url($order)
        );
    }

    /**
     * Redirection back from Swissbilling side, on successfully finished transaction (only in redirect mode)
     * validate redirection, conforms transaction, calls transactionAcknowledge if needed, saves order to db
     */
    public function onSuccessRedirect()
    {
        global $woocommerce;
        $transactionRef = $_GET['trans'];
        $orderTimestamp = $_GET['timestamp'];

        if (!empty($transactionRef)) {
            $orderId = wc_get_order_id_by_order_key($transactionRef);
            $order = wc_get_order($orderId);

            if (empty($order) || empty($orderId)) {
                $logger = wc_get_logger();
                $logger->error("Order was not found for trans: $transactionRef and timestamp: $orderTimestamp");
                return;
            }

            $apiClientV2 = new ApiV2($this->settings, $order);

            $communicationResponse = $apiClientV2->transactionConfirmation($transactionRef, $orderTimestamp);
            $status = $communicationResponse->getStatus();

            if ($status !== transactionStatusValuesV2::Answered) {
                wc_add_notice(__('Oops something went wrong, please try again. (Payment not completed)', 'swissbilling-gateway'), 'error' );
                wp_redirect(wc_get_checkout_url());
            }

            if ($this->get_option('successStatus') == 'acknowledged') {
                $apiClientV2->transactionAcknowledge($transactionRef, $orderTimestamp);
                $order->update_status('completed');
            }

            $this->saveSwissBillingOrder(
                $transactionRef,
                $order->get_id(),
                $apiClientV2->getSwbTransactionStatus(),
                $orderTimestamp
            );

            $order->payment_complete();
            wc_reduce_stock_levels($orderId);
            $woocommerce->cart->empty_cart();

            // Redirect to the thank you page
            wp_redirect($order->get_checkout_order_received_url());
        } else {
            wc_add_notice(__('Oops something went wrong, please try again. (Payment not completed)', 'swissbilling-gateway'), 'error');
            wp_redirect(wc_get_checkout_url());
        }
    }

    /**
     * Redirection back from Swissbilling side, when error occures (only in redirect mode)
     * adds notice witch will be previewed to user after error occurs on swissbiling side
     */
    public function onErrorRedirect()
    {
        wc_add_notice(__('Payment was not completed please try again', 'swissbilling-gateway'), 'error' );
        wp_redirect(wc_get_checkout_url());
    }

    /**
     * Redirection back from Swissbilling side, on Cancel action (only in redirect mode)
     * adds notice witch will be previewed to user after user cancels transaction process
     */
    public function onCancelRedirect()
    {
        wc_add_notice(__('Payment was not completed please try again', 'swissbilling-gateway'), 'error' );
        wp_redirect(wc_get_checkout_url());
    }

    /**
     * validate backend admin options for Swissbilling config fields
     * @return bool
     */
    public function process_admin_options()
    {
        $isError = false;

        if (empty($_POST['woocommerce_swissbilling_title'])) {
            WC_Admin_Settings::add_error('Error: Please fill required "Title" field');
            $isError = true;
        }

        if (empty($_POST['woocommerce_swissbilling_description'])) {
            WC_Admin_Settings::add_error('Error: Please fill required "Description" field');
            $isError = true;
        }

        if (empty($_POST['woocommerce_swissbilling_merchantId'])) {
            WC_Admin_Settings::add_error('Error: Please fill required "Merchant ID" field');
            $isError = true;
        }

        if (empty($_POST['woocommerce_swissbilling_merchantPassword'])) {
            WC_Admin_Settings::add_error('Error: Please fill required "Password" field');
            $isError = true;
        }

        if (empty($_POST['woocommerce_swissbilling_shopId'])) {
            WC_Admin_Settings::add_error('Error: Please fill required "Shop ID" field');
            $isError = true;
        }

        if (empty($_POST['woocommerce_swissbilling_emailInvoiceFee'])) {
            WC_Admin_Settings::add_error('Error: Please fill required "Email Invoice Fee" field');
            $isError = true;
        }

        if (empty($_POST['woocommerce_swissbilling_paperInvoiceFee'])) {
            WC_Admin_Settings::add_error('Error: Please fill required "Paper Invoice Fee" field');
            $isError = true;
        }

        if ($isError) {
            return false;
        }

        return parent::process_admin_options();
    }

    /**
     * saves order created with swissbilling payment gateway to database table 'swissbilling_order'
     *
     * @param $transId
     * @param $orderId
     * @param $status
     * @param $date
     */
    protected function saveSwissBillingOrder($transId, $orderId, $status, $date)
    {
        global $wpdb;

        $wpdb->insert(
            $wpdb->prefix . 'swissbilling_order',
            array(
                'trans_id' => $transId,
                'order_id' => $orderId,
                'status' => $status,
                'date' => $date,
            )
        );
    }
}