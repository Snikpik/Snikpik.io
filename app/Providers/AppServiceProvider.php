<?php

namespace Snikpik\Providers;

use Validator;
use Illuminate\Support\ServiceProvider;
use Laravel\Spark\Token;
use Snikpik\Observers\TokenObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Token::observe(TokenObserver::class);

        Validator::extend('domain', function($attribute, $value, $parameters, $validator) {
            return preg_match(
                '/^(([a-zA-Z0-9\*]|[a-zA-Z0-9][a-zA-Z0-9\-]*[a-zA-Z0-9])\.)*([A-Za-z0-9]|[A-Za-z0-9][A-Za-z0-9\-]*[A-Za-z0-9])$/',
                $value
            );
        });

        if(app()->environment() === "production") {
            config(['cors.allowedOrigins' => \Snikpik\AllowedDomain::all()->pluck('domain')->toArray()]);
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
