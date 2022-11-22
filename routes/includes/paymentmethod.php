<?php

use Illuminate\Support\Facades\Route;

Route::get('/paymentmethod', 'PaymentMethodController@index');
Route::get('/paymentmethod/{id}', 'PaymentMethodController@show');
Route::post('/paymentmethod', 'PaymentMethodController@store');
Route::post('/paymentmethod/{id}', 'PaymentMethodController@edit');
Route::delete('/paymentmethod/{id}', 'PaymentMethodController@destroy');


