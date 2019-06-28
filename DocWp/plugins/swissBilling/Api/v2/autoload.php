<?php
/**
 *
 * Swissbilling SA license
 *
 * This source code is owned by Swissbilling SA. You are not allowed to use, copy,
 * distribute, modify it without Swissbilling SA permission.
 *
 * @category   Swissbilling
 * @package    Swissbilling_Payment
 * @copyright  Copyright (c) Copyright 2016 Swissbilling SA (CH).
 * @license    Swissbilling SA license
 * @author     Tech Swissbilling <tech@swissbilling.ch>
 */
function autoloadV2($class)
{
    $classes = array(
        'EShopRequestService'       => __DIR__ .'/EShopRequestService.php',
        'transactionStatusValuesV2' => __DIR__ .'/TransactionStatusValuesV2.php',
        'transactionActionValuesV2' => __DIR__ .'/TransactionActionValuesV2.php',
        'deliveryStatusV2'          => __DIR__ .'/DeliveryStatusV2.php',
        'transactionTypeV2'         => __DIR__ .'/TransactionTypeV2.php',
        'imageTypeV2'               => __DIR__ .'/ImageTypeV2.php',
        'merchantV2'                => __DIR__ .'/MerchantV2.php',
        'transactionV2'             => __DIR__ .'/TransactionV2.php',
        'debtorV2'                  => __DIR__ .'/DebtorV2.php',
        'InvoiceItemV2'             => __DIR__ .'/InvoiceItemV2.php',
        'ArrayOfItemsV2'            => __DIR__ .'/ArrayOfItemsV2.php',
        'paymenttermV2'             => __DIR__ .'/PaymentTermV2.php',
        'arrayofterms'              => __DIR__ .'/ArrayOfTerms.php',
        'TransactionStatusV2'       => __DIR__ .'/TransactionStatusV2.php',
        'OrderItem'                 => __DIR__ .'/OrderItem.php',
        'arrayoforders'             => __DIR__ .'/ArrayOfOrders.php',
        'CheckResult'               => __DIR__ .'/CheckResult.php'
    );
    if (!empty($classes[$class])) {
        require_once $classes[$class];
    };
}

try {
    spl_autoload_register('autoloadV2', true, true);
} catch (Exception $e) {
}
