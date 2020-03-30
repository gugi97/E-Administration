<?php

namespace App\Http\Controllers;

use App\SuratKeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SuratKeluarController extends Controller
{
    public function index()
    {
		// mengambil data dari table pegawai
    	$suratkeluar = DB::table('suratkeluar')->get();
 
    	// mengirim data pegawai ke view index
		return view('suratkeluar',['suratkeluar' => $suratkeluar]);
	}

	public function tambah()
    {
    	return view('suratkeluar_tambah');
	}
	
	public function store(Request $request)
    {
		// insert data ke table pegawai
		DB::table('suratkeluar')->insert([
			'no_agenda' => $request->no_agenda,
			'kode_klasifikasi' => $request->kode_klasifikasi,
			'isi' => $request->isi,
			'tujuan' => $request->tujuan,
			'no_suratkeluar' => $request->no_suratkeluar,
			'tgl_surat' => $request->tgl_surat,
			'tgl_catat' => $request->tgl_catat,
			'keterangan' => $request->keterangan
		]);
		// alihkan halaman ke halaman pegawai
    	return redirect('/suratkeluar');
	}
	
	public function edit($id_suratkeluar)
	{
		// mengambil data suratkeluar berdasarkan id yang dipilih
		$suratkeluar = DB::table('suratkeluar')->where('id_suratkeluar',$id_suratkeluar)->get();
		// passing data surat keluar yang didapat ke view suratkeluar_edit.blade.php
		return view('suratkeluar_edit', ['suratkeluar' => $suratkeluar]);
	}

	public function update(Request $request)
	{

		// update data surat keluar
		DB::table('suratkeluar')->where('id_suratkeluar',$request->id_suratkeluar)->update([
			'no_agenda' => $request->no_agenda,
			'kode_klasifikasi' => $request->kode_klasifikasi,
			'isi' => $request->isi,
			'tujuan' => $request->tujuan,
			'no_suratkeluar' => $request->no_suratkeluar,
			'tgl_surat' => $request->tgl_surat,
			'tgl_catat' => $request->tgl_catat,
			'keterangan' => $request->keterangan
		]);
		// alihkan halaman ke halaman suratkeluar
		return redirect('/suratkeluar');
	}

	public function delete($id_suratkeluar)
	{
		// menghapus data pegawai berdasarkan id yang dipilih
		DB::table('suratkeluar')->where('id_suratkeluar',$id_suratkeluar)->delete();
			
		// alihkan halaman ke halaman pegawai
		return redirect('/suratkeluar');
	}
}
