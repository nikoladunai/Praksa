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
class GetInvoiceStatus
{
    /**
     * @var string $failure_text
     */
    protected $failure_text = null;

    /**
     * @var base64Binary $Invoice
     */
    protected $Invoice = null;

    /**
     * @var int $Length
     */
    protected $Length = null;

    /**
     * @param int $Length
     */
    public function __construct($Length)
    {
        $this->Length = $Length;
    }

    /**
     * @return string
     */
    public function getFailure_text()
    {
        return $this->failure_text;
    }

    /**
     * @param string $failure_text
     * @return GetInvoiceStatus
     */
    public function setFailure_text($failure_text)
    {
        $this->failure_text = $failure_text;
        return $this;
    }

    /**
     * @return base64Binary
     */
    public function getInvoice()
    {
        return $this->Invoice;
    }

    /**
     * @param base64Binary $Invoice
     * @return GetInvoiceStatus
     */
    public function setInvoice($Invoice)
    {
        $this->Invoice = $Invoice;
        return $this;
    }

    /**
     * @return int
     */
    public function getLength()
    {
        return $this->Length;
    }

    /**
     * @param int $Length
     * @return GetInvoiceStatus
     */
    public function setLength($Length)
    {
        $this->Length = $Length;
        return $this;
    }

}
