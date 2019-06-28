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
class EshopTransactionCancel
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
     * @param MerchantV3 $merchant
     * @param string $transaction_ref
     * @param \DateTime $timestamp
     */
    public function __construct($merchant, $transaction_ref, \DateTime $timestamp)
    {
        $this->merchant = $merchant;
        $this->transaction_ref = $transaction_ref;
        $this->timestamp = $timestamp->format(\DateTime::ATOM);
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
     * @return EshopTransactionCancel
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
     * @return EshopTransactionCancel
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
     * @return EshopTransactionCancel
     */
    public function setTimestamp(\DateTime $timestamp)
    {
        $this->timestamp = $timestamp->format(\DateTime::ATOM);
        return $this;
    }

}
