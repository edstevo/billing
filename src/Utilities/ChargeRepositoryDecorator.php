<?php
/**
 *  Copyright (c) 2016.
 *  This was created by Ed Stephenson (edward@flowflex.com).
 *  You must get permission to use this work.
 */

namespace EdStevo\Billing\Utilities;


use EdStevo\Billing\Contracts\Charge;
use EdStevo\Billing\Contracts\IsChargable;
use EdStevo\Billing\Models\PaymentCard;

class ChargeRepositoryDecorator implements Charge
{
    protected $charge;

    public function __construct(Charge $charge)
    {
        $this->charge           = $charge;
    }

    /**
     * Create a charge for an unknown customer
     *
     * @param string $token
     * @param float  $amount
     * @param string $currency
     *
     * @return array
     */
    public function chargeUnknown(string $token, float $amount, string $currency = 'GBP')
    {
        return $this->charge->chargeUnknown($token, $amount, $currency);
    }

    /**
     * Charge a known customer, with the option of specifying which card to charge.
     *
     * @param \EdStevo\Billing\Contracts\IsChargable   $customer
     * @param float                                    $amount
     * @param \EdStevo\Billing\Models\PaymentCard|NULL $card
     * @param string                                   $currency
     *
     * @return mixed
     */
    public function chargeCustomer(IsChargable $customer, float $amount, PaymentCard $card = NULL, string $currency = 'GBP')
    {
        return $this->charge->chargeCustomer($customer, $amount, $card, $currency);
    }
}