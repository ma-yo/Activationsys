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
Route::get('/downloaduserlistcsv', 'DownloadCsvController@downloaduserlistcsv');



Route::get('/genserial', 'GenSerialController@index');
Route::post('/createserial', 'GenSerialController@create');

Route::get('/delserial', 'DelSerialController@index');
Route::post('/deleteserial', 'DelSerialController@delete');
Route::post('/searchserial', 'DelSerialController@search');

Route::get('/activate', 'ActivateController@activate');
Route::get('/deactivate', 'ActivateController@deactivate');

Route::get('/settinginfo','SettingInfoController@index');
Route::post('/updatesettinginfo','SettingInfoController@update');

Route::get('/serialunlock', 'SerialUnlockController@index');
Route::post('/unlockserial', 'SerialUnlockController@unlock');
Route::post('/searchlockserial', 'SerialUnlockController@search');

Route::get('/createuser', 'CreateUserController@index');
Route::post('/usercreate', 'CreateUserController@create');

Route::get('/edituser', 'EditUserController@index');
Route::get('/changeedituser', 'EditUserController@changeuser');
Route::get('/genpasswordedituser', 'EditUserController@genpassword');

Route::post('/updateedituser', 'EditUserController@update');

Route::post('/applicationcreate', 'ApplicationController@create');
Route::get('/createapplication', 'ApplicationController@index');



