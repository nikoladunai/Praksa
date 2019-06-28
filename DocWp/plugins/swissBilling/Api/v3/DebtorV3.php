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
class DebtorV3
{
    /**
     * @var string $company_name
     */
    protected $company_name = null;

    /**
     * @var string $title
     */
    protected $title = null;

    /**
     * @var string $firstname
     */
    protected $firstname = null;

    /**
     * @var string $lastname
     */
    protected $lastname = null;

    /**
     * @var date $birthdate
     */
    protected $birthdate = null;

    /**
     * @var string $adr1
     */
    protected $adr1 = null;

    /**
     * @var string $adr2
     */
    protected $adr2 = null;

    /**
     * @var string $street_nr
     */
    protected $street_nr = null;

    /**
     * @var string $city
     */
    protected $city = null;

    /**
     * @var string $zip
     */
    protected $zip = null;

    /**
     * @var string $country
     */
    protected $country = null;

    /**
     * @var string $email
     */
    protected $email = null;

    /**
     * @var string $phone
     */
    protected $phone = null;

    /**
     * @var string $language
     */
    protected $language = null;

    /**
     * @var string $user_ID
     */
    protected $user_ID = null;

    /**
     * @var int $SBMember_ID
     */
    protected $SBMember_ID = null;

    /**
     * @var string $deliv_company_name
     */
    protected $deliv_company_name = null;

    /**
     * @var string $deliv_title
     */
    protected $deliv_title = null;

    /**
     * @var string $deliv_firstname
     */
    protected $deliv_firstname = null;

    /**
     * @var string $deliv_lastname
     */
    protected $deliv_lastname = null;

    /**
     * @var string $deliv_adr1
     */
    protected $deliv_adr1 = null;

    /**
     * @var string $deliv_adr2
     */
    protected $deliv_adr2 = null;

    /**
     * @var string $deliv_street_nr
     */
    protected $deliv_street_nr = null;

    /**
     * @var string $deliv_city
     */
    protected $deliv_city = null;

    /**
     * @var string $deliv_zip
     */
    protected $deliv_zip = null;

    /**
     * @var string $deliv_country
     */
    protected $deliv_country = null;

    /**
     * @param int $SBMember_ID
     */
    public function __construct($SBMember_ID)
    {
        $this->SBMember_ID = $SBMember_ID;
    }

    /**
     * @return string
     */
    public function getCompany_name()
    {
        return $this->company_name;
    }

    /**
     * @param string $company_name
     * @return DebtorV3
     */
    public function setCompany_name($company_name)
    {
        $this->company_name = $company_name;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return DebtorV3
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     * @return DebtorV3
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param string $lastname
     * @return DebtorV3
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
        return $this;
    }

    /**
     * @return date
     */
    public function getBirthdate()
    {
        return $this->birthdate;
    }

    /**
     * @param date $birthdate
     * @return DebtorV3
     */
    public function setBirthdate($birthdate)
    {
        $this->birthdate = $birthdate;
        return $this;
    }

    /**
     * @return string
     */
    public function getAdr1()
    {
        return $this->adr1;
    }

    /**
     * @param string $adr1
     * @return DebtorV3
     */
    public function setAdr1($adr1)
    {
        $this->adr1 = $adr1;
        return $this;
    }

    /**
     * @return string
     */
    public function getAdr2()
    {
        return $this->adr2;
    }

    /**
     * @param string $adr2
     * @return DebtorV3
     */
    public function setAdr2($adr2)
    {
        $this->adr2 = $adr2;
        return $this;
    }

    /**
     * @return string
     */
    public function getStreet_nr()
    {
        return $this->street_nr;
    }

    /**
     * @param string $street_nr
     * @return DebtorV3
     */
    public function setStreet_nr($street_nr)
    {
        $this->street_nr = $street_nr;
        return $this;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param string $city
     * @return DebtorV3
     */
    public function setCity($city)
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @return string
     */
    public function getZip()
    {
        return $this->zip;
    }

    /**
     * @param string $zip
     * @return DebtorV3
     */
    public function setZip($zip)
    {
        $this->zip = $zip;
        return $this;
    }

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param string $country
     * @return DebtorV3
     */
    public function setCountry($country)
    {
        $this->country = $country;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return DebtorV3
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     * @return DebtorV3
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @return string
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param string $language
     * @return DebtorV3
     */
    public function setLanguage($language)
    {
        $this->language = $language;
        return $this;
    }

    /**
     * @return string
     */
    public function getUser_ID()
    {
        return $this->user_ID;
    }

    /**
     * @param string $user_ID
     * @return DebtorV3
     */
    public function setUser_ID($user_ID)
    {
        $this->user_ID = $user_ID;
        return $this;
    }

    /**
     * @return int
     */
    public function getSBMember_ID()
    {
        return $this->SBMember_ID;
    }

    /**
     * @param int $SBMember_ID
     * @return DebtorV3
     */
    public function setSBMember_ID($SBMember_ID)
    {
        $this->SBMember_ID = $SBMember_ID;
        return $this;
    }

    /**
     * @return string
     */
    public function getDeliv_company_name()
    {
        return $this->deliv_company_name;
    }

    /**
     * @param string $deliv_company_name
     * @return DebtorV3
     */
    public function setDeliv_company_name($deliv_company_name)
    {
        $this->deliv_company_name = $deliv_company_name;
        return $this;
    }

    /**
     * @return string
     */
    public function getDeliv_title()
    {
        return $this->deliv_title;
    }

    /**
     * @param string $deliv_title
     * @return DebtorV3
     */
    public function setDeliv_title($deliv_title)
    {
        $this->deliv_title = $deliv_title;
        return $this;
    }

    /**
     * @return string
     */
    public function getDeliv_firstname()
    {
        return $this->deliv_firstname;
    }

    /**
     * @param string $deliv_firstname
     * @return DebtorV3
     */
    public function setDeliv_firstname($deliv_firstname)
    {
        $this->deliv_firstname = $deliv_firstname;
        return $this;
    }

    /**
     * @return string
     */
    public function getDeliv_lastname()
    {
        return $this->deliv_lastname;
    }

    /**
     * @param string $deliv_lastname
     * @return DebtorV3
     */
    public function setDeliv_lastname($deliv_lastname)
    {
        $this->deliv_lastname = $deliv_lastname;
        return $this;
    }

    /**
     * @return string
     */
    public function getDeliv_adr1()
    {
        return $this->deliv_adr1;
    }

    /**
     * @param string $deliv_adr1
     * @return DebtorV3
     */
    public function setDeliv_adr1($deliv_adr1)
    {
        $this->deliv_adr1 = $deliv_adr1;
        return $this;
    }

    /**
     * @return string
     */
    public function getDeliv_adr2()
    {
        return $this->deliv_adr2;
    }

    /**
     * @param string $deliv_adr2
     * @return DebtorV3
     */
    public function setDeliv_adr2($deliv_adr2)
    {
        $this->deliv_adr2 = $deliv_adr2;
        return $this;
    }

    /**
     * @return string
     */
    public function getDeliv_street_nr()
    {
        return $this->deliv_street_nr;
    }

    /**
     * @param string $deliv_street_nr
     * @return DebtorV3
     */
    public function setDeliv_street_nr($deliv_street_nr)
    {
        $this->deliv_street_nr = $deliv_street_nr;
        return $this;
    }

    /**
     * @return string
     */
    public function getDeliv_city()
    {
        return $this->deliv_city;
    }

    /**
     * @param string $deliv_city
     * @return DebtorV3
     */
    public function setDeliv_city($deliv_city)
    {
        $this->deliv_city = $deliv_city;
        return $this;
    }

    /**
     * @return string
     */
    public function getDeliv_zip()
    {
        return $this->deliv_zip;
    }

    /**
     * @param string $deliv_zip
     * @return DebtorV3
     */
    public function setDeliv_zip($deliv_zip)
    {
        $this->deliv_zip = $deliv_zip;
        return $this;
    }

    /**
     * @return string
     */
    public function getDeliv_country()
    {
        return $this->deliv_country;
    }

    /**
     * @param string $deliv_country
     * @return DebtorV3
     */
    public function setDeliv_country($deliv_country)
    {
        $this->deliv_country = $deliv_country;
        return $this;
    }

}
