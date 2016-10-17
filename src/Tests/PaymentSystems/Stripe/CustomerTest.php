<?php
/**
 *  Copyright (c) 2016.
 *  This was created by Ed Stephenson (edward@flowflex.com).
 *  You must get permission to use this work.
 */

namespace Tests\Utilities\Billing\PaymentSystem;

use EdStevo\Billing\Tests\BillingTestCase;

class CustomerTest extends BillingTestCase
{

    public function testStoreCustomer()
    {
        $testCustomer       = factory(config('billing.customer_model'))->create();
        $this->assertNotNull($testCustomer->payment_id);
    }

    public function testFindCustomer()
    {
        $testCustomer       = factory(config('billing.customer_model'))->create();

        $billingCustomer    = $this->billingCustomer->find($testCustomer);
        $this->assertNotNull($billingCustomer);
    }

    public function testUpdateCustomer()
    {
        $testEmail          = 'yada@fake.com';
        $testCustomer       = factory(config('billing.customer_model'))->create();

        $billingCustomer    = $this->billingCustomer->update($testCustomer, ['email' => $testEmail]);
        $this->assertEquals($billingCustomer['email'], $testEmail);
    }

    public function testDeleteCustomer()
    {
        $testCustomer       = factory(config('billing.customer_model'))->create();
        $billingId          = $testCustomer->payment_id;

        $testCustomer->delete();

        \Stripe\Stripe::setApiKey(config('services.stripe.secret'));
        $billingCustomer    = \Stripe\Customer::retrieve($billingId);
        $this->assertTrue($billingCustomer->deleted);
    }
}
