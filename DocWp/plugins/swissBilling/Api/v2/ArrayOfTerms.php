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
class ArrayOfTerms
{
    /**
     * @var PaymentTermV2[] $arrayofterms
     */
    protected $arrayofterms = null;

    /**
     * @param PaymentTermV2[] $arrayofterms
     */
    public function __construct(array $arrayofterms)
    {
        $this->arrayofterms = $arrayofterms;
    }

    /**
     * @return PaymentTermV2[]
     */
    public function getArrayofterms()
    {
        return $this->arrayofterms;
    }

    /**
     * @param PaymentTermV2[] $arrayofterms
     * @return ArrayOfTerms
     */
    public function setArrayofterms(array $arrayofterms)
    {
        $this->arrayofterms = $arrayofterms;
        return $this;
    }

}
