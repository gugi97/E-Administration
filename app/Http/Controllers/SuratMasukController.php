<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SuratMasuk;
use App\Jenis;
use App\Jabatan;
use App\User;
use Illuminate\Support\Facades\Auth;

class SuratMasukController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // mengambil data dari table pegawai
        $suratmasuk = SuratMasuk::getallsuratmasuk();

    	// mengirim data pegawai ke view index
		return view('suratmasuk',['suratmasuk' => $suratmasuk]);
    }

    public function tambah()
    {
        $alljenis = Jenis::getalluser();
        $alljabatan = Jabatan::getalluser();
        $nama = Auth::user()->name;
        $nip = User::where('name',$nama)->first();

        return view('suratmasuk_tambah', ['alljenis' => $alljenis, 'alljabatan' => $alljabatan, 'nama' => $nama, 'nip' => $nip]);
    }

    public function store(Request $request)
    {
        if ($request->hasFile('gambar'))
        {
            $file = $request->file('gambar');
            // $extension = $file->getClientOriginalExtension();
            $filename = $file->getClientOriginalName();
            $file->move('uploads/suratmasuk', $filename);
            $gambar = $filename;
        }else {
            return $request;
            $gambar = '';
        }

        $urut = $request->input('urut');
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');
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
            'gambar' => $gambar,
            'nip' => $nip,
            'kode_jenissurat' => $jenis,
            'kode_jenjang' => $jabat
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
        // update data surat masuk
        SuratMasuk::where('id_suratmasuk', $id_suratmasuk)->update([
			'tgl_surat' => $request->tglsurat,
			'tgl_terima' => $request->tglterima,
			'pengirim' => $request->pengirim,
			'perihal' => $request->perihal,
			'keterangan' => $request->ket,
			'gambar' => $request->gambar,
		]);
        // alihkan halaman ke halaman suratmasuk
        return redirect('/suratmasuk');
    }

    public function delete($id_suratmasuk)
	{
		// menghapus data suratkeluar berdasarkan id yang dipilih
        SuratMasuk::where('id_suratmasuk', $id_suratmasuk)->delete();
		// alihkan halaman ke halaman suratkeluar
		return redirect()->back();
	}
}
