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
class EshopTransactionUnCancelResponse
{
    /**
     * @var TransactionStatusV3 $EshopTransactionUnCancelResult
     */
    protected $EshopTransactionUnCancelResult = null;

    /**
     * @param TransactionStatusV3 $EshopTransactionUnCancelResult
     */
    public function __construct($EshopTransactionUnCancelResult)
    {
        $this->EshopTransactionUnCancelResult = $EshopTransactionUnCancelResult;
    }

    /**
     * @return TransactionStatusV3
     */
    public function getEshopTransactionUnCancelResult()
    {
        return $this->EshopTransactionUnCancelResult;
    }

    /**
     * @param TransactionStatusV3 $EshopTransactionUnCancelResult
     * @return EshopTransactionUnCancelResponse
     */
    public function setEshopTransactionUnCancelResult($EshopTransactionUnCancelResult)
    {
        $this->EshopTransactionUnCancelResult = $EshopTransactionUnCancelResult;
        return $this;
    }

}
