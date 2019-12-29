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

Route::namespace('API')->group(function () {
    Route::post('/login', 'UserController@login');

    Route::middleware('auth:api')->group(function () {
        Route::get('/user/check', 'UserController@check');
        Route::post('/logout', 'UserController@logout');

        Route::prefix('assets')->group(function () {
            Route::post('/upload', 'AssetController@upload');
            Route::post('/remove', 'AssetController@remove');
        });

        Route::middleware('isSuperAdmin')->group(function () {
            Route::prefix('district')->group(function () {
                Route::get('/', 'DistrictController@get');
                Route::get('/{id}', 'DistrictController@find');
                Route::post('/create', 'DistrictController@create');
                Route::post('/update/{id}', 'DistrictController@update');
                Route::post('/delete/{id}', 'DistrictController@delete');
            });
        });

        Route::middleware('isAdmin')->group(function () {
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
                Route::post('/delete/{id}', 'RegionController@delete');
            });

            Route::prefix('request-ktub')->group(function () {
                Route::get('/', 'RequestKtubController@get');
                Route::get('/{id}', 'RequestKtubController@find');
                Route::post('/create', 'RequestKtubController@create');
                Route::post('/update/{id}', 'RequestKtubController@update');
                Route::post('/delete/{id}', 'RequestKtubController@delete');
            });

            Route::prefix('donation')->group(function () {
                Route::post('/create', 'DonationController@create');
                Route::post('/update/{id}', 'DonationController@update');
                Route::post('/delete/{id}', 'DonationController@delete');
                Route::get('/', 'DonationController@get');
                Route::get('/{id}', 'DonationController@find');
            });

            Route::prefix('company-vacancy')->group(function () {
                Route::post('/create', 'CompanyVacancyController@create');
                Route::post('/update/{id}', 'CompanyVacancyController@update');
                Route::post('/delete/{id}', 'CompanyVacancyController@delete');
                Route::get('/', 'CompanyVacancyController@get');
                Route::get('/{id}', 'CompanyVacancyController@find');
            });
        });

        Route::middleware('isAdminOrPicKecamatan')->group(function () {
            Route::prefix('vihara')->group(function () {
                Route::get('/', 'ViharaController@get');
                Route::get('/{id}', 'ViharaController@find');
                Route::post('/create', 'ViharaController@create');
                Route::post('/update/{id}', 'ViharaController@update');
                Route::post('/delete/{id}', 'ViharaController@delete');
            });

            Route::prefix('pandita')->group(function () {
                Route::post('/create', 'PanditaController@create');
                Route::post('/update/{id}', 'PanditaController@update');
                Route::post('/delete/{id}', 'PanditaController@delete');
                Route::get('/', 'PanditaController@get');
                Route::get('/{id}', 'PanditaController@find');
            });

            Route::prefix('event')->group(function () {
                Route::post('/create', 'EventController@create');
                Route::post('/update/{id}', 'EventController@update');
                Route::post('/delete/{id}', 'EventController@delete');
                Route::get('/', 'EventController@get');
                Route::get('/{id}', 'EventController@find');
            });

            Route::prefix('deceased')->group(function () {
                Route::post('/create', 'DeceasedController@create');
                Route::post('/update/{id}', 'DeceasedController@update');
                Route::post('/delete/{id}', 'DeceasedController@delete');
                Route::get('/', 'DeceasedController@get');
                Route::get('/{id}', 'DeceasedController@find');
            });
        });
    });
});
