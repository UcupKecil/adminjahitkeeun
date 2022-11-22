<?php

use Illuminate\Support\Facades\Route;

Route::get('/shippingmethod', 'ShippingMethodController@index');
Route::get('/shippingmethod/{id}', 'ShippingMethodController@show');
Route::post('/shippingmethod', 'ShippingMethodController@store');
Route::post('/shippingmethod/{id}', 'ShippingMethodController@edit');
Route::delete('/shippingmethod/{id}', 'ShippingMethodController@destroy');


