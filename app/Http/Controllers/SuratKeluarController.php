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
		$date = date("y");
		$no_urut = $sk_count + 1;
        $nama = Auth::user()->name;
        $nip = User::where('name',$nama)->first();

        return view('suratkeluar_tambah', ['alljenis' => $alljenis, 'alljabatan' => $alljabatan, 'nama' => $nama, 'nip' => $nip, 'no_urut' => $no_urut, 'date' => $date]);
	}

	public function store(Request $request)
    {
		$messages = [
			'required' => ':attribute Wajib di isi!',
			'numeric' => ':attribute hanya bisa diisi oleh angka saja!',
			'max' => 'Size :attribute maksimal adalah 2MB',
			'gambar.max' => 'Batas Upload :attribute maksimal adalah 3 buah, jika lebih silahkan upload File PDF saja',
			'file.max' => 'Size :attribute maksimal adalah 10MB',
			'file.mimetypes' => ':attribute Harus berupa file PDF'
		];

		$this->validate($request,[
			'urut' => 'required|numeric',
			'tahun' => 'required|numeric',
			'tgl_suratkeluar' => 'required',
			'perihal' => 'required',
			'lampiran' => 'required',
			'tujuan_surat' => 'required',
			'keterangan' => 'required',
			'gambar.*' => 'image|mimes:jpeg,png,gif,webp|max:5120',
			'gambar' => 'max:3',
			'file' => 'mimetypes:application/pdf|max:10240',
		],$messages);

		$input=$request->all();
		$urut = $request->input('urut');
		$tahun = $request->input('tahun');
		$gambar=array();
		if($files = $request->file('gambar')){
			foreach($files as $file){
				$name=$file->getClientOriginalName();
				$tujuan_upload = 'uploads/suratkeluar/'.\Carbon\Carbon::now()->format('Y-m-d').'/' .'SURAT'.$urut.$tahun.'/'.'GAMBAR';
				$file->move($tujuan_upload,$name);
				$gambar[]=$name;
			}
		}else{
			$gambar[] = null;
			$tujuan_upload = 'uploads/suratkeluar/'.\Carbon\Carbon::now()->format('Y-m-d').'/' .'SURAT'.$urut.$tahun.'/'.'GAMBAR';
		}

		if($files2 = $request->file('file')){
			$namefile=$files2->getClientOriginalName();
			$tujuan_uploadfile = 'uploads/suratkeluar/'.\Carbon\Carbon::now()->format('Y-m-d').'/' .'SURAT'.$urut.$tahun.'/'.'FILE';
			$files2->move($tujuan_uploadfile,$namefile);
		}else{
			$namefile = null;
			$tujuan_uploadfile = 'uploads/suratkeluar/'.\Carbon\Carbon::now()->format('Y-m-d').'/' .'SURAT'.$urut.$tahun.'/'.'FILE';
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
			'file' => $namefile,
            'nip' => $nip,
            'kode_jenissurat' => $jenis,
			'kode_jenjang' => $jabat,
			'lokasi' => $tujuan_upload,
			'lokasifile' => $tujuan_uploadfile
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
			'max' => 'Size :attribute maksimal adalah 2MB',
			'gambarbaru.max' => 'Batas Upload gambar maksimal adalah 3 buah, jika lebih silahkan upload File PDF saja',
			'filebaru.max' => 'Size :attribute maksimal adalah 10MB',
			'filebaru.mimetypes' => 'File Harus berupa file PDF'
		];

		$this->validate($request,[
			'tgl_suratkeluar' => 'required',
			'perihal' => 'required',
			'lampiran' => 'required',
			'tujuan_surat' => 'required',
			'keterangan' => 'required',
			'gambarbaru.*' => 'image|mimes:jpeg,png,gif,webp|max:5120',
			'gambarbaru' => 'max:3',
			'filebaru' => 'mimetypes:application/pdf|max:10240',
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
		
		if($files = $request->file('filebaru')){
			//Hapus File
			$file_surat = SuratKeluar::where('id_suratkeluar',$id_suratkeluar)->first();
			$hidden_tujuanfile = $file_surat->lokasifile;
			$lokasifile2 = $file_surat->lokasifile;
			$filename = $lokasifile2;
			File::deleteDirectory($filename);
			$namefile=$files->getClientOriginalName();
			$tujuan_uploadfile=$hidden_tujuanfile;
			$files->move($tujuan_uploadfile,$namefile);
		}else{
			$file_surat = SuratKeluar::where('id_suratkeluar',$id_suratkeluar)->first();
			$hidden_tujuanfile = $file_surat->lokasifile;
			$hidden_namafile = $file_surat->file;
			$namefile = $hidden_namafile;
			$tujuan_uploadfile = $hidden_tujuanfile;
        }

		// update data surat keluar
		SuratKeluar::where('id_suratkeluar',$id_suratkeluar)->update([
			'tgl_suratkeluar' => $request->tgl_suratkeluar,
			'perihal' => $request->perihal,
			'lampiran' => $request->lampiran,
			'tujuan_surat' => $request->tujuan_surat,
			'keterangan' => $request->keterangan,
			'gambar' => implode(",",$gambarbaru),
			'file' => $namefile,
			'lokasi' => $hidden_tujuan,
			'lokasifile' => $hidden_tujuanfile
		]);
		// alihkan halaman ke halaman suratkeluar
		return redirect('/suratkeluar');
	}

	public function delete($id_suratkeluar)
	{
		//Hapus File
		$surat = SuratKeluar::where('id_suratkeluar',$id_suratkeluar)->first();
		$gambar = $surat->gambar;
		$file = $surat->file;
		$backuplokasigambar = $surat->lokasi;
		$backuplokasifile = $surat->lokasifile;
		$lokasigambar = $surat->lokasi;
		$lokasifile = $surat->lokasifile;
		$filename = $lokasigambar.'/';
		$filename2 = $lokasifile.'/';
		if($gambar != null && $file != null){
			File::deleteDirectory($filename);
			File::deleteDirectory($filename2);
			File::makeDirectory($backuplokasigambar);
			File::makeDirectory($backuplokasifile);
			SuratKeluar::where('id_suratkeluar', $id_suratkeluar)->delete();
		}else if($gambar == null && $file == null){
			SuratKeluar::where('id_suratkeluar', $id_suratkeluar)->delete();
		}else if($gambar == null && $file != null){
			File::deleteDirectory($filename2);
			File::makeDirectory($backuplokasifile);
			SuratKeluar::where('id_suratkeluar', $id_suratkeluar)->delete();
		}else if($file == null && $gambar != null){
			File::deleteDirectory($filename);
			File::makeDirectory($backuplokasigambar);
			SuratKeluar::where('id_suratkeluar', $id_suratkeluar)->delete();
		}
		// alihkan halaman ke halaman suratkeluar
		return redirect()->back();
	}
}
