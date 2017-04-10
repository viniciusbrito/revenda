<?php

namespace Revenda\Providers;

use Illuminate\Support\ServiceProvider;
use Revenda\CPanel\WHM;

class WHMServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(WHM::class, function($app) {
            return new WHM(env('CPANEL_HOST'), env('CPANEL_USER'), env('CPANEL_PASSWORD'));
        });
    }
}
