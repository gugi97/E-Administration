<?php

namespace App\Http\Controllers;

use App\SuratKeluar;
use App\Jenis;
use App\Jabatan;
use App\User;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuratKeluarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
		// mengambil data dari table suratkeluar
        $suratkeluar = SuratKeluar::getallsuratkeluar();

    	// mengirim data suratkeluar ke view index
		return view('suratkeluar',['suratkeluar' => $suratkeluar]);
	}

	public function tambah()
    {
		$alljenis = Jenis::getalluser();
		$alljabatan = Jabatan::getalluser();
		$sk_count = DB::table('suratkeluar')->count();
		$no_urut = $sk_count + 1;
        $nama = Auth::user()->name;
        $nip = User::where('name',$nama)->first();

        return view('suratkeluar_tambah', ['alljenis' => $alljenis, 'alljabatan' => $alljabatan, 'nama' => $nama, 'nip' => $nip, 'no_urut' => $no_urut]);
	}

	public function store(Request $request)
    {
		$input=$request->all();
		$gambar=array();
		if($files = $request->file('gambar')){
			foreach($files as $file){
				$name=$file->getClientOriginalName();
				$file->move('uploads/suratkeluar',$name);
				$gambar[]=$name;
			}
		}
		
		$urut = $request->input('urut');
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');
        $jenis = $request->input('jenis');
        $jabat = $request->input('jabat');
		$tgl_suratkeluar = $request->input('tgl_suratkeluar');
		$perihal = $request->input('perihal');
		$lampiran = $request->input('lampiran');
		$tujuan_surat = $request->input('tujuan_surat');
		$keterangan = $request->input('keterangan');
        $nip = $request->input('nip');
		$no_suratkeluar = $jenis . '/' . $jabat . '/' . $urut . '/' . $bulan . '/' . $tahun;

        SuratKeluar::create([
            'no_suratkeluar' => $no_suratkeluar,
            'tgl_suratkeluar' => $tgl_suratkeluar,
            'perihal' => $perihal,
            'lampiran' => $lampiran,
            'tujuan_surat' => $tujuan_surat,
            'keterangan' => $keterangan,
            'gambar'=>  implode(",",$gambar),
            'nip' => $nip,
            'kode_jenissurat' => $jenis,
            'kode_jenjang' => $jabat
		]);
		
		// alihkan halaman ke halaman suratkeluar
    	return redirect('/suratkeluar');
	}

	public function edit($id_suratkeluar)
	{
		// mengambil data suratkeluar berdasarkan id yang dipilih
		$suratkeluar = SuratKeluar::where('id_suratkeluar',$id_suratkeluar)->get();
		// passing data surat keluar yang didapat ke view suratkeluar_edit.blade.php
		return view('suratkeluar_edit', ['suratkeluar' => $suratkeluar]);
	}

	public function update($id_suratkeluar, Request $request)
	{	
		// update data surat keluar
		SuratKeluar::where('id_suratkeluar',$id_suratkeluar)->update([
			'tgl_suratkeluar' => $request->tgl_suratkeluar,
			'perihal' => $request->perihal,
			'lampiran' => $request->lampiran,
			'tujuan_surat' => $request->tujuan_surat,
			'keterangan' => $request->keterangan,
			'gambar' => $request->gambar
		]);
		// alihkan halaman ke halaman suratkeluar
		return redirect('/suratkeluar');
	}

	public function delete($id_suratkeluar)
	{
		// menghapus data suratkeluar berdasarkan id yang dipilih
		SuratKeluar::where('id_suratkeluar',$id_suratkeluar)->delete();

		// alihkan halaman ke halaman suratkeluar
		return redirect('/suratkeluar');
	}
}
