<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        
        $sm_count = DB::table('suratmasuk')->count();
        $sk_count = DB::table('suratkeluar')->count();
        $skep_count = DB::table('suratkeputusan')->count();
        $user_count = DB::table('users')->where('status', 'Staf')->orWhere('status', 'Dosen')->orWhere('status', 'Dekan')->orWhere('status', 'Ketua Program Studi')->count();
        
        return view('home', ['sm_count' => $sm_count, 'sk_count' => $sk_count, 'skep_count' => $skep_count, 'user_count' => $user_count]);
    }
}
