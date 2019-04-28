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

Route::get('/', 'MainController@index')->name('dashboard')->middleware('auth');
Route::post('/ajax/get/notice/times', 'MainController@getNoticeTimes')->name('ajax.noticeTimes');
Route::get('/aviso', 'MainController@aviso')->name('aviso')->middleware('auth');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/prueba', 'ImageController@generadorWS')->name('prueba')->middleware('auth');
Route::get('/{categoria}', 'NoticeController@agruparCategoria')->name('categoria')->middleware('auth');
//Route::get('/prueba/3', 'NoticeController@detallesAviso')->name('detalleaviso')->middleware('auth');