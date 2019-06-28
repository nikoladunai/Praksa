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
class TransactionStatusV2
{
    /**
     * @var int $transaction_id
     */
    protected $transaction_id = null;

    /**
     * @var TransactionStatusValuesV2 $status
     */
    protected $status = null;

    /**
     * @var TransactionActionValuesV2 $action
     */
    protected $action = null;

    /**
     * @var string $url
     */
    protected $url = null;

    /**
     * @var string $merchantmsg
     */
    protected $merchantmsg = null;

    /**
     * @var string $debtormsg
     */
    protected $debtormsg = null;

    /**
     * @var float $invoicing_costs
     */
    protected $invoicing_costs = null;

    /**
     * @var int $partial_payment
     */
    protected $partial_payment = null;

    /**
     * @var float $partial_payment_fees
     */
    protected $partial_payment_fees = null;

    /**
     * @var percentage $partial_payment_rate
     */
    protected $partial_payment_rate = null;

    /**
     * @var ArrayOfTerms $partial_payment_table
     */
    protected $partial_payment_table = null;

    /**
     * @var int $sbmember_id
     */
    protected $sbmember_id = null;

    /**
     * @var int $failure_code
     */
    protected $failure_code = null;

    /**
     * @var string $failure_text_debtor
     */
    protected $failure_text_debtor = null;

    /**
     * @var string $failure_text_merchant
     */
    protected $failure_text_merchant = null;

    /**
     * @var string $internal_debug_message
     */
    protected $internal_debug_message = null;

    /**
     * @var int $soapversion
     */
    protected $soapversion = null;

    /**
     * @var float $amount
     */
    protected $amount = null;

    /**
     * @var string $partnerID
     */
    protected $partnerID = null;

    /**
     * @var int $swb_transaction_id
     */
    protected $swb_transaction_id = null;


    public function __construct()
    {

    }

    /**
     * @return int
     */
    public function getTransaction_id()
    {
        return $this->transaction_id;
    }

    /**
     * @param int $transaction_id
     * @return TransactionStatusV2
     */
    public function setTransaction_id($transaction_id)
    {
        $this->transaction_id = $transaction_id;
        return $this;
    }

    /**
     * @return TransactionStatusValuesV2
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param TransactionStatusValuesV2 $status
     * @return TransactionStatusV2
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return TransactionActionValuesV2
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @param TransactionActionValuesV2 $action
     * @return TransactionStatusV2
     */
    public function setAction($action)
    {
        $this->action = $action;
        return $this;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     * @return TransactionStatusV2
     */
    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @return string
     */
    public function getMerchantmsg()
    {
        return $this->merchantmsg;
    }

    /**
     * @param string $merchantmsg
     * @return TransactionStatusV2
     */
    public function setMerchantmsg($merchantmsg)
    {
        $this->merchantmsg = $merchantmsg;
        return $this;
    }

    /**
     * @return string
     */
    public function getDebtormsg()
    {
        return $this->debtormsg;
    }

    /**
     * @param string $debtormsg
     * @return TransactionStatusV2
     */
    public function setDebtormsg($debtormsg)
    {
        $this->debtormsg = $debtormsg;
        return $this;
    }

    /**
     * @return float
     */
    public function getInvoicing_costs()
    {
        return $this->invoicing_costs;
    }

    /**
     * @param float $invoicing_costs
     * @return TransactionStatusV2
     */
    public function setInvoicing_costs($invoicing_costs)
    {
        $this->invoicing_costs = $invoicing_costs;
        return $this;
    }

    /**
     * @return int
     */
    public function getPartial_payment()
    {
        return $this->partial_payment;
    }

    /**
     * @param int $partial_payment
     * @return TransactionStatusV2
     */
    public function setPartial_payment($partial_payment)
    {
        $this->partial_payment = $partial_payment;
        return $this;
    }

    /**
     * @return float
     */
    public function getPartial_payment_fees()
    {
        return $this->partial_payment_fees;
    }

    /**
     * @param float $partial_payment_fees
     * @return TransactionStatusV2
     */
    public function setPartial_payment_fees($partial_payment_fees)
    {
        $this->partial_payment_fees = $partial_payment_fees;
        return $this;
    }

    /**
     * @return percentage
     */
    public function getPartial_payment_rate()
    {
        return $this->partial_payment_rate;
    }

    /**
     * @param percentage $partial_payment_rate
     * @return TransactionStatusV2
     */
    public function setPartial_payment_rate($partial_payment_rate)
    {
        $this->partial_payment_rate = $partial_payment_rate;
        return $this;
    }

    /**
     * @return ArrayOfTerms
     */
    public function getPartial_payment_table()
    {
        return $this->partial_payment_table;
    }

    /**
     * @param ArrayOfTerms $partial_payment_table
     * @return TransactionStatusV2
     */
    public function setPartial_payment_table($partial_payment_table)
    {
        $this->partial_payment_table = $partial_payment_table;
        return $this;
    }

    /**
     * @return int
     */
    public function getSbmember_id()
    {
        return $this->sbmember_id;
    }

    /**
     * @param int $sbmember_id
     * @return TransactionStatusV2
     */
    public function setSbmember_id($sbmember_id)
    {
        $this->sbmember_id = $sbmember_id;
        return $this;
    }

    /**
     * @return int
     */
    public function getFailure_code()
    {
        return $this->failure_code;
    }

    /**
     * @param int $failure_code
     * @return TransactionStatusV2
     */
    public function setFailure_code($failure_code)
    {
        $this->failure_code = $failure_code;
        return $this;
    }

    /**
     * @return string
     */
    public function getFailure_text_debtor()
    {
        return $this->failure_text_debtor;
    }

    /**
     * @param string $failure_text_debtor
     * @return TransactionStatusV2
     */
    public function setFailure_text_debtor($failure_text_debtor)
    {
        $this->failure_text_debtor = $failure_text_debtor;
        return $this;
    }

    /**
     * @return string
     */
    public function getFailure_text_merchant()
    {
        return $this->failure_text_merchant;
    }

    /**
     * @param string $failure_text_merchant
     * @return TransactionStatusV2
     */
    public function setFailure_text_merchant($failure_text_merchant)
    {
        $this->failure_text_merchant = $failure_text_merchant;
        return $this;
    }

    /**
     * @return string
     */
    public function getInternal_debug_message()
    {
        return $this->internal_debug_message;
    }

    /**
     * @param string $internal_debug_message
     * @return TransactionStatusV2
     */
    public function setInternal_debug_message($internal_debug_message)
    {
        $this->internal_debug_message = $internal_debug_message;
        return $this;
    }

    /**
     * @return int
     */
    public function getSoapversion()
    {
        return $this->soapversion;
    }

    /**
     * @param int $soapversion
     * @return TransactionStatusV2
     */
    public function setSoapversion($soapversion)
    {
        $this->soapversion = $soapversion;
        return $this;
    }

    /**
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param float $amount
     * @return TransactionStatusV2
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * @return string
     */
    public function getPartnerID()
    {
        return $this->partnerID;
    }

    /**
     * @param string $partnerID
     * @return TransactionStatusV2
     */
    public function setPartnerID($partnerID)
    {
        $this->partnerID = $partnerID;
        return $this;
    }

    /**
     * @return int
     */
    public function getSwb_transaction_id()
    {
        return $this->swb_transaction_id;
    }

    /**
     * @param int $swb_transaction_id
     * @return TransactionStatusV2
     */
    public function setSwb_transaction_id($swb_transaction_id)
    {
        $this->swb_transaction_id = $swb_transaction_id;
        return $this;
    }

}
