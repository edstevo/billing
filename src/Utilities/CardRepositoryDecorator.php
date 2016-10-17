<?php
/**
 *  Copyright (c) 2016.
 *  This was created by Ed Stephenson (edward@flowflex.com).
 *  You must get permission to use this work.
 */

namespace EdStevo\Billing\Utilities;


use EdStevo\Billing\Contracts\Card;
use EdStevo\Billing\Contracts\IsChargable;
use EdStevo\Billing\Models\PaymentCard;

class CardRepositoryDecorator implements Card
{
    protected $card;

    public function __construct(Card $card)
    {
        $this->card             = $card;
    }

    /**
     * Retrieve a card from the billing system
     *
     * @param \EdStevo\Billing\Contracts\IsChargable $customer
     * @param \EdStevo\Billing\Models\PaymentCard    $card
     *
     * @return mixed
     */
    public function find(IsChargable $customer, PaymentCard $card)
    {
        return $this->card->find($customer, $card);
    }

    /**
     * Put a new card in the billing system and return a payment card
     *
     * @param \EdStevo\Billing\Contracts\IsChargable $customer
     * @param string                                 $token
     *
     * @return mixed
     */
    public function store(IsChargable $customer, string $token)
    {
        $cardData   = $this->card->store($customer, $token);
        return $customer->cards()->create($cardData);
    }

    /**
     * Remove a card from the billing system
     *
     * @param \EdStevo\Billing\Contracts\IsChargable $customer
     * @param \EdStevo\Billing\Models\PaymentCard    $card
     *
     * @return mixed
     */
    public function delete(IsChargable $customer, PaymentCard $card)
    {
        $result = $this->card->delete($customer, $card);

        if ($result)
        {
            return $card->delete();
        }

        return false;
    }
}