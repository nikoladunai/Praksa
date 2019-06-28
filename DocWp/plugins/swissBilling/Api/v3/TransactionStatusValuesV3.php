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
class TransactionStatusValuesV3
{
    const __default = 'Inprocess';
    const Inprocess = 'In process';
    const Canceledbyuser = 'Canceled by user';
    const Canceledbymerchant = 'Canceled by merchant';
    const Failed = 'Failed';
    const Answered = 'Answered';
    const TimedOut = 'Timed Out';
    const Membershipvalidation = 'Membership validation';
    const Testapproved = 'Test approved';
    const Acknowledged = 'Acknowledged';
    const Delayedforvalidation = 'Delayed for validation';
    const Processed = 'Processed';
    const Pendingshopconfirmation = 'Pending shop confirmation';
    const Addressvalidation = 'Address validation';
    const Paymentvalidation = 'Payment validation';
    const Processing = 'Processing';

}
