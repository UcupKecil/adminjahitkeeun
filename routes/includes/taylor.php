<?php

use Illuminate\Support\Facades\Route;

Route::get('/taylor', 'TaylorController@index');
Route::get('/taylor/{id}', 'TaylorController@show');
Route::post('/taylor', 'TaylorController@store');
Route::post('/taylor/{id}', 'TaylorController@edit');
Route::delete('/taylor/{id}', 'TaylorController@destroy');


