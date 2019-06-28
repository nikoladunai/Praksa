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
class EShopTransactionUpdateResponse
{
    /**
     * @var TransactionStatusV3 $EShopTransactionUpdateResult
     */
    protected $EShopTransactionUpdateResult = null;

    /**
     * @param TransactionStatusV3 $EShopTransactionUpdateResult
     */
    public function __construct($EShopTransactionUpdateResult)
    {
        $this->EShopTransactionUpdateResult = $EShopTransactionUpdateResult;
    }

    /**
     * @return TransactionStatusV3
     */
    public function getEShopTransactionUpdateResult()
    {
        return $this->EShopTransactionUpdateResult;
    }

    /**
     * @param TransactionStatusV3 $EShopTransactionUpdateResult
     * @return EShopTransactionUpdateResponse
     */
    public function setEShopTransactionUpdateResult($EShopTransactionUpdateResult)
    {
        $this->EShopTransactionUpdateResult = $EShopTransactionUpdateResult;
        return $this;
    }

}
