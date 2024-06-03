<?php

use App\Helpers\Route;

Route::get('/users', 'UsersController@index');
Route::get('/', 'UsersController@index');
Route::get('/users/create', 'UsersController@create');
Route::post('/users', 'UsersController@store');

Route::get('/api/users/{id}', 'UsersController@show');
Route::delete('/api/users/{id}', 'UsersController@destroy');