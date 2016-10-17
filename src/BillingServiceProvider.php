<?php
/**
 *  Copyright (c) 2016.
 *  This was created by Ed Stephenson (edward@flowflex.com).
 *  You must get permission to use this work.
 */

namespace EdStevo\Billing;

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
}