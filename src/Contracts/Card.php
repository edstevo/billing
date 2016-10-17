<?php
/**
 *  Copyright (c) 2016.
 *  This was created by Ed Stephenson (edward@flowflex.com).
 *  You must get permission to use this work.
 */

namespace EdStevo\Billing\Contracts;

use EdStevo\Billing\Models\PaymentCard;

interface Card
{

    /**
     * Retrieve a card from the billing system
     *
     * @param \EdStevo\Billing\Contracts\IsChargable $customer
     * @param \EdStevo\Billing\Models\PaymentCard    $card
     *
     * @return mixed
     */
    public function find(IsChargable $customer, PaymentCard $card);

    /**
     * Put a new card in the billing system and return a payment card
     *
     * @param \EdStevo\Billing\Contracts\IsChargable $customer
     * @param string                                 $token
     *
     * @return mixed
     */
    public function store(IsChargable $customer, string $token);

    /**
     * Remove a card from the billing system
     *
     * @param \EdStevo\Billing\Contracts\IsChargable $customer
     * @param \EdStevo\Billing\Models\PaymentCard    $card
     *
     * @return mixed
     */
    public function delete(IsChargable $customer, PaymentCard $card);
}