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
class EshopTransactionPreScreeningResponse
{
    /**
     * @var TransactionStatusV3 $EshopTransactionPreScreeningResult
     */
    protected $EshopTransactionPreScreeningResult = null;

    /**
     * @param TransactionStatusV3 $EshopTransactionPreScreeningResult
     */
    public function __construct($EshopTransactionPreScreeningResult)
    {
        $this->EshopTransactionPreScreeningResult = $EshopTransactionPreScreeningResult;
    }

    /**
     * @return TransactionStatusV3
     */
    public function getEshopTransactionPreScreeningResult()
    {
        return $this->EshopTransactionPreScreeningResult;
    }

    /**
     * @param TransactionStatusV3 $EshopTransactionPreScreeningResult
     * @return EshopTransactionPreScreeningResponse
     */
    public function setEshopTransactionPreScreeningResult($EshopTransactionPreScreeningResult)
    {
        $this->EshopTransactionPreScreeningResult = $EshopTransactionPreScreeningResult;
        return $this;
    }

}
