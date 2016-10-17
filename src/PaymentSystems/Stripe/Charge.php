<?php
/**
 *  Copyright (c) 2016.
 *  This was created by Ed Stephenson (edward@flowflex.com).
 *  You must get permission to use this work.
 */

namespace EdStevo\Billing\PaymentSystems\Stripe;

use Cartalyst\Stripe\Laravel\Facades\Stripe;
use EdStevo\Billing\Contracts\Charge as ChargeContract;
use EdStevo\Billing\Contracts\IsChargable;
use EdStevo\Billing\Models\PaymentCard;

class Charge implements ChargeContract
{

    /**
     * Create a charge for an unknown customer
     *
     * @param string $token
     * @param float  $amount
     * @param string $currency
     *
     * @return mixed
     */
    public function chargeUnknown(string $token, float $amount, string $currency = 'GBP')
    {
        $charge     = Stripe::charges()->create([
            'source'    => $token,
            'amount'    => $amount,
            'currency'  => $currency
        ]);

        return $this->decodeCharge($charge);
    }

    /**
     * Charge a known customer, with the option of specifying which card to charge.
     *
     * @param \EdStevo\Billing\Contracts\IsChargable   $customer
     * @param float                                    $amount
     * @param \EdStevo\Billing\Models\PaymentCard|NULL $card
     * @param string                                   $currency
     *
     * @return array
     */
    public function chargeCustomer(IsChargable $customer, float $amount, PaymentCard $card = null, string $currency = 'GBP') : array
    {
        $charge     = Stripe::charges()->create([
            'customer'  => $customer->getPaymentSystemId(),
            'source'    => ($card) ? $card->payment_id : null,
            'amount'    => $amount,
            'currency'  => $currency
        ]);

        return $this->decodeCharge($charge);
    }

    /**
     * Return the useful information from the charge array
     *
     * @param $charge
     *
     * @return array
     */
    private function decodeCharge($charge)
    {
        return [
            'id'        => $charge['id'],
            'created'   => $charge['created'],
            'paid'      => $charge['paid'],
            'status'    => $charge['status']
        ];
    }
}