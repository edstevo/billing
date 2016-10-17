<?php
/**
 *  Copyright (c) 2016.
 *  This was created by Ed Stephenson (edward@flowflex.com).
 *  You must get permission to use this work.
 */

namespace EdStevo\Billing\Contracts;


interface IsChargable
{

    /**
     * Get the id for this customer
     *
     * @return string
     */
    public function getId();

    /**
     * Get the email for this customer
     *
     * @return string
     */
    public function getEmail() : string;

    /**
     * Get the identifier for this customer needed by the Payment System
     *
     * @return mixed
     */
    public function getPaymentSystemId() : string;

    /**
     * Define relationship between the customer and the payment cards
     *
     * @return mixed
     */
    public function cards();
}