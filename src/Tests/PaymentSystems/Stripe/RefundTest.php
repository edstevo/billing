<?php
/**
 *  Copyright (c) 2016.
 *  This was created by Ed Stephenson (edward@flowflex.com).
 *  You must get permission to use this work.
 */

namespace Tests\Utilities\Billing\PaymentSystem;

use EdStevo\Billing\Tests\Helpers\StripeTest;
use EdStevo\Billing\Tests\BillingTestCase;

class RefundTest extends BillingTestCase
{
    use StripeTest;

    public function testCreate()
    {
        $token      = $this->generateOkVisa();
        $charge     = $this->billingCharge->chargeUnknown($token['id'], 10.00);

        $refund     = $this->billingRefund->create($charge['id']);

        $this->assertArrayHasKey('id', $refund);
        $this->assertArrayHasKey('status', $refund);
        $this->assertArrayHasKey('created', $refund);
    }

    public function testRetrieve()
    {
        $token      = $this->generateOkVisa();
        $charge     = $this->billingCharge->chargeUnknown($token['id'], 10.00);

        $refund     = $this->billingRefund->create($charge['id']);
        $this->assertNotNull($refund);
    }
}
