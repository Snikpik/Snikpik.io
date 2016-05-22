<?php

Route::group([
    'domain' => env('MAIN_DOMAIN')
], function () {

    Route::get('/', 'WelcomeController@show');
    Route::get('/home', 'HomeController@show');

    Route::get('/demo', 'API\v1\SnikpikController@snikpik');

});
