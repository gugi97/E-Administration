<?php

namespace App\Http\Controllers;

use App\SuratKeputusan;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArsipSuratKeputusanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
		// mengambil data dari table suratkeputusan
        $arsipsuratkeputusan = SuratKeputusan::getallsuratkeputusan();
        
    	// mengirim data suratkeputusan ke view index
		return view('arsipsuratkeputusan',['arsipsuratkeputusan' => $arsipsuratkeputusan]);
    }
    
    public function indexfile()
    {
		// mengambil data dari table suratkeputusan
        $arsipfilesuratkeputusan = SuratKeputusan::getallsuratkeputusan();
        
    	// mengirim data suratkeputusan ke view index
		return view('arsipfilesuratkeputusan',['arsipfilesuratkeputusan' => $arsipfilesuratkeputusan]);
    }
    
    public function show($idsk)
    {
        $data = SuratKeputusan::find($idsk);
        
		return view('arsipfilesuratkeluarview',['data' => $data]);
	}
}
