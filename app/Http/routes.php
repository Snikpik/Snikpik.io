<?php

Route::group([
    'domain' => env('MAIN_DOMAIN')
], function () {

    Route::get('/', 'WelcomeController@show');
    Route::get('/home', 'HomeController@show');

    Route::get('/test', function() {
       dd(\Snikpik\AllowedDomain::all()->pluck('domain')->toArray());
    });

    Route::get('/demo', 'API\v1\SnikpikController@snikpik');

});
