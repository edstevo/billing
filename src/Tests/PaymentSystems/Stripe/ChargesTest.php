<?php
/**
 *  Copyright (c) 2016.
 *  This was created by Ed Stephenson (edward@flowflex.com).
 *  You must get permission to use this work.
 */

namespace Tests\Utilities\Billing\PaymentSystem;

use EdStevo\Billing\Tests\Helpers\StripeTest;
use EdStevo\Billing\Tests\BillingTestCase;

class ChargesTest extends BillingTestCase
{
    use StripeTest;

    public function testChargeUnknownCustomer()
    {
        $token      = $this->generateOkVisa();
        $charge     = $this->billingCharge->chargeUnknown($token['id'], 10.00);

        $this->assertArrayHasKey('id', $charge);
        $this->assertArrayHasKey('created', $charge);
        $this->assertArrayHasKey('paid', $charge);
        $this->assertArrayHasKey('status', $charge);
    }

}