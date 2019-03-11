<?php

namespace LaPress\GetResponse;

use Illuminate\Support\ServiceProvider;
/**
 * @author    Sebastian Szczepański
 * @copyright ably
 */
class GetResponseServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
    }
}
