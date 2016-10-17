<?php
/**
 *  Copyright (c) 2016.
 *  This was created by Ed Stephenson (edward@flowflex.com).
 *  You must get permission to use this work.
 */

namespace EdStevo\Billing\PaymentSystems\Stripe;


use Cartalyst\Stripe\Laravel\Facades\Stripe;
use EdStevo\Billing\Contracts\Refund as RefundContract;

class Refund implements RefundContract
{

    /**
     * Create a new refund in the billing system
     *
     * @param string $charge_id
     *
     * @return array
     */
    public function create(string $charge_id)
    {
        $refund     = Stripe::refunds()->create($charge_id);

        return [
            'id'        => $refund['id'],
            'created'   => $refund['created'],
            'status'    => $refund['status']
        ];
    }

    /**
     * Retrieve a refund record from the billing system
     *
     * @param string $charge_id
     * @param string $refund_id
     *
     * @return array
     */
    public function retrieve(string $charge_id, string $refund_id)
    {
        return Stripe::refunds()->find($charge_id, $refund_id);
    }
}