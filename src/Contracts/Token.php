<?php
/**
 *  Copyright (c) 2016.
 *  This was created by Ed Stephenson (edward@flowflex.com).
 *  You must get permission to use this work.
 */

namespace EdStevo\Billing\Contracts;


interface Token
{
    /**
     * Create a new token for a payment card
     *
     * @param int $number
     * @param int $exp_month
     * @param int $exp_year
     * @param int $cvc
     *
     * @return array
     */
    public function create(int $number, int $exp_month, int $exp_year, int $cvc) : array;

    /**
     * Retrieve a token from the billing system
     *
     * @param string $token_id
     *
     * @return array
     */
    public function retrieve(string $token_id) : array;
}