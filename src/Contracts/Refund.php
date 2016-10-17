<?php
/**
 *  Copyright (c) 2016.
 *  This was created by Ed Stephenson (edward@flowflex.com).
 *  You must get permission to use this work.
 */

namespace EdStevo\Billing\Contracts;


interface Refund
{

    /**
     * Create a new refund in the billing system
     *
     * @param string $charge_id
     *
     * @return array
     */
    public function create(string $charge_id);

    /**
     * Retrieve a refund record from the billing system
     *
     * @param string $charge_id
     * @param string $refund_id
     *
     * @return array
     */
    public function retrieve(string $charge_id, string $refund_id);
}