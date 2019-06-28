<?php
/*
 * Plugin Name: WooCommerce Swissbilling
 * Plugin URI:
 * Description: Payment plugin for WooCommerce.
 * Author: Tech Swissbilling <tech@swissbilling.ch>
 * Author URI: https://www.swissbilling.ch/
 * Text Domain: swissbilling-gateway
 * Version: 1.0.1
 */
require 'Api/ApiV3.php';
require 'Api/ApiV2.php';

const ORDER_STATUS_PROCESSING = 'processing';
const ORDER_STATUS_COMPLETED = 'completed';
const ORDER_STATUS_CANCELLED = 'cancelled';


add_filter( 'woocommerce_payment_gateways', 'swissbillingAddGatewayClass' );
function swissbillingAddGatewayClass( $gateways ) {
    $gateways[] = 'SwissBillingPayment';
    return $gateways;
}

add_action('plugins_loaded', 'swissbillingInitGatewayClass');
function swissbillingInitGatewayClass()
{
    $pluginRelPath = plugin_basename( dirname( __FILE__ ) ) . '/languages';
    load_plugin_textdomain( 'swissbilling-gateway', false, $pluginRelPath );
    require 'SwissBillingPayment.php';
}

add_filter('woocommerce_available_payment_gateways', 'checkPaymentServiceIsAvailable');
function checkPaymentServiceIsAvailable($available_gateways)
{
    global $woocommerce;

    /** @var WC_Customer $customer */
    $customer = $woocommerce->customer;
    $settings = $available_gateways['swissbilling']->settings;

    $billingInfo = [];
    if (!empty($_POST['post_data'])) {
        parse_str($_POST['post_data'], $billingInfo);
    }

    if ($customer->get_billing_country() !== 'CH' || get_option('woocommerce_currency') !== 'CHF') {
        unset($available_gateways['swissbilling']);
        return $available_gateways;
    }

    $firstName = !empty($billingInfo['billing_first_name']) ? $billingInfo['billing_first_name'] : $customer->get_billing_first_name();
    $lastName = !empty($billingInfo['billing_last_name']) ? $billingInfo['billing_last_name'] : $customer->get_billing_last_name();
    $address1 = !empty($billingInfo['billing_address_1']) ? $billingInfo['billing_address_1'] : $customer->get_billing_address();
    $billingPostcode = !empty($billingInfo['billing_postcode']) ? $billingInfo['billing_postcode'] : $customer->get_billing_postcode();
    $billingEmail = !empty($billingInfo['billing_email']) ? $billingInfo['billing_email'] : $customer->get_billing_email();

    if ($settings['enablePreScreening'] == 'yes') {
        if (!empty($firstName) && !empty($lastName) && !empty($address1) && !empty($billingPostcode) && !empty($billingEmail)) {
            $apiClientV3 = new ApiV3($settings, $billingInfo, $woocommerce);
            if (!$apiClientV3->checkPreScreening()) {
                unset($available_gateways['swissbilling']);
            }
        } else {
            unset($available_gateways['swissbilling']);
        }
    }

    return $available_gateways;
};

//this filter allows checkout filed like first/last name, email to initiate pre screening (if it is enabled in config)
add_filter('woocommerce_billing_fields', 'addFieldsForAjaxProcessing');
function addFieldsForAjaxProcessing($fields)
{
    $fields['billing_first_name']['class'][] = 'update_totals_on_change';
    $fields['billing_last_name']['class'][] = 'update_totals_on_change';
    $fields['billing_email']['class'][] = 'update_totals_on_change';
    return $fields;
}

register_activation_hook(__FILE__, 'onActivate');
function onActivate()
{
    global $wpdb;

    $charset_collate = $wpdb->get_charset_collate();

    $create_table_query = "
            CREATE TABLE IF NOT EXISTS `{$wpdb->prefix}swissbilling_order` (
              `trans_id` VARCHAR (255),
              `order_id` VARCHAR (255),
              `status` VARCHAR (255),
              `date` datetime,
              PRIMARY KEY  (trans_id)
            ) $charset_collate;
    ";
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($create_table_query);
}

add_action('woocommerce_order_status_changed', 'processOrderStatusChange', 10, 3);
function processOrderStatusChange($orderId, $oldOrderStatus, $newOrderStatus)
{
    global $wpdb;
    $order = wc_get_order($orderId);

    if (!empty($order) && $order->get_payment_method() == 'swissbilling') {
        $transRef = $order->get_order_key();
        $fromDb = $wpdb->get_row("SELECT * FROM `{$wpdb->prefix}swissbilling_order` WHERE trans_id = '{$transRef}'");
        $settings = wc_get_payment_gateway_by_order($order)->settings;
        $logger = wc_get_logger();

        //to status Acknowledge
        if ($newOrderStatus == ORDER_STATUS_COMPLETED && $fromDb->status !== transactionStatusValuesV2::Acknowledged) {
            $apiClientV2 = new ApiV2($settings, $order);
            $transaction = $apiClientV2->transactionAcknowledge($transRef, $fromDb->date);
            if ($transaction->getStatus() !== transactionStatusValuesV2::Acknowledged) {
                $logger->error("Wrong status for transactionAcknowledge, expected: " . transactionStatusValuesV2::Acknowledged
                               . " Got: ". var_export($transaction->getStatus(), true));
            } else {
                $wpdb->update(
                    $wpdb->prefix . 'swissbilling_order',
                    array('status' => transactionStatusValuesV2::Acknowledged),
                    array('order_id' => $orderId)
                );
            }
        }

        //to status Canceledbymerchant
        if ($newOrderStatus == ORDER_STATUS_CANCELLED && $fromDb->status !== transactionStatusValuesV2::Canceledbymerchant) {
            $apiClientV2 = new ApiV2($settings, $order);
            $transaction = $apiClientV2->transactionCancel($transRef, $fromDb->date);
            if ($transaction->getStatus() !== transactionStatusValuesV2::Acknowledged) {
                $logger->error("Wrong status for transactionCancel, expected: " . transactionStatusValuesV2::Canceledbymerchant
                               . " Got: ". var_export($transaction->getStatus(), true));
            } else {
                $wpdb->update(
                    $wpdb->prefix . 'swissbilling_order',
                    array('status' => transactionStatusValuesV2::Canceledbymerchant),
                    array('order_id' => $orderId)
                );
            }
        }
    }
}