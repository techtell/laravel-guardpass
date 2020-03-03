<?php

use Sivanov\LaravelGuardPass\Http\Middleware\StringToArray;

Route::group(['prefix' => '/guardpass', 'middleware' => 'web'], function () {
    Route::get('/user/{user}', 'Sivanov\LaravelGuardPass\Http\Controllers\Controller@assumeIdentity');

    Route::group(['middleware' => StringToArray::class], function () {
        Route::get('/', 'Sivanov\LaravelGuardPass\Http\Controllers\Controller@index');
        Route::get('/columns:{StringToArray}', 'Sivanov\LaravelGuardPass\Http\Controllers\Controller@index');
        Route::get('/json/columns:{StringToArray}', 'Sivanov\LaravelGuardPass\Http\Controllers\Controller@show');
    });
});
