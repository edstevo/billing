<?php
/**
 *  Copyright (c) 2016.
 *  This was created by Ed Stephenson (edward@flowflex.com).
 *  You must get permission to use this work.
 */

namespace EdStevo\Billing\PaymentSystems\Stripe;

use Cartalyst\Stripe\Laravel\Facades\Stripe;
use EdStevo\Billing\Contracts\Card as CardContract;
use EdStevo\Billing\Contracts\IsChargable;
use EdStevo\Billing\Models\PaymentCard;

class Card implements CardContract
{

    /**
     * Retrieve a card from the payment system
     *
     * @param \EdStevo\Billing\Contracts\IsChargable $customer
     * @param \EdStevo\Billing\Models\PaymentCard    $card
     *
     * @return array
     */
    public function find(IsChargable $customer, PaymentCard $card) : array
    {
        $card   = Stripe::cards()->find($customer->getPaymentSystemId(), $card->payment_id);

        return [
            'type'          => $card['brand'],
            'exp_month'     => $card['exp_month'],
            'exp_year'      => $card['exp_year'],
            'last4'         => $card['last4'],
            'payment_id'    => $card['id']
        ];
    }

    /**
     * Put a new card in the payment system
     *
     * @param \EdStevo\Billing\Contracts\IsChargable $customer
     * @param string                                 $token
     *
     * @return \EdStevo\Billing\Models\PaymentCard
     */
    public function store(IsChargable $customer, string $token) : PaymentCard
    {
        $card   = Stripe::cards()->create($customer->getPaymentSystemId(), $token);

        return PaymentCard::create([
            'customer_id'   => $customer->getId(),
            'type'          => $card['brand'],
            'exp_month'     => $card['exp_month'],
            'exp_year'      => $card['exp_year'],
            'last4'         => $card['last4'],
            'payment_id'    => $card['id']
        ]);
    }

    /**
     * Remove a card from the payment system
     *
     * @param \EdStevo\Billing\Contracts\IsChargable $customer
     * @param \EdStevo\Billing\Models\PaymentCard    $card
     *
     * @return bool
     */
    public function delete(IsChargable $customer, PaymentCard $card) : bool
    {
        $result = Stripe::cards()->delete($customer->getPaymentSystemId(), $card->payment_id);
        return $result['deleted'];
    }
}