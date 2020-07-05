<?php

namespace App\Http\Controllers;

use App\SuratKeluar;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class AgendaSuratKeluarController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function index()
  {
      // mengambil data dari table suratkeluar
      $agendasuratkeluar = SuratKeluar::getallsuratkeluar();
      $orders = null;

    // mengirim data suratkeluar ke view index
    return view('agendasuratkeluar',['agendasuratkeluar' => $agendasuratkeluar, 'orders' => $orders]);
  }

  public function cari(Request $request)
  {
      $dari_tgl = $request->input('dari_tgl');
      $sampai_tgl = $request->input('sampai_tgl');

      $orders = SuratKeluar::whereBetween('tgl_suratkeluar', [$dari_tgl, $sampai_tgl])->get();

      return view('agendasuratkeluar', compact('orders'), ['dari_tgl'=>$dari_tgl, 'sampai_tgl'=>$sampai_tgl]);
  }

  public function cetak_pdf(Request $request)
  {
      $dari_tgl2 = $request->input('dari_tgl2');
      $sampai_tgl2 = $request->input('sampai_tgl2');

    $data = SuratKeluar::whereBetween('tgl_suratkeluar', [$dari_tgl2, $sampai_tgl2])->get();

    $pdf = PDF::loadview('agendasuratkeluar_pdf',['data'=>$data, 'dari_tgl2'=>$dari_tgl2, 'sampai_tgl2'=>$sampai_tgl2]);
    return $pdf->stream();
  }
}
