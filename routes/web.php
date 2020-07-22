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

Route::get('/', 'LoginController@index');
Route::post('/login', 'LoginController@index');
Route::post('/logout', 'LoginController@logout');
Route::post('/menu', 'MenuController@index');
Route::get('/downloadcsv', 'DownloadCsvController@index');
Route::post('/genserial', 'GenSerialController@index');
Route::post('/delserial', 'DelSerialController@index');
Route::get('/activate', 'ActivateController@activate');
