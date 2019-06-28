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
class EshopTransactionAcknowledgeResponse
{

    /**
     * @var TransactionStatusV3 $EshopTransactionAcknowledgeResult
     */
    protected $EshopTransactionAcknowledgeResult = null;

    /**
     * @param TransactionStatusV3 $EshopTransactionAcknowledgeResult
     */
    public function __construct($EshopTransactionAcknowledgeResult)
    {
        $this->EshopTransactionAcknowledgeResult = $EshopTransactionAcknowledgeResult;
    }

    /**
     * @return TransactionStatusV3
     */
    public function getEshopTransactionAcknowledgeResult()
    {
        return $this->EshopTransactionAcknowledgeResult;
    }

    /**
     * @param TransactionStatusV3 $EshopTransactionAcknowledgeResult
     * @return EshopTransactionAcknowledgeResponse
     */
    public function setEshopTransactionAcknowledgeResult($EshopTransactionAcknowledgeResult)
    {
        $this->EshopTransactionAcknowledgeResult = $EshopTransactionAcknowledgeResult;
        return $this;
    }

}
