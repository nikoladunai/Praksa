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
class EshopTransactionCancelResponse
{
    /**
     * @var TransactionStatusV3 $EshopTransactionCancelResult
     */
    protected $EshopTransactionCancelResult = null;

    /**
     * @param TransactionStatusV3 $EshopTransactionCancelResult
     */
    public function __construct($EshopTransactionCancelResult)
    {
        $this->EshopTransactionCancelResult = $EshopTransactionCancelResult;
    }

    /**
     * @return TransactionStatusV3
     */
    public function getEshopTransactionCancelResult()
    {
        return $this->EshopTransactionCancelResult;
    }

    /**
     * @param TransactionStatusV3 $EshopTransactionCancelResult
     * @return EshopTransactionCancelResponse
     */
    public function setEshopTransactionCancelResult($EshopTransactionCancelResult)
    {
        $this->EshopTransactionCancelResult = $EshopTransactionCancelResult;
        return $this;
    }

}
