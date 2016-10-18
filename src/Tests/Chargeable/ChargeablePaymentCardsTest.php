<?php
/**
 *  Copyright (c) 2016.
 *  This was created by Ed Stephenson (edward@flowflex.com).
 *  You must get permission to use this work.
 */

namespace Tests\Utilities\Billing\Billable;

use EdStevo\Billing\Tests\BillingTestCase;
use EdStevo\Billing\Tests\Helpers\StripeTest;
use Tests\Helpers\Billing\MockBilling;

class ChargeablePaymentCardsTest extends BillingTestCase
{
    use MockBilling, StripeTest;

    public function testStoreCards()
    {
        $testCustomer   = factory(config('billing.customer_model'))->create();
        $token          = $this->generateOkVisa();

        $this->notSeeInDatabase('payment_cards', ['customer_id' => $testCustomer->id]);

        $testCustomer->storeCard($token['id']);

        $this->seeInDatabase('payment_cards', ['customer_id' => $testCustomer->id]);
    }

    public function testGetCards()
    {
        $testCustomer   = factory(config('billing.customer_model'))->create();
        $testCards      = $this->paymentCard->generateMultiple(3, ['customer_id' => $testCustomer->id]);

        $cards          = $testCustomer->getCards();

        foreach($cards as $card)
        {
            $this->assertTrue(in_array($card->id, $testCards->pluck('id')->toArray()));
        }
    }

    public function testDeleteCards()
    {
        $testCustomer   = factory(config('billing.customer_model'))->create();
        $token          = $this->generateOkVisa();

        $this->notSeeInDatabase('payment_cards', ['customer_id' => $testCustomer->id]);

        $card           = $testCustomer->storeCard($token['id']);

        $this->seeInDatabase('payment_cards', ['customer_id' => $testCustomer->id]);

        $result         = $testCustomer->deleteCard($card);

        $this->assertTrue($result);
        $this->notSeeInDatabase('payment_cards', ['customer_id' => $testCustomer->id]);
    }
}
