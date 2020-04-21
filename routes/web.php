<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('suratmasuk', 'SuratMasukController@index')->name('suratmasuk');
Route::get('suratmasuk/tambah', 'SuratMasukController@tambah');
Route::post('suratmasuk/store', 'SuratMasukController@store');
Route::get('suratmasuk/edit/{id_suratmasuk}', 'SuratMasukController@edit');
Route::put('suratmasuk/update/{id_suratmasuk}', 'SuratMasukController@update');
Route::get('suratmasuk/hapus/{id_suratmasuk}', 'SuratMasukController@delete');

Route::resource('jenissurat', 'JenisSuratController');

Route::get('suratkeluar', 'SuratKeluarController@index')->name('suratkeluar');
Route::get('suratkeluar/tambah', 'SuratKeluarController@tambah');
Route::post('suratkeluar/store', 'SuratKeluarController@store');
Route::get('suratkeluar/edit/{id_suratkeluar}', 'SuratKeluarController@edit');
Route::put('suratkeluar/update/{id_suratkeluar}', 'SuratKeluarController@update');
Route::get('suratkeluar/hapus/{id_suratkeluar}', 'SuratKeluarController@delete');
