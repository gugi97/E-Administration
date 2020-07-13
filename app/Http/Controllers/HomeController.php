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

        $req_count = DB::table('request_surat')->count();
        $req_terima = DB::table('request_surat')->where('statusreq', 'Diterima')->count();
        $req_proses = DB::table('request_surat')->where('statusreq', 'Proses')->count();
        $req_tolak = DB::table('request_surat')->where('statusreq', 'Ditolak')->count();

        $req_kapreq = DB::table('kaprodi')->count();
        $req_kapreq_prop = DB::table('kaprodi')->where('statusreq', 'Proposed')->count();
        $req_kapreq_terima = DB::table('kaprodi')->where('statusreq', 'Diterima')->count();
        $req_kapreq_tolak = DB::table('kaprodi')->where('statusreq', 'Ditolak')->count();

        $req_dekreq = DB::table('dekan')->count();
        $req_dekreq_prop = DB::table('dekan')->where('statusreq_dekan', 'Menunggu Persetujuan')->count();
        $req_dekreq_terima = DB::table('dekan')->where('statusreq_dekan', 'Disetujui')->count();
        $req_dekreq_tolak = DB::table('dekan')->where('statusreq_dekan', 'Tidak Disetujui')->count();

        $user_count = DB::table('users')->where('status', 'Staf')->orWhere('status', 'Dosen')->orWhere('status', 'Dekan')->orWhere('status', 'Ketua Program Studi')->count();
        
        return view('home', ['req_count' => $req_count,
                             'req_terima' => $req_terima,
                             'req_proses' => $req_proses,
                             'req_tolak' => $req_tolak, 
                             'sm_count' => $sm_count, 
                             'sk_count' => $sk_count, 
                             'skep_count' => $skep_count, 
                             'user_count' => $user_count,
                             'req_kapreq' => $req_kapreq,
                             'req_kapreq_prop' => $req_kapreq_prop,
                             'req_kapreq_terima' => $req_kapreq_terima,
                             'req_kapreq_tolak' => $req_kapreq_tolak,
                             'req_dekreq' => $req_dekreq,
                             'req_dekreq_prop' => $req_dekreq_prop,
                             'req_dekreq_terima' => $req_dekreq_terima,
                             'req_dekreq_tolak' => $req_dekreq_tolak,]);
    }
}
