<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register the API routes for your application as
| the routes are automatically authenticated using the API guard and
| loaded automatically by this application's RouteServiceProvider.
|
*/

Route::group([
    'domain' => env('API_DOMAIN'),
    'prefix' => 'v1',
    'middleware' => ['auth:api', 'api'],
    'namespace' => 'API\v1'
], function () {

    Route::get('snikpik', 'SnikpikController@snikpik');

});
