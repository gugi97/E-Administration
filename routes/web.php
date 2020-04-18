<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('suratmasuk', 'SuratMasukControllerk@index');
Route::get('suratmasuk/tambah', 'SuratMasukControllerk@tambah');
Route::post('suratmasuk/store', 'SuratMasukControllerk@store');
Route::get('suratmasuk/edit/{id_suratmasuk}', 'SuratMasukControllerk@edit');
Route::put('suratmasuk/update/{id_suratmasuk}', 'SuratMasukControllerk@update');
Route::get('suratmasuk/hapus/{id_suratmasuk}', 'SuratMasukControllerk@delete');

Route::get('suratkeluar', 'SuratKeluarController@index');
Route::get('suratkeluar/tambah', 'SuratKeluarController@tambah');
Route::post('/suratkeluar/store', 'SuratKeluarController@store');
Route::get('suratkeluar/edit/{id_suratkeluar}', 'SuratKeluarController@edit');
Route::put('suratkeluar/update/{id_suratkeluar}', 'SuratKeluarController@update');
Route::get('suratkeluar/hapus/{id_suratkeluar}', 'SuratKeluarController@delete');
