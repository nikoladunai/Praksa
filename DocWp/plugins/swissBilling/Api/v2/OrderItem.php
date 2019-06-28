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
class OrderItem
{
    /**
     * @var string $eshop_ref
     */
    protected $eshop_ref = null;

    /**
     * @var \DateTime $order_timestamp
     */
    protected $order_timestamp = null;

    /**
     * @var TransactionStatusValuesV2 $status
     */
    protected $status = null;


    public function __construct()
    {

    }

    /**
     * @return string
     */
    public function getEshop_ref()
    {
        return $this->eshop_ref;
    }

    /**
     * @param string $eshop_ref
     * @return OrderItem
     */
    public function setEshop_ref($eshop_ref)
    {
        $this->eshop_ref = $eshop_ref;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getOrder_timestamp()
    {
        if ($this->order_timestamp == null) {
            return null;
        } else {
            try {
                return new \DateTime($this->order_timestamp);
            } catch (\Exception $e) {
                return false;
            }
        }
    }

    /**
     * @param \DateTime $order_timestamp
     * @return OrderItem
     */
    public function setOrder_timestamp(\DateTime $order_timestamp = null)
    {
        if ($order_timestamp == null) {
            $this->order_timestamp = null;
        } else {
            $this->order_timestamp = $order_timestamp->format(\DateTime::ATOM);
        }
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
     * @return OrderItem
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

}
