<?php
/**
 *  Copyright (c) 2016.
 *  This was created by Ed Stephenson (edward@flowflex.com).
 *  You must get permission to use this work.
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Customer Model
    |--------------------------------------------------------------------------
    |
    | This defines the model which the package will consider the customer.
    |
    | Suggested: \App\Models\Customer::class
    |
    */

    "customer_model"    => \App\Models\Customer::class,

    /*
    |--------------------------------------------------------------------------
    | Payment System Driver
    |--------------------------------------------------------------------------
    |
    | This defines the payment system that the package will use.
    |
    | Supported: "stripe"
    |
    */

    "driver"    => "stripe"

];