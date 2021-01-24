<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group(['prefix' => 'v1', 'namespace' => 'API', 'as' => 'api.'], function () {
    Route::group(['prefix' => 'auth', 'as' => 'auth.'], function () {
        Route::post('login', 'AuthController@login')->name('login');
        Route::delete('logout', 'AuthController@logout')->name('logout')->middleware('auth:api');
    });

    Route::group(['prefix' => 'user', 'as' => 'user.', 'middleware' => 'auth:api'], function () {
        Route::get('/', 'UserController@index')->name('index');
        Route::get('detail/{id}', 'UserController@show')->name('show');
        Route::put('upsert/{id?}', 'UserController@upsert')->name('upsert');
        Route::delete('remove/{id}', 'UserController@destroy')->name('destroy');
    });
});
