<?php

require_once("/app/wp-load.php");

$conf = array();
$conf['enabled'] = "yes";
$conf['title'] = "Swissbilling";
$conf['description'] = "SWISSBILLING";
$conf['testmode'] = "yes";
$conf['enablePreScreening'] = "no";
$conf['paymentMode'] = "redirect";
$conf['enableB2B'] = "no";
$conf['merchantId'] = "201812011_TEST";
$conf['merchantPassword'] = "2El4hMpVedk3NNJ";
$conf['shopId'] = 1;
$conf['emailInvoiceFee'] = "2.90";
$conf['paperInvoiceFee'] = "2.40";
$conf['swisbillingLanguage'] = "de";
$conf['successStatus'] = "answered";

update_option('woocommerce_swissbilling_settings', $conf);

?>