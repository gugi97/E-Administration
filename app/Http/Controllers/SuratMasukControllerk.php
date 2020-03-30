<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SuratMasuk;
use App\Jenis;

class SuratMasukControllerk extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $alljenis = Jenis::getalluser();
        // $alljabatan = $this->modeljabatan->getalluser();
        // $nama = $this->session->nama;
        // $nip = $this->modeluser->ambiladmin($nama);
        return view('suratmasuk', ['alljenis' => $alljenis]);
    }
}
