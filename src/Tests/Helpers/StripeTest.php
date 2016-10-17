<?php
/**
 *  Copyright (c) 2016.
 *  This was created by Ed Stephenson (edward@flowflex.com).
 *  You must get permission to use this work.
 */

namespace EdStevo\Billing\Helpers;

trait StripeTest
{

    public function generateOkVisa()
    {
        $stripeToken    = app()->make('EdStevo\Billing\Contracts\Token');
        return $stripeToken->create(4242424242424242, 10, 2017, 314);
    }

    public function generateOkVisaDebit()
    {
        $stripeToken    = app()->make('EdStevo\Billing\Contracts\Token');
        return $stripeToken->create(4000056655665556, 10, 2017, 314);
    }

    public function generateOkMasterCard()
    {
        $stripeToken    = app()->make('EdStevo\Billing\Contracts\Token');
        return $stripeToken->create(5555555555554444, 10, 2017, 314);
    }

    public function generateOkMasterCardDebit()
    {
        $stripeToken    = app()->make('EdStevo\Billing\Contracts\Token');
        return $stripeToken->create(5200828282828210, 10, 2017, 314);
    }

    public function generateOkMasterCardPrepaid()
    {
        $stripeToken    = app()->make('EdStevo\Billing\Contracts\Token');
        return $stripeToken->create(5105105105105100, 10, 2017, 314);
    }

    public function generateOkAmex()
    {
        $stripeToken    = app()->make('EdStevo\Billing\Contracts\Token');
        return $stripeToken->create(378282246310005, 10, 2017, 314);
    }


    public function generateFailCardDeclined()
    {
        $stripeToken    = app()->make('EdStevo\Billing\Contracts\Token');
        return $stripeToken->create(4000000000000002, 10, 2017, 314);
    }

    public function generateFailCardDeclinedFraud()
    {
        $stripeToken    = app()->make('EdStevo\Billing\Contracts\Token');
        return $stripeToken->create(4100000000000019, 10, 2017, 314);
    }

    public function generateFailCardDeclinedIncorrectCvc()
    {
        $stripeToken    = app()->make('EdStevo\Billing\Contracts\Token');
        return $stripeToken->create(4000000000000127, 10, 2017, 314);
    }

    public function generateFailCardDeclinedExpiredCard()
    {
        $stripeToken    = app()->make('EdStevo\Billing\Contracts\Token');
        return $stripeToken->create(4000000000000069, 10, 2017, 314);
    }

    public function generateFailCardDeclinedProcessingError()
    {
        $stripeToken    = app()->make('EdStevo\Billing\Contracts\Token');
        return $stripeToken->create(4000000000000119, 10, 2017, 314);
    }
}