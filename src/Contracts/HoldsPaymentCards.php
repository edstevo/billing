<?php
/**
 *  Copyright (c) 2016.
 *  This was created by Ed Stephenson (edward@flowflex.com).
 *  You must get permission to use this work.
 */

namespace EdStevo\Billing\Contracts;

interface HoldsPaymentCards
{

    /**
     * Get the cards associated with this user from the database
     *
     * @return \Illuminate\Support\Collection
     */
    public function getCards() : Collection;

    /**
     * Store a new card in the billing system for this customer
     *
     * @param string $token
     *
     * @return \App\Models\PaymentCard
     */
    public function storeCard(string $token) : PaymentCard;

    /**
     * Remove a card from storage and the billing system
     *
     * @param \App\Models\PaymentCard $card
     *
     * @return bool
     */
    public function deleteCard(PaymentCard $card) : bool;
}