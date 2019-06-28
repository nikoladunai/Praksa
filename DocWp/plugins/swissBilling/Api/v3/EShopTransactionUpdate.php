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
class EShopTransactionUpdate
{
    /**
     * @var MerchantV3 $merchant
     */
    protected $merchant = null;

    /**
     * @var TransactionV3 $transaction
     */
    protected $transaction = null;

    /**
     * @var DebtorV3 $debtor
     */
    protected $debtor = null;

    /**
     * @var int $item_count
     */
    protected $item_count = null;

    /**
     * @var ArrayOfItemsV3 $arrayofitems
     */
    protected $arrayofitems = null;

    /**
     * @param MerchantV3 $merchant
     * @param TransactionV3 $transaction
     * @param DebtorV3 $debtor
     * @param int $item_count
     * @param ArrayOfItemsV3 $arrayofitems
     */
    public function __construct($merchant, $transaction, $debtor, $item_count, $arrayofitems)
    {
        $this->merchant = $merchant;
        $this->transaction = $transaction;
        $this->debtor = $debtor;
        $this->item_count = $item_count;
        $this->arrayofitems = $arrayofitems;
    }

    /**
     * @return MerchantV3
     */
    public function getMerchant()
    {
        return $this->merchant;
    }

    /**
     * @param MerchantV3 $merchant
     * @return EShopTransactionUpdate
     */
    public function setMerchant($merchant)
    {
        $this->merchant = $merchant;
        return $this;
    }

    /**
     * @return TransactionV3
     */
    public function getTransaction()
    {
        return $this->transaction;
    }

    /**
     * @param TransactionV3 $transaction
     * @return EShopTransactionUpdate
     */
    public function setTransaction($transaction)
    {
        $this->transaction = $transaction;
        return $this;
    }

    /**
     * @return DebtorV3
     */
    public function getDebtor()
    {
        return $this->debtor;
    }

    /**
     * @param DebtorV3 $debtor
     * @return EShopTransactionUpdate
     */
    public function setDebtor($debtor)
    {
        $this->debtor = $debtor;
        return $this;
    }

    /**
     * @return int
     */
    public function getItem_count()
    {
        return $this->item_count;
    }

    /**
     * @param int $item_count
     * @return EShopTransactionUpdate
     */
    public function setItem_count($item_count)
    {
        $this->item_count = $item_count;
        return $this;
    }

    /**
     * @return ArrayOfItemsV3
     */
    public function getArrayofitems()
    {
        return $this->arrayofitems;
    }

    /**
     * @param ArrayOfItemsV3 $arrayofitems
     * @return EShopTransactionUpdate
     */
    public function setArrayofitems($arrayofitems)
    {
        $this->arrayofitems = $arrayofitems;
        return $this;
    }

}
