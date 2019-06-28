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
class MerchantV3
{
    /**
     * @var string $id
     */
    protected $id = null;

    /**
     * @var string $pwd
     */
    protected $pwd = null;

    /**
     * @var string $success_url
     */
    protected $success_url = null;

    /**
     * @var string $cancel_url
     */
    protected $cancel_url = null;

    /**
     * @var string $error_url
     */
    protected $error_url = null;


    public function __construct()
    {

    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return MerchantV3
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getPwd()
    {
        return $this->pwd;
    }

    /**
     * @param string $pwd
     * @return MerchantV3
     */
    public function setPwd($pwd)
    {
        $this->pwd = $pwd;
        return $this;
    }

    /**
     * @return string
     */
    public function getSuccess_url()
    {
        return $this->success_url;
    }

    /**
     * @param string $success_url
     * @return MerchantV3
     */
    public function setSuccess_url($success_url)
    {
        $this->success_url = $success_url;
        return $this;
    }

    /**
     * @return string
     */
    public function getCancel_url()
    {
        return $this->cancel_url;
    }

    /**
     * @param string $cancel_url
     * @return MerchantV3
     */
    public function setCancel_url($cancel_url)
    {
        $this->cancel_url = $cancel_url;
        return $this;
    }

    /**
     * @return string
     */
    public function getError_url()
    {
        return $this->error_url;
    }

    /**
     * @param string $error_url
     * @return MerchantV3
     */
    public function setError_url($error_url)
    {
        $this->error_url = $error_url;
        return $this;
    }

}
