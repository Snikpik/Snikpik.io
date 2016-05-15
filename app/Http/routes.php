<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group([
    'domain' => env('MAIN_DOMAIN')
], function() {

    Route::get('/', 'WelcomeController@show');
    Route::get('/home', 'HomeController@show');

});
