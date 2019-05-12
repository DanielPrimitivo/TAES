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
Route::get('/histroico/historicomes', 'MainController@historic')->name('historic')->middleware('auth');
Route::post('/ajax/get/notice/times', 'MainController@getNoticeTimes')->name('ajax.noticeTimes');
Route::post('/ajax/get/all/images', 'MainController@getAllImages')->name('ajax.Images');
Route::post('/ajax/get/notice/images', 'MainController@getNoticeImages')->name('ajax.noticeImages');
Route::post('/ajax/get/notice/pending', 'MainController@getPendingNotices')->name('ajax.pendingNotices');
Route::post('/ajax/get/notice', 'MainController@getNotices')->name('ajax.notices');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/prueba', 'ImageController@generadorWS')->name('prueba')->middleware('auth');
Route::get('/{categoria}', 'NoticeController@agruparCategoria')->name('categoria')->middleware('auth');
Route::get('aviso/{id}', 'NoticeController@detallesAviso')->name('aviso')->middleware('auth');
Route::get('archivar/{id}', 'NoticeController@archivar')->name('archivarAviso')->middleware('auth');
Route::get('aviso/visto/{id}', 'NoticeController@marcarVisto')->name('visto')->middleware('auth');
Route::get('aviso/eliminar/{id}', 'NoticeController@deleteNOT')->name('eliminar')->middleware('auth');
Route::post('aviso/nuevaCategoria', 'NoticeController@cambiarCategoria')->name('cambiarCategoria')->middleware('auth');
Route::post('senders/updateCat', 'SenderController@updateCat')->name('updateCat')->middleware('auth');
Route::get('senders/manage', 'MainController@administrarSenders')->name('manageSenders')->middleware('auth');
//Route::get('/prueba/3', 'NoticeController@detallesAviso')->name('detalleaviso')->middleware('auth');
