<?php

use Illuminate\Support\Facades\Route;

Route::get('/convection', 'ConvectionController@index');
Route::get('/convection/{id}', 'ConvectionController@show');
Route::post('/convection', 'ConvectionController@store');
Route::post('/convection/{id}', 'ConvectionController@edit');
Route::delete('/convection/{id}', 'ConvectionController@destroy');


