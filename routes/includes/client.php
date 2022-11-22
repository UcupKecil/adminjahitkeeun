<?php

use Illuminate\Support\Facades\Route;

Route::get('/client', 'ClientController@index');
Route::get('/client/{id}', 'ClientController@show');
Route::post('/client', 'ClientController@store');
Route::post('/client/{id}', 'ClientController@edit');
Route::delete('/client/{id}', 'ClientController@destroy');


