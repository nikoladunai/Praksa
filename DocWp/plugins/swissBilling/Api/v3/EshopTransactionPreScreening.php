<?php

class EshopTransactionPreScreening
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
     * @return EshopTransactionPreScreening
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
     * @return EshopTransactionPreScreening
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
     * @return EshopTransactionPreScreening
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
     * @return EshopTransactionPreScreening
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
     * @return EshopTransactionPreScreening
     */
    public function setArrayofitems($arrayofitems)
    {
        $this->arrayofitems = $arrayofitems;
        return $this;
    }

}
