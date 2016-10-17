<?php
/**
 *  Copyright (c) 2016.
 *  This was created by Ed Stephenson (edward@flowflex.com).
 *  You must get permission to use this work.
 */

namespace EdStevo\Billing\Contracts;


interface Customer
{

    /**
     * Return a customer from the billing system
     *
     * @param \EdStevo\Billing\Contracts\IsChargable $customer
     *
     * @return mixed
     */
    public function find(IsChargable $customer);

    /**
     * Create a new customer in the billing system
     *
     * @param \EdStevo\Billing\Contracts\IsChargable $customer
     *
     * @return mixed
     */
    public function create(IsChargable $customer);

    /**
     * Update a customer in the billing system
     *
     * @param \EdStevo\Billing\Contracts\IsChargable $customer
     * @param array                                  $data
     *
     * @return mixed
     */
    public function update(IsChargable $customer, array $data);

    /**
     * Remove a customer from the billing system
     *
     * @param \EdStevo\Billing\Contracts\IsChargable $customer
     *
     * @return mixed
     */
    public function delete(IsChargable $customer);
}