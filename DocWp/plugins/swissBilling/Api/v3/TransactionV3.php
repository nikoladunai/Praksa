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
class TransactionV3
{
    /**
     * @var TransactionTypeV3 $type
     */
    protected $type = null;

    /**
     * @var boolean $is_B2B
     */
    protected $is_B2B = null;

    /**
     * @var string $eshop_ID
     */
    protected $eshop_ID = null;

    /**
     * @var string $eshop_ref
     */
    protected $eshop_ref = null;

    /**
     * @var \DateTime $order_timestamp
     */
    protected $order_timestamp = null;

    /**
     * @var string $currency
     */
    protected $currency = null;

    /**
     * @var float $amount
     */
    protected $amount = null;

    /**
     * @var float $VAT_amount
     */
    protected $VAT_amount = null;

    /**
     * @var float $admin_fee_amount
     */
    protected $admin_fee_amount = null;

    /**
     * @var float $delivery_fee_amount
     */
    protected $delivery_fee_amount = null;

    /**
     * @var float $coupon_discount_amount
     */
    protected $coupon_discount_amount = null;

    /**
     * @var float $vol_discount
     */
    protected $vol_discount = null;

    /**
     * @var boolean $phys_delivery
     */
    protected $phys_delivery = null;

    /**
     * @var string $debtor_IP
     */
    protected $debtor_IP = null;

    /**
     * @var DeliveryStatusV3 $delivery_status
     */
    protected $delivery_status = null;

    /**
     * @var string $signature
     */
    protected $signature = null;

    /**
     * @var string $partnerID
     */
    protected $partnerID = null;

    /**
     * @param TransactionTypeV3 $type
     * @param boolean $is_B2B
     * @param \DateTime $order_timestamp
     * @param float $amount
     * @param float $VAT_amount
     * @param float $admin_fee_amount
     * @param float $delivery_fee_amount
     * @param float $coupon_discount_amount
     * @param float $vol_discount
     * @param boolean $phys_delivery
     * @param DeliveryStatusV3 $delivery_status
     */
    public function __construct($type, $is_B2B, \DateTime $order_timestamp, $amount, $VAT_amount, $admin_fee_amount, $delivery_fee_amount, $coupon_discount_amount, $vol_discount, $phys_delivery, $delivery_status)
    {
        $this->type = $type;
        $this->is_B2B = $is_B2B;
        $this->order_timestamp = $order_timestamp->format(\DateTime::ATOM);
        $this->amount = $amount;
        $this->VAT_amount = $VAT_amount;
        $this->admin_fee_amount = $admin_fee_amount;
        $this->delivery_fee_amount = $delivery_fee_amount;
        $this->coupon_discount_amount = $coupon_discount_amount;
        $this->vol_discount = $vol_discount;
        $this->phys_delivery = $phys_delivery;
        $this->delivery_status = $delivery_status;
    }

    /**
     * @return TransactionTypeV3
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param TransactionTypeV3 $type
     * @return TransactionV3
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getIs_B2B()
    {
        return $this->is_B2B;
    }

    /**
     * @param boolean $is_B2B
     * @return TransactionV3
     */
    public function setIs_B2B($is_B2B)
    {
        $this->is_B2B = $is_B2B;
        return $this;
    }

    /**
     * @return string
     */
    public function getEshop_ID()
    {
        return $this->eshop_ID;
    }

    /**
     * @param string $eshop_ID
     * @return TransactionV3
     */
    public function setEshop_ID($eshop_ID)
    {
        $this->eshop_ID = $eshop_ID;
        return $this;
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
     * @return TransactionV3
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
     * @return TransactionV3
     */
    public function setOrder_timestamp(\DateTime $order_timestamp)
    {
        $this->order_timestamp = $order_timestamp->format(\DateTime::ATOM);
        return $this;
    }

    /**
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     * @return TransactionV3
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
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
     * @return TransactionV3
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * @return float
     */
    public function getVAT_amount()
    {
        return $this->VAT_amount;
    }

    /**
     * @param float $VAT_amount
     * @return TransactionV3
     */
    public function setVAT_amount($VAT_amount)
    {
        $this->VAT_amount = $VAT_amount;
        return $this;
    }

    /**
     * @return float
     */
    public function getAdmin_fee_amount()
    {
        return $this->admin_fee_amount;
    }

    /**
     * @param float $admin_fee_amount
     * @return TransactionV3
     */
    public function setAdmin_fee_amount($admin_fee_amount)
    {
        $this->admin_fee_amount = $admin_fee_amount;
        return $this;
    }

    /**
     * @return float
     */
    public function getDelivery_fee_amount()
    {
        return $this->delivery_fee_amount;
    }

    /**
     * @param float $delivery_fee_amount
     * @return TransactionV3
     */
    public function setDelivery_fee_amount($delivery_fee_amount)
    {
        $this->delivery_fee_amount = $delivery_fee_amount;
        return $this;
    }

    /**
     * @return float
     */
    public function getCoupon_discount_amount()
    {
        return $this->coupon_discount_amount;
    }

    /**
     * @param float $coupon_discount_amount
     * @return TransactionV3
     */
    public function setCoupon_discount_amount($coupon_discount_amount)
    {
        $this->coupon_discount_amount = $coupon_discount_amount;
        return $this;
    }

    /**
     * @return float
     */
    public function getVol_discount()
    {
        return $this->vol_discount;
    }

    /**
     * @param float $vol_discount
     * @return TransactionV3
     */
    public function setVol_discount($vol_discount)
    {
        $this->vol_discount = $vol_discount;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getPhys_delivery()
    {
        return $this->phys_delivery;
    }

    /**
     * @param boolean $phys_delivery
     * @return TransactionV3
     */
    public function setPhys_delivery($phys_delivery)
    {
        $this->phys_delivery = $phys_delivery;
        return $this;
    }

    /**
     * @return string
     */
    public function getDebtor_IP()
    {
        return $this->debtor_IP;
    }

    /**
     * @param string $debtor_IP
     * @return TransactionV3
     */
    public function setDebtor_IP($debtor_IP)
    {
        $this->debtor_IP = $debtor_IP;
        return $this;
    }

    /**
     * @return DeliveryStatusV3
     */
    public function getDelivery_status()
    {
        return $this->delivery_status;
    }

    /**
     * @param DeliveryStatusV3 $delivery_status
     * @return TransactionV3
     */
    public function setDelivery_status($delivery_status)
    {
        $this->delivery_status = $delivery_status;
        return $this;
    }

    /**
     * @return string
     */
    public function getSignature()
    {
        return $this->signature;
    }

    /**
     * @param string $signature
     * @return TransactionV3
     */
    public function setSignature($signature)
    {
        $this->signature = $signature;
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
     * @return TransactionV3
     */
    public function setPartnerID($partnerID)
    {
        $this->partnerID = $partnerID;
        return $this;
    }

}
