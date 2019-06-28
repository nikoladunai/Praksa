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
class CheckResult
{
    /**
     * @var TransactionStatusV2 $methodstatus
     */
    protected $methodstatus = null;

    /**
     * @var ArrayOfOrders $order_table
     */
    protected $order_table = null;


    public function __construct()
    {

    }

    /**
     * @return TransactionStatusV2
     */
    public function getMethodstatus()
    {
        return $this->methodstatus;
    }

    /**
     * @param TransactionStatusV2 $methodstatus
     * @return CheckResult
     */
    public function setMethodstatus($methodstatus)
    {
        $this->methodstatus = $methodstatus;
        return $this;
    }

    /**
     * @return ArrayOfOrders
     */
    public function getOrder_table()
    {
        return $this->order_table;
    }

    /**
     * @param ArrayOfOrders $order_table
     * @return CheckResult
     */
    public function setOrder_table($order_table)
    {
        $this->order_table = $order_table;
        return $this;
    }

}
