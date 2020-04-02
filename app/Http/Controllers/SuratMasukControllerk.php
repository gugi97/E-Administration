<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SuratMasuk;
use App\Jenis;
use App\Jabatan;
use App\User;
use Illuminate\Support\Facades\Auth;

class SuratMasukControllerk extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $alljenis = Jenis::getalluser();
        $alljabatan = Jabatan::getalluser();
        $nama = Auth::user()->name;
        $nip = User::where('name',$nama)->first();
        return view('suratmasuk', ['alljenis' => $alljenis, 'alljabatan' => $alljabatan, 'nama' => $nama, 'nip' => $nip]);
    }

    public function store(Request $request)
    {
        if ($request->hasFile('gambar'))
        {
            $file = $request->file('gambar');
            $extension = $file->getClientOriginalExtension();
            $filename = $file->getClientOriginalName() . '.' . $extension;
            $file->move('uploads/suratmasuk/', $filename);
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

        return redirect()->back();
    }
}
