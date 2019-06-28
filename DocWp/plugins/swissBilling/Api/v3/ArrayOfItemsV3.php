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
class ArrayOfItemsV3
{
    /**
     * @var InvoiceItemV3[] $items
     */
    protected $items = null;

    
    public function __construct()
    {
    
    }

    /**
     * @return InvoiceItemV3[]
     */
    public function getItems()
    {
      return $this->items;
    }

    /**
     * @param InvoiceItemV3[] $items
     * @return ArrayOfItemsV3
     */
    public function setItems(array $items = null)
    {
      $this->items = $items;
      return $this;
    }

}
