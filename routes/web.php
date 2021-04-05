<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', 'UserController@index');

Route::get('getEstates', 'EstateController@getEstates');
Route::get('getCities/{estate}', 'CityController@getCities');
Route::get('getFathers', 'UserController@getFathers');

Route::post('create', 'UserController@create');

Route::get('getUsers', 'UserController@getUsers');

Route::delete('delete/{id}', 'UserController@delete');

Route::get('getRecursive/{id}', 'UserController@getRecursive');