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
class ArrayOfOrders
{

    /**
     * @var OrderItem[] $arrayoforders
     */
    protected $arrayoforders = null;

    /**
     * @param OrderItem[] $arrayoforders
     */
    public function __construct(array $arrayoforders)
    {
        $this->arrayoforders = $arrayoforders;
    }

    /**
     * @return OrderItem[]
     */
    public function getArrayoforders()
    {
        return $this->arrayoforders;
    }

    /**
     * @param OrderItem[] $arrayoforders
     * @return ArrayOfOrders
     */
    public function setArrayoforders(array $arrayoforders)
    {
        $this->arrayoforders = $arrayoforders;
        return $this;
    }

}
