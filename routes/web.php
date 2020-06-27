<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes();

Route::group(['middleware' => ['auth','checkStatus:Admin']],function(){
    Route::resource('jenissurat', 'JenisSuratController');
    Route::resource('unitinduk', 'UnitIndukController');
    Route::resource('unitsurat', 'UnitSuratController');
    Route::resource('jenjangjabatan', 'JenjangJabatanController');
    Route::resource('jenissk', 'JenisSKController');
    Route::resource('suratkeputusan', 'SuratKeputusanController');

    Route::resource('kaprodi', 'KaprodiController');
});

Route::group(['middleware' => ['auth','checkStatus:Admin,Karyawan']],function(){
    Route::get('/', 'HomeController@index')->name('home');

    Route::get('suratkeluar', 'SuratKeluarController@index')->name('suratkeluar');
    Route::get('arsipsuratkeluar', 'ArsipSuratKeluarController@index')->name('arsipsuratkeluar');
    Route::get('suratkeluar/tambah', 'SuratKeluarController@tambah');
    Route::post('suratkeluar/store', 'SuratKeluarController@store');
    Route::get('suratkeluar/edit/{id_suratkeluar}', 'SuratKeluarController@edit');
    Route::put('suratkeluar/update/{id_suratkeluar}', 'SuratKeluarController@update');
    Route::get('suratkeluar/hapus/{id_suratkeluar}', 'SuratKeluarController@delete');

    Route::get('suratmasuk', 'SuratMasukController@index')->name('suratmasuk');
    Route::get('arsipsuratmasuk', 'ArsipSuratMasukController@index')->name('arsipsuratmasuk');
    Route::get('suratmasuk/tambah', 'SuratMasukController@tambah');
    Route::post('suratmasuk/store', 'SuratMasukController@store');
    Route::get('suratmasuk/edit/{id_suratmasuk}', 'SuratMasukController@edit');
    Route::put('suratmasuk/update/{id_suratmasuk}', 'SuratMasukController@update');
    Route::get('suratmasuk/hapus/{id_suratmasuk}', 'SuratMasukController@delete');

});
