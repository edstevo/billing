<?php
/**
 *  Copyright (c) 2016.
 *  This was created by Ed Stephenson (edward@flowflex.com).
 *  You must get permission to use this work.
 */

namespace Tests\Helpers\Billing;

use EdStevo\Billing\Models\PaymentCard;

trait MockBilling
{

    public function setUp()
    {
        parent::setUp();

        $this->billingCard         = $this->mock('EdStevo\Billing\Contracts\Card');
        $this->billingCharge       = $this->mock('EdStevo\Billing\Contracts\Charge');
        $this->billingCustomer     = $this->mock('EdStevo\Billing\Contracts\Customer');
        $this->billingRefund       = $this->mock('EdStevo\Billing\Contracts\Refund');
        $this->billingToken        = $this->mock('EdStevo\Billing\Contracts\Token');
    }

    public function mockCreateCustomer($times = 1)
    {
        return $this->billingCustomer->shouldReceive('create')->andReturn([
            'id' => 'cus_9MocSpzVMdsEEl'
        ]);
    }

    public function mockCreateToken($times = 1)
    {
        return $this->billingToken->shouldReceive('create')->times($times)->andReturn([
            "id" => "tok_189fVC2eZvKYlo2Chd6lTuT4",
            "object" => "token",
            "card" => [
                "id" => "card_189fVC2eZvKYlo2CGr6IrP56",
                "object" => "card",
                "address_city" => null,
                "address_country" => null,
                "address_line1" => null,
                "address_line1_check" => null,
                "address_line2" => null,
                "address_state" => null,
                "address_zip" => null,
                "address_zip_check" => null,
                "brand" => "Visa",
                "country" => "US",
                "cvc_check" => null,
                "dynamic_last4" => null,
                "exp_month" => 8,
                "exp_year" => 2017,
                "funding" => "credit",
                "last4" => "4242",
                "metadata" => [
                ],
                "name" => null,
                "tokenization_method" => null
            ],
            "client_ip" => null,
            "created" => 1462904558,
            "livemode" => false,
            "type" => "card",
            "used" => false
        ]);
    }

    public function mockStoreCard($times = 1)
    {
        $card   = factory(PaymentCard::class)->create();
        return $this->billingCard->shouldReceive('store')->times($times)->andReturn($card);
    }

    public function mockDeleteCard($times = 1)
    {
        return $this->billingCard->shouldReceive('delete')->times($times)->andReturn(true);
    }
}