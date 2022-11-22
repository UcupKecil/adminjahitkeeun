<?php

use Illuminate\Support\Facades\Route;

Route::get('/servicecategory', 'ServiceCategoryController@index');
Route::get('/servicecategory/{id}', 'ServiceCategoryController@show');
Route::post('/servicecategory', 'ServiceCategoryController@store');
Route::post('/servicecategory/{id}', 'ServiceCategoryController@edit');
Route::delete('/servicecategory/{id}', 'ServiceCategoryController@destroy');


