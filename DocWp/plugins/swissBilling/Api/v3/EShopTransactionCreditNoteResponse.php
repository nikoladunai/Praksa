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
class EShopTransactionCreditNoteResponse
{
    /**
     * @var TransactionStatusV3 $EShopTransactionCreditNoteResult
     */
    protected $EShopTransactionCreditNoteResult = null;

    /**
     * @param TransactionStatusV3 $EShopTransactionCreditNoteResult
     */
    public function __construct($EShopTransactionCreditNoteResult)
    {
        $this->EShopTransactionCreditNoteResult = $EShopTransactionCreditNoteResult;
    }

    /**
     * @return TransactionStatusV3
     */
    public function getEShopTransactionCreditNoteResult()
    {
        return $this->EShopTransactionCreditNoteResult;
    }

    /**
     * @param TransactionStatusV3 $EShopTransactionCreditNoteResult
     * @return EShopTransactionCreditNoteResponse
     */
    public function setEShopTransactionCreditNoteResult($EShopTransactionCreditNoteResult)
    {
        $this->EShopTransactionCreditNoteResult = $EShopTransactionCreditNoteResult;
        return $this;
    }

}
