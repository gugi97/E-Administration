<?php

namespace App\Http\Controllers;

use App\SuratKeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SuratKeluarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
		// mengambil data dari table suratkeluar
        $suratkeluar = DB::table('suratkeluar')->get();

    	// mengirim data suratkeluar ke view index
		return view('suratkeluar',['suratkeluar' => $suratkeluar]);
	}

	public function tambah()
    {
    	return view('suratkeluar_tambah');
	}

	public function store(Request $request)
    {
		if ($request->hasFile('file'))
        {
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            $filename = $file->getClientOriginalName() . '.' . $extension;
            $file->move('uploads/suratkeluar/', $filename);
            $file = $filename;
        }else {
            return $request;
            $file = '';
		}
		
		// insert data ke table suratkeluar
		DB::table('suratkeluar')->insert([
			'no_agenda' => $request->no_agenda,
			'kode_klasifikasi' => $request->kode_klasifikasi,
			'isi' => $request->isi,
			'tujuan' => $request->tujuan,
			'no_suratkeluar' => $request->no_suratkeluar,
			'tgl_surat' => $request->tgl_surat,
			'tgl_catat' => $request->tgl_catat,
			'file' => $request->file,
			'keterangan' => $request->keterangan
		]);
		// alihkan halaman ke halaman suratkeluar
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
		// menghapus data suratkeluar berdasarkan id yang dipilih
		DB::table('suratkeluar')->where('id_suratkeluar',$id_suratkeluar)->delete();

		// alihkan halaman ke halaman suratkeluar
		return redirect('/suratkeluar');
	}
}
