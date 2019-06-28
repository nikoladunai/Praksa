<?php

function autoloadV3($class)
{
    $classes = array(
        'EshopRequestV3'                        => __DIR__ .'/EshopRequestV3.php',
        'EshopTransactionPreScreening'          => __DIR__ .'/EshopTransactionPreScreening.php',
        'merchantV3'                            => __DIR__ .'/MerchantV3.php',
        'transactionV3'                         => __DIR__ .'/TransactionV3.php',
        'transactionTypeV3'                     => __DIR__ .'/TransactionTypeV3.php',
        'deliveryStatusV3'                      => __DIR__ .'/DeliveryStatusV3.php',
        'debtorV3'                              => __DIR__ .'/DebtorV3.php',
        'arrayofitemsV3'                        => __DIR__ .'/ArrayOfItemsV3.php',
        'invoiceitemV3'                         => __DIR__ .'/InvoiceItemV3.php',
        'imageTypeV3'                           => __DIR__ .'/ImageTypeV3.php',
        'EshopTransactionPreScreeningResponse'  => __DIR__ .'/EshopTransactionPreScreeningResponse.php',
        'TransactionStatusV3'                   => __DIR__ .'/TransactionStatusV3.php',
        'transactionStatusValuesV3'             => __DIR__ .'/TransactionStatusValuesV3.php',
        'transactionActionValuesV3'             => __DIR__ .'/TransactionActionValuesV3.php',
        'paymenttermV3'                         => __DIR__ .'/PaymentTermV3.php',
        'EshopTransactionCancel'                => __DIR__ .'/EshopTransactionCancel.php',
        'EshopTransactionCancelResponse'        => __DIR__ .'/EshopTransactionCancelResponse.php',
        'EshopTransactionUnCancel'              => __DIR__ .'/EshopTransactionUnCancel.php',
        'EshopTransactionUnCancelResponse'      => __DIR__ .'/EshopTransactionUnCancelResponse.php',
        'EshopTransactionAcknowledge'           => __DIR__ .'/EshopTransactionAcknowledge.php',
        'EshopTransactionAcknowledgeResponse'   => __DIR__ .'/EshopTransactionAcknowledgeResponse.php',
        'EShopTransactionCreditNote'            => __DIR__ .'/EShopTransactionCreditNote.php',
        'EShopTransactionCreditNoteResponse'    => __DIR__ .'/EShopTransactionCreditNoteResponse.php',
        'EShopTransactionUpdate'                => __DIR__ .'/EShopTransactionUpdate.php',
        'EShopTransactionUpdateResponse'        => __DIR__ .'/EShopTransactionUpdateResponse.php',
        'EShopTransactionGetInvoice'            => __DIR__ .'/EShopTransactionGetInvoice.php',
        'EShopTransactionGetInvoiceResponse'    => __DIR__ .'/EShopTransactionGetInvoiceResponse.php',
        'getinvoicestatus'                      => __DIR__ .'/GetInvoiceStatus.php'
    );
    if (!empty($classes[$class])) {
        require_once $classes[$class];
    };
}

try {
    spl_autoload_register('autoloadV3', true, true);
} catch (Exception $e) {
}