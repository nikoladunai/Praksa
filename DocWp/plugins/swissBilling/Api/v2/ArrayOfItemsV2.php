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
class ArrayOfItemsV2
{
    /**
     * @var InvoiceItemV2[] $arrayofitems
     */
    protected $arrayofitems = null;

    /**
     * @param InvoiceItemV2[] $arrayofitems
     */
    public function __construct(array $arrayofitems)
    {
        $this->arrayofitems = $arrayofitems;
    }

    /**
     * @return InvoiceItemV2[]
     */
    public function getArrayofitems()
    {
        return $this->arrayofitems;
    }

    /**
     * @param InvoiceItemV2[] $arrayofitems
     * @return ArrayOfItemsV2
     */
    public function setArrayofitems(array $arrayofitems)
    {
        $this->arrayofitems = $arrayofitems;
        return $this;
    }

}
