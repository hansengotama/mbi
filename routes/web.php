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
Route::auth();

Route::get('/', 'VueController@index');
Route::get('/login', 'VueController@index');
Route::get('/logout', 'VueController@index');

Route::prefix('district')->group(function () {
    Route::get('/add', 'VueController@index');
    Route::get('/edit', 'VueController@index');
    Route::get('/management', 'VueController@index');
});

Route::prefix('region')->group(function () {
    Route::get('/add', 'VueController@index');
    Route::get('/edit', 'VueController@index');
    Route::get('/management', 'VueController@index');
});

Route::prefix('admin')->group(function () {
    Route::get('/add', 'VueController@index');
    Route::get('/management', 'VueController@index');
});

Route::prefix('pic-region')->group(function () {
    Route::get('/add', 'VueController@index');
    Route::get('/management', 'VueController@index');
});

Route::prefix('user')->group(function () {
    Route::get('/management', 'VueController@index');
});

Route::prefix('donation')->group(function () {
    Route::get('/add', 'VueController@index');
    Route::get('/edit', 'VueController@index');
    Route::get('/management', 'VueController@index');
});

Route::prefix('vihara')->group(function () {
    Route::get('/add', 'VueController@index');
    Route::get('/edit', 'VueController@index');
    Route::get('/management', 'VueController@index');
});

Route::prefix('event')->group(function () {
    Route::get('/add', 'VueController@index');
    Route::get('/edit', 'VueController@index');
    Route::get('/management', 'VueController@index');
});

Route::prefix('deceased')->group(function () {
    Route::get('/add', 'VueController@index');
    Route::get('/edit', 'VueController@index');
    Route::get('/management', 'VueController@index');
});

Route::prefix('request-ktub')->group(function () {
    Route::get('/management', 'VueController@index');
});
