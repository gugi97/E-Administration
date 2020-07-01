<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes();

Route::group(['middleware' => ['auth','checkStatus:Admin']],function(){
    Route::resource('dosen', 'DosenController');
    Route::resource('jenissurat', 'JenisSuratController');
    Route::resource('unitinduk', 'UnitIndukController');
    Route::resource('unitsurat', 'UnitSuratController');
    Route::resource('jenjangjabatan', 'JenjangJabatanController');
    Route::resource('jenissk', 'JenisSKController');
    Route::resource('suratkeputusan', 'SuratKeputusanController');

    Route::get('user', 'UserController@index')->name('user');
    Route::get('user/edit/{id}', 'UserController@edit');
    Route::put('user/update/{id}', 'UserController@update');
    Route::get('user/hapus/{id}', 'UserController@delete');
});

Route::group(['middleware' => ['auth','checkStatus:Admin,Karyawan,Dekan,Ketua Program Studi']],function(){
    Route::get('/', 'HomeController@index')->name('home');

    Route::get('suratmasuk', 'SuratMasukController@index')->name('suratmasuk');
    Route::get('arsipsuratmasuk', 'ArsipSuratMasukController@index')->name('arsipsuratmasuk');
    Route::get('arsipfilesuratmasuk', 'ArsipSuratMasukController@indexfile')->name('arsipfilesuratmasuk');
    Route::get('suratmasuk/tambah', 'SuratMasukController@tambah');
    Route::post('suratmasuk/store', 'SuratMasukController@store');
    Route::get('suratmasuk/edit/{id_suratmasuk}', 'SuratMasukController@edit');
    Route::put('suratmasuk/update/{id_suratmasuk}', 'SuratMasukController@update');
    Route::get('suratmasuk/hapus/{id_suratmasuk}', 'SuratMasukController@delete');
});

Route::group(['middleware' => ['auth','checkStatus:Admin,Dekan,Ketua Program Studi']],function(){
    Route::get('suratkeluar', 'SuratKeluarController@index')->name('suratkeluar');
    Route::get('arsipsuratkeluar', 'ArsipSuratKeluarController@index')->name('arsipsuratkeluar');
    Route::get('arsipfilesuratkeluar', 'ArsipSuratKeluarController@indexfile')->name('arsipfilesuratkeluar');
    Route::get('suratkeluar/tambah', 'SuratKeluarController@tambah');
    Route::post('suratkeluar/store', 'SuratKeluarController@store');
    Route::get('suratkeluar/edit/{id_suratkeluar}', 'SuratKeluarController@edit');
    Route::put('suratkeluar/update/{id_suratkeluar}', 'SuratKeluarController@update');
    Route::get('suratkeluar/hapus/{id_suratkeluar}', 'SuratKeluarController@delete');
});

Route::group(['middleware' => ['auth','checkStatus:Ketua Program Studi']],function(){
    Route::resource('kaprodi', 'KaprodiController');
});
