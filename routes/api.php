<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->namespace('API')->group(function () {
    Route::post('/login', 'UserController@login');
    Route::post('/logout', 'UserController@logout');

    Route::prefix('user')->group(function () {
        Route::get('/', 'UserController@get');
        Route::get('/{id}', 'UserController@find');
        Route::post('/create', 'UserController@create');
        Route::post('/update/{id}', 'UserController@update');
        Route::post('/delete/{id}', 'UserController@delete');
    });

    Route::prefix('region')->group(function () {
        Route::get('/', 'RegionController@get');
        Route::get('/{id}', 'RegionController@find');
        Route::post('/create', 'RegionController@create');
        Route::post('/update/{id}', 'RegionController@update');
        Route::post('delete/{id}', 'RegionController@delete');
    });

    Route::prefix('vihara')->group(function () {
        Route::get('/', 'ViharaController@get');
        Route::get('/{id}', 'ViharaController@find');
        Route::post('/create', 'ViharaController@create');
        Route::post('/update/{id}', 'ViharaController@update');
        Route::post('delete/{id}', 'ViharaController@delete');
    });
});
