<?php

namespace App\Http\Controllers;

use App\SuratMasuk;
use App\Jenis;
use App\JenjangJabatan;
use App\User;
use File;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuratMasukController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // mengambil data dari table suratmasuk
        $suratmasuk = SuratMasuk::getallsuratmasuk();

    	// mengirim data suratmasuk ke view index
		return view('suratmasuk',['suratmasuk' => $suratmasuk]);
    }

    public function tambah()
    {
        $alljenis = Jenis::getalluser();
        $alljabatan = JenjangJabatan::getalluser();
        $sm_count = DB::table('suratmasuk')->count();
		$no_urut = $sm_count + 1;
        $nama = Auth::user()->name;
        $nip = User::where('name',$nama)->first();

        return view('suratmasuk_tambah', ['alljenis' => $alljenis, 'alljabatan' => $alljabatan, 'nama' => $nama, 'nip' => $nip, 'no_urut' => $no_urut]);
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
            'tglsurat' => 'required',
            'tglterima' => 'required',
			'pengirim' => 'required',
			'perihal' => 'required',
			'ket' => 'required',
			'gambar.*' => 'image|mimes:jpeg,png,gif,webp|max:5120',
			'gambar' => 'max:3',
			'file' => 'mimetypes:application/pdf|max:10240'
        ],$messages);
        
        $input=$request->all();
		$urut = $request->input('urut');
		$tahun = $request->input('tahun');
		$gambar=array();
        if($files = $request->file('gambar')){
			foreach($files as $file){
				$name=$file->getClientOriginalName();
				$tujuan_upload = 'uploads/suratmasuk/'.\Carbon\Carbon::now()->format('Y-m-d').'/' .'SURAT'.$urut.$tahun.'/'.'GAMBAR';
				$file->move($tujuan_upload,$name);
				$gambar[]=$name;
			}
		}else{
			$gambar[] = null;
			$tujuan_upload = 'uploads/suratmasuk/'.\Carbon\Carbon::now()->format('Y-m-d').'/' .'SURAT'.$urut.$tahun.'/'.'GAMBAR';
		}

		if($files2 = $request->file('file')){
			$namefile=$files2->getClientOriginalName();
			$tujuan_uploadfile = 'uploads/suratmasuk/'.\Carbon\Carbon::now()->format('Y-m-d').'/' .'SURAT'.$urut.$tahun.'/'.'FILE';
			$files2->move($tujuan_uploadfile,$namefile);
		}else{
			$namefile = null;
			$tujuan_uploadfile = 'uploads/suratmasuk/'.\Carbon\Carbon::now()->format('Y-m-d').'/' .'SURAT'.$urut.$tahun.'/'.'FILE';
		}

        $bulan = $request->input('bulan');
        $jenis = $request->input('jenis');
        $jabat = $request->input('jabat');
        $tglsurat = $request->input('tglsurat');
        $tglterima = $request->input('tglterima');
        $pengirim = $request->input('pengirim');
        $perihal = $request->input('perihal');
        $keterangan = $request->input('ket');
        $nip = $request->input('nip');
        $nosurat = $jenis . '/' . $jabat . '/' . $urut . '/' . $bulan . '/' . $tahun;

        SuratMasuk::create([
            'no_surat' => $nosurat,
            'tgl_surat' => $tglsurat,
            'tgl_terima' => $tglterima,
            'pengirim' => $pengirim,
            'perihal' => $perihal,
            'keterangan' => $keterangan,
			'gambar' => implode(",",$gambar),
			'file' => $namefile,
            'nip' => $nip,
            'kode_jenissurat' => $jenis,
            'kode_jenjang' => $jabat,
			'lokasi' => $tujuan_upload,
			'lokasifile' => $tujuan_uploadfile
        ]);

        return redirect('/suratmasuk');
    }

    public function edit($id_suratmasuk)
	{
		// mengambil data suratmasuk berdasarkan id yang dipilih
        $surat = SuratMasuk::where('id_suratmasuk', $id_suratmasuk)->get();
		// passing data surat masuk yang didapat ke view suratmasuk_edit.blade.php
		return view('suratmasuk_edit', ['suratmasuk' => $surat]);
    }
    
    public function update($id_suratmasuk, Request $request)
    {
        $messages = [
			'required' => ':attribute Wajib di isi!',
			'max' => 'Size :attribute maksimal adalah 2MB',
			'gambarbaru.max' => 'Batas Upload gambar maksimal adalah 3 buah, jika lebih silahkan upload File PDF saja',
			'filebaru.max' => 'Size :attribute maksimal adalah 10MB',
			'filebaru.mimetypes' => 'File Harus berupa file PDF'
		];

		$this->validate($request,[
            'tglsurat' => 'required',
            'tglterima' => 'required',
			'pengirim' => 'required',
			'perihal' => 'required',
			'ket' => 'required',
			'gambarbaru.*' => 'image|mimes:jpeg,png,gif,webp|max:5120',
			'gambarbaru' => 'max:3',
			'filebaru' => 'mimetypes:application/pdf|max:10240',
        ],$messages);

        $input=$request->all();
		$hidden_name=array();
		$gambarbaru=array();
		if($files = $request->file('gambarbaru')){
			//Hapus File
			$gambar_surat = SuratMasuk::where('id_suratmasuk',$id_suratmasuk)->first();
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
			$gambar_surat = SuratMasuk::where('id_suratmasuk',$id_suratmasuk)->first();
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
			$file_surat = SuratMasuk::where('id_suratmasuk',$id_suratmasuk)->first();
			$hidden_tujuanfile = $file_surat->lokasifile;
			$lokasifile2 = $file_surat->lokasifile;
			$filename = $lokasifile2;
			File::deleteDirectory($filename);
			$namefile=$files->getClientOriginalName();
			$tujuan_uploadfile=$hidden_tujuanfile;
			$files->move($tujuan_uploadfile,$namefile);
		}else{
			$file_surat = SuratMasuk::where('id_suratmasuk',$id_suratmasuk)->first();
			$hidden_tujuanfile = $file_surat->lokasifile;
			$hidden_namafile = $file_surat->file;
			$namefile = $hidden_namafile;
			$tujuan_uploadfile = $hidden_tujuanfile;
        }

        // update data surat masuk
        SuratMasuk::where('id_suratmasuk', $id_suratmasuk)->update([
			'tgl_surat' => $request->tglsurat,
			'tgl_terima' => $request->tglterima,
			'pengirim' => $request->pengirim,
			'perihal' => $request->perihal,
			'keterangan' => $request->ket,
			'gambar' => implode(",",$gambarbaru),
			'file' => $namefile,
			'lokasi' => $hidden_tujuan,
			'lokasifile' => $hidden_tujuanfile
		]);
        // alihkan halaman ke halaman suratmasuk
        return redirect('/suratmasuk');
    }

    public function delete($id_suratmasuk)
	{
        //Hapus File
		$surat = SuratMasuk::where('id_suratmasuk',$id_suratmasuk)->first();
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
			SuratMasuk::where('id_suratmasuk', $id_suratmasuk)->delete();
		}else if($gambar == null && $file == null){
			SuratMasuk::where('id_suratmasuk', $id_suratmasuk)->delete();
		}else if($gambar == null && $file != null){
			File::deleteDirectory($filename2);
			File::makeDirectory($backuplokasifile);
			SuratMasuk::where('id_suratmasuk', $id_suratmasuk)->delete();
		}else if($file == null && $gambar != null){
			File::deleteDirectory($filename);
			File::makeDirectory($backuplokasigambar);
			SuratMasuk::where('id_suratmasuk', $id_suratmasuk)->delete();
		}
		// alihkan halaman ke halaman suratmasuk
		return redirect()->back();
	}
}
