<?php
/**
 *  Copyright (c) 2016.
 *  This was created by Ed Stephenson (edward@flowflex.com).
 *  You must get permission to use this work.
 */

namespace EdStevo\Billing\Helpers;

use EdStevo\Billing\Models\PaymentCard;

trait IsChargable
{

    /**
     * Retrieve the billing charge repository
     *
     * @return \EdStevo\Billing\Contracts\Charge
     */
    private function billingChargeRepository()
    {
        return app()->make('EdStevo\Billing\Contracts\Charge');
    }

    /**
     * Define relationship between the customer and the payment cards
     *
     * @return mixed
     */
    public function cards()
    {
        return $this->hasMany(PaymentCard::class);
    }

    /**
     * Charge this customer for the given amount.
     *
     * @param float       $amount
     * @param string|NULL $source
     *
     * @return array
     */
    public function charge(float $amount, PaymentCard $card = null)
    {
        return $this->billingChargeRepository()->chargeCustomer($this, $amount, $card);
    }
}