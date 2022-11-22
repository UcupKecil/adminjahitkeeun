<?php

use Illuminate\Support\Facades\Route;

Route::get('/addresslabel', 'AddressLabelController@index');
Route::get('/addresslabel/{id}', 'AddressLabelController@show');
Route::post('/addresslabel', 'AddressLabelController@store');
Route::post('/addresslabel/{id}', 'AddressLabelController@edit');
Route::delete('/addresslabel/{id}', 'AddressLabelController@destroy');


