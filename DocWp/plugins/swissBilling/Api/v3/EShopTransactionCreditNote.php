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
class EShopTransactionCreditNote
{
    /**
     * @var MerchantV3 $merchant
     */
    protected $merchant = null;

    /**
     * @var string $transaction_ref
     */
    protected $transaction_ref = null;

    /**
     * @var \DateTime $timestamp
     */
    protected $timestamp = null;

    /**
     * @var float $amount
     */
    protected $amount = null;

    /**
     * @var string $transaction_ref_new
     */
    protected $transaction_ref_new = null;

    /**
     * @var string $notes
     */
    protected $notes = null;

    /**
     * @param MerchantV3 $merchant
     * @param string $transaction_ref
     * @param \DateTime $timestamp
     * @param float $amount
     * @param string $transaction_ref_new
     * @param string $notes
     */
    public function __construct($merchant, $transaction_ref, \DateTime $timestamp, $amount, $transaction_ref_new, $notes)
    {
        $this->merchant = $merchant;
        $this->transaction_ref = $transaction_ref;
        $this->timestamp = $timestamp->format(\DateTime::ATOM);
        $this->amount = $amount;
        $this->transaction_ref_new = $transaction_ref_new;
        $this->notes = $notes;
    }

    /**
     * @return MerchantV3
     */
    public function getMerchant()
    {
        return $this->merchant;
    }

    /**
     * @param MerchantV3 $merchant
     * @return EShopTransactionCreditNote
     */
    public function setMerchant($merchant)
    {
        $this->merchant = $merchant;
        return $this;
    }

    /**
     * @return string
     */
    public function getTransaction_ref()
    {
        return $this->transaction_ref;
    }

    /**
     * @param string $transaction_ref
     * @return EShopTransactionCreditNote
     */
    public function setTransaction_ref($transaction_ref)
    {
        $this->transaction_ref = $transaction_ref;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getTimestamp()
    {
        if ($this->timestamp == null) {
            return null;
        } else {
            try {
                return new \DateTime($this->timestamp);
            } catch (\Exception $e) {
                return false;
            }
        }
    }

    /**
     * @param \DateTime $timestamp
     * @return EShopTransactionCreditNote
     */
    public function setTimestamp(\DateTime $timestamp)
    {
        $this->timestamp = $timestamp->format(\DateTime::ATOM);
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
     * @return EShopTransactionCreditNote
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * @return string
     */
    public function getTransaction_ref_new()
    {
        return $this->transaction_ref_new;
    }

    /**
     * @param string $transaction_ref_new
     * @return EShopTransactionCreditNote
     */
    public function setTransaction_ref_new($transaction_ref_new)
    {
        $this->transaction_ref_new = $transaction_ref_new;
        return $this;
    }

    /**
     * @return string
     */
    public function getNotes()
    {
        return $this->notes;
    }

    /**
     * @param string $notes
     * @return EShopTransactionCreditNote
     */
    public function setNotes($notes)
    {
        $this->notes = $notes;
        return $this;
    }

}
