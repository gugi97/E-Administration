<?php

namespace App\Http\Controllers;

use App\SuratMasuk;
use App\User;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArsipSuratMasukController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // mengambil data dari table suratmasuk
        $arsipsuratmasuk = SuratMasuk::getallsuratmasuk();

    	// mengirim data suratmasuk ke view index
		return view('arsipsuratmasuk',['arsipsuratmasuk' => $arsipsuratmasuk]);
    }

    public function indexfile()
    {
		// mengambil data dari table suratmasuk
        $arsipfilesuratmasuk = SuratMasuk::getallsuratmasuk();
        
    	// mengirim data suratmasuk ke view index
		return view('arsipfilesuratmasuk',['arsipfilesuratmasuk' => $arsipfilesuratmasuk]);
	}
}
