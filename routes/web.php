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

    Route::resource('dosen', 'DosenController');

    Route::get('user', 'UserController@index')->name('user');
    Route::get('user/edit/{id}', 'UserController@edit');
    Route::put('user/update/{id}', 'UserController@update');
    Route::get('user/hapus/{id}', 'UserController@delete');
});

Route::group(['middleware' => ['auth','checkStatus:Admin,Staf,Dosen,Dekan,Ketua Program Studi']],function(){
    Route::get('/', 'HomeController@index')->name('home');
});

Route::group(['middleware' => ['auth','checkStatus:Admin,Staf']],function(){
    Route::get('suratmasuk', 'SuratMasukController@index')->name('suratmasuk');
    Route::get('arsipsuratmasuk', 'ArsipSuratMasukController@index')->name('arsipsuratmasuk');
    Route::get('arsipfilesuratmasuk', 'ArsipSuratMasukController@indexfile')->name('arsipfilesuratmasuk');
    Route::get('suratmasuk/tambah', 'SuratMasukController@tambah');
    Route::post('suratmasuk/store', 'SuratMasukController@store');
    Route::get('suratmasuk/edit/{id_suratmasuk}', 'SuratMasukController@edit');
    Route::put('suratmasuk/update/{id_suratmasuk}', 'SuratMasukController@update');
    Route::get('suratmasuk/hapus/{id_suratmasuk}', 'SuratMasukController@delete');

    Route::get('agendasuratmasuk', 'AgendaSuratMasukController@index')->name('agendasuratmasuk');
    Route::get('agendasuratmasuk/pencarian', 'AgendaSuratMasukController@cari');
    Route::get('agendasuratmasuk_pdf', 'AgendaSuratMasukController@cetak_pdf');

    Route::get('suratkeluar', 'SuratKeluarController@index')->name('suratkeluar');
    Route::get('arsipsuratkeluar', 'ArsipSuratKeluarController@index')->name('arsipsuratkeluar');
    Route::get('arsipfilesuratkeluar', 'ArsipSuratKeluarController@indexfile')->name('arsipfilesuratkeluar');
    Route::get('suratkeluar/tambah', 'SuratKeluarController@tambah');
    Route::post('suratkeluar/store', 'SuratKeluarController@store');
    Route::get('suratkeluar/edit/{id_suratkeluar}', 'SuratKeluarController@edit');
    Route::put('suratkeluar/update/{id_suratkeluar}', 'SuratKeluarController@update');
    Route::get('suratkeluar/hapus/{id_suratkeluar}', 'SuratKeluarController@delete');

    Route::get('agendasuratkeluar', 'AgendaSuratKeluarController@index')->name('agendasuratkeluar');
    Route::get('agendasuratkeluar/pencarian', 'AgendaSuratKeluarController@cari');
    Route::get('agendasuratkeluar_pdf', 'AgendaSuratKeluarController@cetak_pdf');

    Route::resource('suratkeputusan', 'SuratKeputusanController');
    Route::post('suratkeputusan/{id}', 'SuratKeputusanController@kirim');

    Route::resource('requestsurat', 'RequestSuratController');
    Route::get('requestsurat/diterima/{no_req}', 'RequestSuratController@diterima');
    Route::get('requestsurat/ditolak/{no_req}', 'RequestSuratController@ditolak');
    Route::get('requestsurat/proses/{no_req}', 'RequestSuratController@proses');
});

Route::group(['middleware' => ['auth','checkStatus:Admin,Ketua Program Studi']],function(){
    Route::resource('kaprodi', 'KaprodiController');
});

Route::group(['middleware' => ['auth','checkStatus:Admin,Dekan']],function(){
    Route::resource('dekan', 'DekanController');
});

Route::group(['middleware' => ['auth','checkStatus:Dosen']],function(){
    Route::resource('dosenrequest', 'DosenRequestController');
});
