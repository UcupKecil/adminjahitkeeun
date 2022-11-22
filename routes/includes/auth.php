<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'guest',
], function() {
    Route::get('/', 'AuthController@view');
    Route::post('/', 'AuthController@login')->name('login');
});

Route::group([
    'middleware' => 'auth',
], function() {
    Route::get('/logout', 'AuthController@logout');
});
