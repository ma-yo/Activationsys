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
Route::post('/login', 'LoginController@login');
Route::get('/logout', 'LoginController@logout');

Route::get('/menu', 'MenuController@index');

Route::get('/downloadseriallistcsv', 'DownloadCsvController@downloadseriallistcsv');
Route::get('/createserialcsvdownload', 'DownloadCsvController@downloadcreatedseriallistcsv');

Route::get('/genserial', 'GenSerialController@index');
Route::post('/createserial', 'GenSerialController@create');

Route::get('/delserial', 'DelSerialController@index');
Route::post('/deleteserial', 'DelSerialController@delete');
Route::post('/searchserial', 'DelSerialController@search');

Route::get('/activate', 'ActivateController@activate');
Route::get('/deactivate', 'ActivateController@deactivate');
