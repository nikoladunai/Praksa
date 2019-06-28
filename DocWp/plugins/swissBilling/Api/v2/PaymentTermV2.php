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
class PaymentTermV2
{
    /**
     * @var $date
     */
    protected $date = null;

    /**
     * @var float $amount
     */
    protected $amount = null;

    
    public function __construct()
    {
    
    }

    /**
     * @return date
     */
    public function getDate()
    {
      return $this->date;
    }

    /**
     * @param $date
     * @return PaymentTermV2
     */
    public function setDate($date)
    {
      $this->date = $date;
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
     * @return PaymentTermV2
     */
    public function setAmount($amount)
    {
      $this->amount = $amount;
      return $this;
    }

}
