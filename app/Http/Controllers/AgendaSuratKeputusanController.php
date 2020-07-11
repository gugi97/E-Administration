<?php

namespace App\Http\Controllers;

use App\SuratKeputusan;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class AgendaSuratKeputusanController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function index()
  {
      // mengambil data dari table suratkeputusan
      $agendasuratkeputusan = SuratKeputusan::getallsuratkeputusan();
      $orders = null;

    // mengirim data suratkeputusan ke view index
    return view('agendasuratkeputusan',['agendasuratkeputusan' => $agendasuratkeputusan, 'orders' => $orders]);
  }

  public function cari(Request $request)
  {
      $dari_tgl = $request->input('dari_tgl');
      $sampai_tgl = $request->input('sampai_tgl');

      $orders = SuratKeputusan::whereBetween('tglsk', [$dari_tgl, $sampai_tgl])->get();

      $test = count($orders);

      return view('agendasuratkeputusan', compact('orders'), ['dari_tgl'=>$dari_tgl, 'sampai_tgl'=>$sampai_tgl, 'test'=>$test]);
  }

  public function cetak_pdf(Request $request)
  {
      $dari_tgl2 = $request->input('dari_tgl2');
      $sampai_tgl2 = $request->input('sampai_tgl2');

      $data = SuratKeputusan::whereBetween('tglsk', [$dari_tgl2, $sampai_tgl2])->get();

      $pdf = PDF::loadview('agendasuratkeputusan_pdf',['data'=>$data, 'dari_tgl2'=>$dari_tgl2, 'sampai_tgl2'=>$sampai_tgl2]);
      return $pdf->stream();
  }
}
