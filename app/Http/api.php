<?php

Route::group([
    'domain' => env('API_DOMAIN'),
    'prefix' => 'v1',
    'middleware' => ['cors', 'auth:api', 'api'],
    'namespace' => 'API\v1'
], function () {

    Route::get('preview', 'SnikpikController@preview')->name('api.snikpik');

});
