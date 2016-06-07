<?php

Route::group([
    'domain' => env('MAIN_DOMAIN')
], function () {
    // Landing page
    Route::get('/', 'WelcomeController@show');
    Route::get('/demo', 'API\v1\SnikpikController@preview');

    Route::group(['middleware' => ['auth']], function() {
        // Dashboard
        Route::get('/dashboard', 'DashboardController@show')->name('dashboard');

        // Documentation
        Route::group(['prefix' => 'docs', 'namespace' => 'Documentation'], function() {
            Route::get('/', function() {
                return redirect()->route('documentation.v1.index');
            })->name('documentation');
            Route::group(['prefix' => '1.0', 'namespace' => 'v1'], function() {
                Route::get('/', function() {
                    return redirect()->route('documentation.v1.index');
                })->name('documentation.v1');
                Route::get('/', 'DocumentationController@index')->name('documentation.v1.index');
                Route::get('/faq', 'DocumentationController@faq')->name('documentation.v1.faq');
                Route::get('/release-notes', 'DocumentationController@releaseNotes')->name('documentation.v1.release-notes');
            });
        });
    });
});

Route::group([
    'domain' => env('MAIN_DOMAIN'),
    'prefix' => 'internal',
    'middleware' => ['auth:api', 'api'],
    'namespace' => 'API\Internal'
], function () {
    Route::get('requests', 'RequestsController@index');
});