<?php

namespace App\Http\Controllers;

use App\SuratMasuk;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class AgendaSuratMasukController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // mengambil data dari table suratmasuk
        $agendasuratmasuk = SuratMasuk::getallsuratmasuk();
        $orders = null;

    	// mengirim data suratmasuk ke view index
		return view('agendasuratmasuk',['agendasuratmasuk' => $agendasuratmasuk, 'orders' => $orders]);
    }

    public function cari(Request $request)
    {
        $dari_tgl = $request->input('dari_tgl');
        $sampai_tgl = $request->input('sampai_tgl');

        $orders = SuratMasuk::whereBetween('tgl_surat', [$dari_tgl, $sampai_tgl])->get();
        $test = count($orders);

        return view('agendasuratmasuk', compact('orders'), ['dari_tgl'=>$dari_tgl, 'sampai_tgl'=>$sampai_tgl, 'test'=>$test]);
    }

    public function cetak_pdf(Request $request)
    {
        $dari_tgl2 = $request->input('dari_tgl2');
        $sampai_tgl2 = $request->input('sampai_tgl2');

    	$data = SuratMasuk::whereBetween('tgl_surat', [$dari_tgl2, $sampai_tgl2])->get();
 
    	$pdf = PDF::loadview('agendasuratmasuk_pdf',['data'=>$data, 'dari_tgl2'=>$dari_tgl2, 'sampai_tgl2'=>$sampai_tgl2]);
    	return $pdf->stream();
    }
}
