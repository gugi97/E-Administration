<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SuratMasuk;

class SuratMasukControllerk extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $alljenis = $this->modeljenis->getalluser();
        $alljabatan = $this->modeljabatan->getalluser();
        $nama = $this->session->nama;
        $nip = $this->modeluser->ambiladmin($nama);
            $data['nama'] = $nama;
        $data['jabatan'] = $alljabatan;
        $data['coba'] = $nip;
        $data['jenis'] = $alljenis;
        return view('suratmasuk', $data);
    }
}
