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
class EShopRequestService extends \SoapClient
{

    /**
     * @var array $classmap The defined classes
     */
    private static $classmap = array (
        'merchant'              => 'MerchantV2',
        'transaction'           => 'TransactionV2',
        'debtor'                => 'DebtorV2',
        'invoiceitem'           => 'InvoiceItemV2',
        'paymentterm'           => 'PaymentTermV2',
        'arrayofterms'          => 'ArrayOfTerms',
        'transactionstatus'     => 'TransactionStatusV2',
        'OrderItem'             => 'OrderItem',
        'arrayoforders'         => 'ArrayOfOrders',
        'CheckResult'           => 'CheckResult',
    );

    /**
     * @param array $options A array of config values
     * @param string $wsdl The wsdl file to use
     */
    public function __construct(array $options = array(), $wsdl = null)
    {
        foreach (self::$classmap as $key => $value) {
            if (!isset($options['classmap'][$key])) {
                $options['classmap'][$key] = $value;
            }
        }
        $options = array_merge(array (
            'features' => 1,
        ), $options);
        if (!$wsdl) {
            $wsdl = 'https://demo-shopssl.swissbilling.ch/wsdl/EShopRequestV2_SSL.wsdl';
        }
        parent::__construct($wsdl, $options);
    }

    /**
     * @param MerchantV2 $merchant
     * @param TransactionV2 $transaction
     * @param DebtorV2 $debtor
     * @param integer $count
     * @param ArrayOfItemsV2 $items - TODO
     * @return TransactionStatusV2
     */
    public function EshopTransactionRequest(MerchantV2 $merchant, TransactionV2 $transaction, DebtorV2 $debtor, $count, /*ArrayOfItemsV2*/ $items)
    {
        return $this->__soapCall('EshopTransactionRequest', array($merchant, $transaction, $debtor, $count, $items));
    }

    /**
     * @param MerchantV2 $merchant
     * @param TransactionV2 $transaction
     * @param DebtorV2 $debtor
     * @param integer $count
     * @param ArrayOfItemsV2 $items - TODO
     * @return TransactionStatusV2
     */
    public function EshopTransactionDirect(MerchantV2 $merchant, TransactionV2 $transaction, DebtorV2 $debtor, $count, /*ArrayOfItemsV2*/ $items)
    {
        return $this->__soapCall('EshopTransactionDirect', array($merchant, $transaction, $debtor, $count, $items));
    }

    /**
     * @param MerchantV2 $merchant
     * @param string $transaction_ref
     * @param $order_timestamp
     * @return TransactionStatusV2
     */
    public function EshopTransactionCancel(MerchantV2 $merchant, $transaction_ref, $order_timestamp)
    {
        return $this->__soapCall('EshopTransactionCancel', array($merchant, $transaction_ref, $order_timestamp));
    }

    /**
     * @param MerchantV2 $merchant
     * @param string $transaction_ref
     * @param $order_timestamp
     * @return TransactionStatusV2
     */
    public function EshopTransactionAcknowledge(MerchantV2 $merchant, $transaction_ref, $order_timestamp)
    {
        return $this->__soapCall('EshopTransactionAcknowledge', array($merchant, $transaction_ref, $order_timestamp));
    }

    /**
     * @param MerchantV2 $merchant
     * @param string $transaction_ref
     * @param $order_timestamp
     * @return TransactionStatusV2
     */
    public function EshopTransactionConfirmation(MerchantV2 $merchant, $transaction_ref, $order_timestamp)
    {
        return $this->__soapCall('EshopTransactionConfirmation', array($merchant, $transaction_ref, $order_timestamp));
    }

    /**
     * @param MerchantV2 $merchant
     * @param string $transaction_ref
     * @param $order_timestamp
     * @return TransactionStatusV2
     */
    public function EshopTransactionStatusRequest(MerchantV2 $merchant, $transaction_ref, $order_timestamp)
    {
        return $this->__soapCall('EshopTransactionStatusRequest', array($merchant, $transaction_ref, $order_timestamp));
    }

    /**
     * @param MerchantV2 $request
     * @param string $transaction_ref
     * @param $order_timestamp
     * @param float $amount
     * @return TransactionStatusV2
     */
    public function EshopCreditNotification(MerchantV2 $request, $transaction_ref, $order_timestamp, $amount)
    {
        return $this->__soapCall('EshopCreditNotification', array($request, $transaction_ref, $order_timestamp, $amount));
    }

    /**
     * @param MerchantV2 $request
     * @param $startdate
     * @param $enddate
     * @param string $status
     * @return CheckResult
     */
    public function EshopTransactionCheck(MerchantV2 $request, $startdate, $enddate, $status)
    {
        return $this->__soapCall('EshopTransactionCheck', array($request, $startdate, $enddate, $status));
    }

}
