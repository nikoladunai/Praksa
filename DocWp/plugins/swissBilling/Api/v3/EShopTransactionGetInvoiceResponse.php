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
class EShopTransactionGetInvoiceResponse
{
    /**
     * @var GetInvoiceStatus $EShopTransactionGetInvoiceResult
     */
    protected $EShopTransactionGetInvoiceResult = null;

    /**
     * @param GetInvoiceStatus $EShopTransactionGetInvoiceResult
     */
    public function __construct($EShopTransactionGetInvoiceResult)
    {
        $this->EShopTransactionGetInvoiceResult = $EShopTransactionGetInvoiceResult;
    }

    /**
     * @return GetInvoiceStatus
     */
    public function getEShopTransactionGetInvoiceResult()
    {
        return $this->EShopTransactionGetInvoiceResult;
    }

    /**
     * @param GetInvoiceStatus $EShopTransactionGetInvoiceResult
     * @return EShopTransactionGetInvoiceResponse
     */
    public function setEShopTransactionGetInvoiceResult($EShopTransactionGetInvoiceResult)
    {
        $this->EShopTransactionGetInvoiceResult = $EShopTransactionGetInvoiceResult;
        return $this;
    }

}
