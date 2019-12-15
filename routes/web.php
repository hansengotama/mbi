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

Route::get('/', 'VueController@index');
Route::get('/login', 'VueController@index');
Route::get('/logout', 'VueController@index');

Route::get('/user/add', 'VueController@index');
Route::get('/user/management', 'VueController@index');

Route::get('/region/add', 'VueController@index');
Route::get('/region/management', 'VueController@index');

Route::get('/vihara/add', 'VueController@index');
Route::get('/vihara/management', 'VueController@index');

Route::get('/event/add', 'VueController@index');
Route::get('/event/management', 'VueController@index');

Route::get('/deceased/add', 'VueController@index');
Route::get('/deceased/management', 'VueController@index');

Route::get('/donation/add', 'VueController@index');
Route::get('/donation/management', 'VueController@index');

Route::get('/request-ktub/add', 'VueController@index');
Route::get('/request-ktub/management', 'VueController@index');

