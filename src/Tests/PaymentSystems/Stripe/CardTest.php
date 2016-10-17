<?php
/**
 *  Copyright (c) 2016.
 *  This was created by Ed Stephenson (edward@flowflex.com).
 *  You must get permission to use this work.
 */

namespace Tests\Utilities\Billing\PaymentSystem;

use EdStevo\Billing\Models\PaymentCard;
use EdStevo\Billing\Tests\BillingTestCase;

class CardTest extends BillingTestCase
{

    public function testStore()
    {
        $testCustomer   = factory(config('billing.customer_model'))->create();
        $token          = $this->generateOkVisa();

        $card           = $this->billingCard->store($testCustomer, $token['id']);
        $this->assertTrue($card instanceof PaymentCard);
    }

    public function testFind()
    {
        $testCustomer   = factory(config('billing.customer_model'))->create();
        $token          = $this->generateOkVisa();

        $card           = $this->billingCard->store($testCustomer, $token['id']);

        $card           = $this->billingCard->find($testCustomer, $card);
        $this->assertTrue(is_array($card));
    }

    public function testDelete()
    {
        $testCustomer   = factory(config('billing.customer_model'))->create();
        $token          = $this->generateOkVisa();

        $card           = $this->billingCard->store($testCustomer, $token['id']);

        $result         = $this->billingCard->delete($testCustomer, $card);
        $this->assertTrue($result);
    }
}
