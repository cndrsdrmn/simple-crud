<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['prefix' => 'auth'], function () {
   Route::get('login', 'AuthController@formLogin')->name('login')->middleware('guest:web');
   Route::post('login', 'AuthController@login')->name('do.login')->middleware('guest:web');
   Route::delete('logout', 'AuthController@logout')->middleware('auth:web')->name('logout');
});

Route::get('/', 'DashboardController@index')->middleware('auth:web')->name('dashboard');
