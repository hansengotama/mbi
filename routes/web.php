<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::namespace('API')->prefix('api/')->group(function () {
    Route::get('login', 'UserController@login');

    Route::prefix('user')->group(function () {
        Route::post('/create', 'UserController@create');
        Route::get('/find/{id}', 'UserController@find');
        Route::post('/update/{id}', 'UserController@update');
        Route::post('/delete/{id}', 'UserController@delete');
        Route::get('/', 'UserController@get');
    });
});

