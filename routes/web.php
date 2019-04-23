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