<?php

/**
 *  Copyright (c) 2016.
 *  This was created by Ed Stephenson (edward@flowflex.com).
 *  You must get permission to use this work.
 */

namespace EdStevo\Billing\Tests\Chargeable;

use EdStevo\Billing\Tests\BillingTestCase;
use EdStevo\Billing\Tests\Helpers\StripeTest;

class BillableChargeTest extends BillingTestCase
{
    use StripeTest;

    public function testChargeCustomerDefaultCard()
    {
        $testCustomer   = factory(config('billing.customer_model'))->create();
        $token          = $this->generateOkVisa();

        $testCustomer->storeCard($token['id']);

        $charge         = $testCustomer->charge(10.00);

        $this->assertArrayHasKey('id', $charge);
        $this->assertArrayHasKey('created', $charge);
        $this->assertArrayHasKey('paid', $charge);
        $this->assertArrayHasKey('status', $charge);

        $this->assertTrue($charge['paid']);
    }

    public function testChargeCustomerOtherCard()
    {
        $testCustomer   = factory(config('billing.customer_model'))->create();

        $token          = $this->generateOkVisa();
        $testCustomer->storeCard($token['id']);

        $token          = $this->generateOkMasterCard();
        $card           = $testCustomer->storeCard($token['id']);

        $charge         = $testCustomer->charge(10.00, $card);

        $this->assertArrayHasKey('id', $charge);
        $this->assertArrayHasKey('created', $charge);
        $this->assertArrayHasKey('paid', $charge);
        $this->assertArrayHasKey('status', $charge);

        $this->assertTrue($charge['paid']);
    }
}
