<?php
/**
 *  Copyright (c) 2016.
 *  This was created by Ed Stephenson (edward@flowflex.com).
 *  You must get permission to use this work.
 */

namespace EdStevo\Billing\PaymentSystems\Stripe;

use Cartalyst\Stripe\Laravel\Facades\Stripe;
use EdStevo\Billing\Contracts\Customer as CustomerContract;
use EdStevo\Billing\Contracts\IsChargable;

class Customer implements CustomerContract
{

    /**
     * Return a customer from the billing system
     *
     * @param \EdStevo\Billing\Contracts\IsChargable $customer
     *
     * @return array
     */
    public function find(IsChargable $customer) : array
    {
        return Stripe::customers()->find($customer->getPaymentSystemId());
    }

    /**
     * Create a new customer in the billing system
     *
     * @param \EdStevo\Billing\Contracts\IsChargable $customer
     *
     * @return array
     */
    public function create(IsChargable $customer) : array
    {
        return Stripe::customers()->create(['email' => $customer->getEmail(), 'metadata' => ['id' => $customer->getId()]]);
    }

    /**
     * Update a customer in the billing system
     *
     * @param \EdStevo\Billing\Contracts\IsChargable $customer
     * @param array                                  $data
     *
     * @return array
     */
    public function update(IsChargable $customer, array $data) : array
    {
        return Stripe::customers()->update($customer->getPaymentSystemId(), $data);
    }

    /**
     * Remove a customer from the billing system
     *
     * @param \EdStevo\Billing\Contracts\IsChargable $customer
     *
     * @return bool
     */
    public function delete(IsChargable $customer) : bool
    {
        $result  = Stripe::customers()->delete($customer->getPaymentSystemId());
        return $result['deleted'];
    }
}