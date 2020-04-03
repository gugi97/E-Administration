<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('suratmasuk', 'SuratMasukControllerk@index');
Route::get('suratmasuk/tambah', 'SuratMasukControllerk@tambah');
Route::post('suratmasuk/store', 'SuratMasukControllerk@store');

Route::get('suratkeluar', 'SuratKeluarController@index');
Route::get('suratkeluar/tambah', 'SuratKeluarController@tambah');
Route::post('suratkeluar/store', 'SuratKeluarController@store');
Route::get('suratkeluar/edit/{id_suratkeluar}', 'SuratKeluarController@edit');
Route::post('suratkeluar/update/{id_suratkeluar}', 'SuratKeluarController@update');
Route::get('suratkeluar/hapus/{id_suratkeluar}', 'SuratKeluarController@delete');
