<?php

namespace PrinceRai\CustomAuth;

use Illuminate\Support\ServiceProvider;

class CustomAuthServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Load package controllers
        $this->app->make('PrinceRai\CustomAuth\Controllers\RegisterController');
        $this->app->make('PrinceRai\CustomAuth\Controllers\LoginController');
    }

    public function boot()
    {
        // Load Routes
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');

        // Load Views
        $this->loadViewsFrom(__DIR__.'/views', 'custom-auth');

        // Allow users to publish views
        $this->publishes([
            __DIR__.'/views' => resource_path('views/custom-auth'),
        ], 'custom-auth-views');
    }
}
