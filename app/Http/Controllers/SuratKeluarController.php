<?php

namespace App\Http\Controllers;

use App\SuratKeluar;
use App\Jenis;
use App\JenjangJabatan;
use App\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
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
		$alljabatan = JenjangJabatan::getalluser();
		$sk_count = DB::table('suratkeluar')->count();
		$no_urut = $sk_count + 1;
        $nama = Auth::user()->name;
        $nip = User::where('name',$nama)->first();

        return view('suratkeluar_tambah', ['alljenis' => $alljenis, 'alljabatan' => $alljabatan, 'nama' => $nama, 'nip' => $nip, 'no_urut' => $no_urut]);
	}

	public function store(Request $request)
    {
		$messages = [
			'required' => ':attribute Wajib di isi!',
			'numeric' => ':attribute hanya bisa diisi oleh angka saja!',
			'max' => 'ukuran :attribute maksimal photo adalah 2MB'
		];

		$this->validate($request,[
			'urut' => 'required|numeric',
			'tahun' => 'required|numeric',
			'tgl_suratkeluar' => 'required',
			'perihal' => 'required',
			'lampiran' => 'required',
			'tujuan_surat' => 'required',
			'keterangan' => 'required',
			'gambar.*' => 'image|mimes:jpeg,png,gif,webp|max:2048'
		],$messages);

		$input=$request->all();
		$urut = $request->input('urut');
		$tahun = $request->input('tahun');
		$gambar=array();
		if($files = $request->file('gambar')){
			foreach($files as $file){
				$name=$file->getClientOriginalName();
				$tujuan_upload = 'uploads/suratkeluar/'.\Carbon\Carbon::now()->format('Y-m-d').'/' .'SURAT'.$urut.$tahun;
				$file->move($tujuan_upload,$name);
				$gambar[]=$name;
			}
		}

        $bulan = $request->input('bulan');
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
			'kode_jenjang' => $jabat,
			'lokasi' => $tujuan_upload
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
		$messages = [
			'required' => ':attribute Wajib di isi!',
			'max' => 'ukuran :attribute maksimal photo adalah 2MB'
		];

		$this->validate($request,[
			'tgl_suratkeluar' => 'required',
			'perihal' => 'required',
			'lampiran' => 'required',
			'tujuan_surat' => 'required',
			'keterangan' => 'required',
			'gambar.*' => 'image|mimes:jpeg,png,gif,webp|max:2048'
		],$messages);

		$input=$request->all();
		$hidden_name=array();
		$gambarbaru=array();
		if($files = $request->file('gambarbaru')){
			//Hapus File
			$gambar_surat = SuratKeluar::where('id_suratkeluar',$id_suratkeluar)->first();
			$hidden_tujuan = $gambar_surat->lokasi;
			$lokasifile = $gambar_surat->lokasi;
			$filename = $lokasifile;
			File::deleteDirectory($filename);
			foreach($files as $file){
				$name=$file->getClientOriginalName();
				$tujuan_upload=$hidden_tujuan;
				$file->move($tujuan_upload,$name);
				$gambarbaru[]=$name;
			}
		}else{
			$gambar_surat = SuratKeluar::where('id_suratkeluar',$id_suratkeluar)->first();
			$hidden_tujuan = $gambar_surat->lokasi;
			if($files = $request->input('hidden_name')){
				foreach($files as $hiddenname){
					$gambarbaru[] = $hiddenname;
					$tujuan_upload = $hidden_tujuan;
				}
			}
        }

		// update data surat keluar
		SuratKeluar::where('id_suratkeluar',$id_suratkeluar)->update([
			'tgl_suratkeluar' => $request->tgl_suratkeluar,
			'perihal' => $request->perihal,
			'lampiran' => $request->lampiran,
			'tujuan_surat' => $request->tujuan_surat,
			'keterangan' => $request->keterangan,
			'gambar' => implode(",",$gambarbaru),
			'lokasi' => $hidden_tujuan
		]);
		// alihkan halaman ke halaman suratkeluar
		return redirect('/suratkeluar');
	}

	public function delete($id_suratkeluar)
	{
		//Hapus File
		$gambar_surat = SuratKeluar::where('id_suratkeluar',$id_suratkeluar)->first();
		$backuplokasi = $gambar_surat->lokasi;
		$lokasifile = $gambar_surat->lokasi;
		$filename = $lokasifile.'/';

		if(File::exists($lokasifile)){
			File::deleteDirectory($filename);
			File::makeDirectory($backuplokasi, 0775, true, true);
		}
		else{
			File::makeDirectory($backuplokasi, 0775, true, true);
		}


		// menghapus data suratkeluar berdasarkan id yang dipilih
		SuratKeluar::where('id_suratkeluar',$id_suratkeluar)->delete();

		// alihkan halaman ke halaman suratkeluar
		return redirect('/suratkeluar');
	}
}
