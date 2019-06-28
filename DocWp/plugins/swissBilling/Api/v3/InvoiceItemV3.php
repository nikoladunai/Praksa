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
class InvoiceItemV3
{
    /**
     * @var string $short_desc
     */
    protected $short_desc = null;

    /**
     * @var int $quantity
     */
    protected $quantity = null;

    /**
     * @var float $unit_price
     */
    protected $unit_price = null;

    /**
     * @var float $VAT_rate
     */
    protected $VAT_rate = null;

    /**
     * @var float $VAT_amount
     */
    protected $VAT_amount = null;

    /**
     * @var string $file_link
     */
    protected $file_link = null;

    /**
     * @var ImageTypeV3 $image_type
     */
    protected $image_type = null;

    /**
     * @var base64Binary $image
     */
    protected $image = null;

    /**
     * @var string $desc
     */
    protected $desc = null;

    /**
     * @param int $quantity
     * @param float $unit_price
     * @param float $VAT_rate
     * @param float $VAT_amount
     */
    public function __construct($quantity, $unit_price, $VAT_rate, $VAT_amount)
    {
        $this->quantity = $quantity;
        $this->unit_price = $unit_price;
        $this->VAT_rate = $VAT_rate;
        $this->VAT_amount = $VAT_amount;
    }

    /**
     * @return string
     */
    public function getShort_desc()
    {
        return $this->short_desc;
    }

    /**
     * @param string $short_desc
     * @return InvoiceItemV3
     */
    public function setShort_desc($short_desc)
    {
        $this->short_desc = $short_desc;
        return $this;
    }

    /**
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     * @return InvoiceItemV3
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
        return $this;
    }

    /**
     * @return float
     */
    public function getUnit_price()
    {
        return $this->unit_price;
    }

    /**
     * @param float $unit_price
     * @return InvoiceItemV3
     */
    public function setUnit_price($unit_price)
    {
        $this->unit_price = $unit_price;
        return $this;
    }

    /**
     * @return float
     */
    public function getVAT_rate()
    {
        return $this->VAT_rate;
    }

    /**
     * @param float $VAT_rate
     * @return InvoiceItemV3
     */
    public function setVAT_rate($VAT_rate)
    {
        $this->VAT_rate = $VAT_rate;
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
     * @return InvoiceItemV3
     */
    public function setVAT_amount($VAT_amount)
    {
        $this->VAT_amount = $VAT_amount;
        return $this;
    }

    /**
     * @return string
     */
    public function getFile_link()
    {
        return $this->file_link;
    }

    /**
     * @param string $file_link
     * @return InvoiceItemV3
     */
    public function setFile_link($file_link)
    {
        $this->file_link = $file_link;
        return $this;
    }

    /**
     * @return ImageTypeV3
     */
    public function getImage_type()
    {
        return $this->image_type;
    }

    /**
     * @param ImageTypeV3 $image_type
     * @return InvoiceItemV3
     */
    public function setImage_type($image_type)
    {
        $this->image_type = $image_type;
        return $this;
    }

    /**
     * @return base64Binary
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param base64Binary $image
     * @return InvoiceItemV3
     */
    public function setImage($image)
    {
        $this->image = $image;
        return $this;
    }

    /**
     * @return string
     */
    public function getDesc()
    {
        return $this->desc;
    }

    /**
     * @param string $desc
     * @return InvoiceItemV3
     */
    public function setDesc($desc)
    {
        $this->desc = $desc;
        return $this;
    }

}
