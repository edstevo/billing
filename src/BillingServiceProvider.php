<?php
/**
 *  Copyright (c) 2016.
 *  This was created by Ed Stephenson (edward@flowflex.com).
 *  You must get permission to use this work.
 */

namespace EdStevo\Billing;

use EdStevo\Billing\PaymentSystems\Stripe\Charge as StripeChargeRepository;
use EdStevo\Billing\PaymentSystems\Stripe\Token as StripeTokenRepository;
use Illuminate\Support\ServiceProvider;

class BillingServiceProvider extends ServiceProvider
{

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/Database/migrations');
        $this->publishes([
            __DIR__.'/config.php' => config_path('billing.php'),
        ]);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {

        $this->app->bind('EdStevo\Billing\Contracts\Charge', function() {

            if(config('billing.driver') == 'stripe')
            {
                return new StripeChargeRepository();
            }

            throw new \Exception("Driver Either Not Defined or Not Supported.");
        });

        $this->app->bind('EdStevo\Billing\Contracts\Token', function() {

            if(config('billing.driver') == 'stripe')
            {
                return new StripeTokenRepository();
            }

            throw new \Exception("Driver Either Not Defined or Not Supported.");
        });
    }
}