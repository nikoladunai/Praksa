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
class PaymentTermV3
{
    /**
     * @var \DateTime $date
     */
    protected $date = null;

    /**
     * @var float $amount
     */
    protected $amount = null;

    /**
     * @param \DateTime $date
     * @param float $amount
     */
    public function __construct(\DateTime $date, $amount)
    {
        $this->date = $date->format(\DateTime::ATOM);
        $this->amount = $amount;
    }

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        if ($this->date == null) {
            return null;
        } else {
            try {
                return new \DateTime($this->date);
            } catch (\Exception $e) {
                return false;
            }
        }
    }

    /**
     * @param \DateTime $date
     * @return PaymentTermV3
     */
    public function setDate(\DateTime $date)
    {
        $this->date = $date->format(\DateTime::ATOM);
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
     * @return PaymentTermV3
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
        return $this;
    }

}
