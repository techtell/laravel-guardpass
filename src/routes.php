<?php

use Techtell\LaravelGuardPass\Http\Middleware\StringToArray;

Route::group(['prefix' => '/guardpass', 'middleware' => 'web'], function () {
    Route::get('/user/{user}', 'Techtell\LaravelGuardPass\Http\Controllers\Controller@assumeIdentity');

    Route::group(['middleware' => StringToArray::class], function () {
        Route::get('/', 'Techtell\LaravelGuardPass\Http\Controllers\Controller@index');
        Route::get('/columns:{StringToArray}', 'Techtell\LaravelGuardPass\Http\Controllers\Controller@index');
        Route::get('/json/columns:{StringToArray}', 'Techtell\LaravelGuardPass\Http\Controllers\Controller@show');
    });
});
