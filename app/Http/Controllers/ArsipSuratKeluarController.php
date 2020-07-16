<?php

namespace App\Http\Controllers;

use App\SuratKeluar;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArsipSuratKeluarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
		// mengambil data dari table suratkeluar
        $arsipsuratkeluar = SuratKeluar::getallsuratkeluar();
        
    	// mengirim data suratkeluar ke view index
		return view('arsipsuratkeluar',['arsipsuratkeluar' => $arsipsuratkeluar]);
    }
    
    public function indexfile()
    {
		// mengambil data dari table suratkeluar
        $arsipfilesuratkeluar = SuratKeluar::getallsuratkeluar();
        
    	// mengirim data suratkeluar ke view index
		return view('arsipfilesuratkeluar',['arsipfilesuratkeluar' => $arsipfilesuratkeluar]);
    }
    
    public function show($id_suratkeluar)
    {
        $data = SuratKeluar::find($id_suratkeluar);
        
		return view('arsipfilesuratkeluarview',['data' => $data]);
	}
}
