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
class EshopRequestV3 extends \SoapClient
{
    /**
     * @var array $classmap The defined classes
     */
    private static $classmap = array (
        'EshopTransactionPreScreening'          => '\\EshopTransactionPreScreening',
        'merchant'                              => '\\MerchantV3',
        'transaction'                           => '\\TransactionV3',
        'debtor'                                => '\\DebtorV3',
        'arrayofitems'                          => '\\ArrayOfItemsV3',
        'invoiceitem'                           => '\\InvoiceItemV3',
        'EshopTransactionPreScreeningResponse'  => '\\EshopTransactionPreScreeningResponse',
        'transactionstatus'                     => '\\TransactionStatusV3',
        'paymentterm'                           => '\\PaymentTermV3',
        'EshopTransactionCancel'                => '\\EshopTransactionCancel',
        'EshopTransactionCancelResponse'        => '\\EshopTransactionCancelResponse',
        'EshopTransactionUnCancel'              => '\\EshopTransactionUnCancel',
        'EshopTransactionUnCancelResponse'      => '\\EshopTransactionUnCancelResponse',
        'EshopTransactionAcknowledge'           => '\\EshopTransactionAcknowledge',
        'EshopTransactionAcknowledgeResponse'   => '\\EshopTransactionAcknowledgeResponse',
        'EShopTransactionCreditNote'            => '\\EShopTransactionCreditNote',
        'EShopTransactionCreditNoteResponse'    => '\\EShopTransactionCreditNoteResponse',
        'EShopTransactionUpdate'                => '\\EShopTransactionUpdate',
        'EShopTransactionUpdateResponse'        => '\\EShopTransactionUpdateResponse',
        'EShopTransactionGetInvoice'            => '\\EShopTransactionGetInvoice',
        'EShopTransactionGetInvoiceResponse'    => '\\EShopTransactionGetInvoiceResponse',
        'getinvoicestatus'                      => '\\GetInvoiceStatus',
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
            $wsdl = 'https://demo-wsssl.swissbilling.ch/ws/EshopRequestV3.svc?WSDL';
        }
        parent::__construct($wsdl, $options);
    }

    /**
     * @param EshopTransactionPreScreening $parameters
     * @return EshopTransactionPreScreeningResponse
     */
    public function EshopTransactionPreScreening(EshopTransactionPreScreening $parameters)
    {
        return $this->__soapCall('EshopTransactionPreScreening', array($parameters));
    }

    /**
     * @param EshopTransactionCancel $parameters
     * @return EshopTransactionCancelResponse
     */
    public function EshopTransactionCancel(EshopTransactionCancel $parameters)
    {
        return $this->__soapCall('EshopTransactionCancel', array($parameters));
    }

    /**
     * @param EshopTransactionUnCancel $parameters
     * @return EshopTransactionUnCancelResponse
     */
    public function EshopTransactionUnCancel(EshopTransactionUnCancel $parameters)
    {
        return $this->__soapCall('EshopTransactionUnCancel', array($parameters));
    }

    /**
     * @param EshopTransactionAcknowledge $parameters
     * @return EshopTransactionAcknowledgeResponse
     */
    public function EshopTransactionAcknowledge(EshopTransactionAcknowledge $parameters)
    {
        return $this->__soapCall('EshopTransactionAcknowledge', array($parameters));
    }

    /**
     * @param EShopTransactionCreditNote $parameters
     * @return EShopTransactionCreditNoteResponse
     */
    public function EShopTransactionCreditNote(EShopTransactionCreditNote $parameters)
    {
        return $this->__soapCall('EShopTransactionCreditNote', array($parameters));
    }

    /**
     * @param EShopTransactionUpdate $parameters
     * @return EShopTransactionUpdateResponse
     */
    public function EShopTransactionUpdate(EShopTransactionUpdate $parameters)
    {
        return $this->__soapCall('EShopTransactionUpdate', array($parameters));
    }

    /**
     * @param EShopTransactionGetInvoice $parameters
     * @return EShopTransactionGetInvoiceResponse
     */
    public function EShopTransactionGetInvoice(EShopTransactionGetInvoice $parameters)
    {
        return $this->__soapCall('EShopTransactionGetInvoice', array($parameters));
    }

}
