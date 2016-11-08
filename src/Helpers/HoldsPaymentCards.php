<?php
/**
 *  Copyright (c) 2016.
 *  This was created by Ed Stephenson (edward@flowflex.com).
 *  You must get permission to use this work.
 */

namespace EdStevo\Billing\Helpers;

use EdStevo\Billing\Models\PaymentCard;
use Illuminate\Support\Collection;

trait HoldsPaymentCards
{

    /**
     * Retrieve the billing card repository
     *
     * @return \EdStevo\Billing\Contracts\Card
     */
    private function billingCardRepository()
    {
        return app()->make('EdStevo\Billing\Contracts\Card');
    }

    /**
     * Get the cards associated with this user from the database
     *
     * @return \Illuminate\Support\Collection
     */
    public function getCards() : Collection
    {
        return $this->cards;
    }

    /**
     * Store a new card in the billing system for this customer
     *
     * @param string $token
     *
     * @return \EdStevo\Billing\Models\PaymentCard
     */
    public function storeCard(string $token) : PaymentCard
    {
        return $this->billingCardRepository()->store($this, $token);
    }

    /**
     * Remove a card from storage and the billing system
     *
     * @param \EdStevo\Billing\Models\PaymentCard $card
     *
     * @return bool
     */
    public function deleteCard(PaymentCard $card) : bool
    {
        return $this->billingCardRepository()->delete($this, $card);
    }
}