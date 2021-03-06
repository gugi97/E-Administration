<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Dekan;
use App\Kaprodi;
use App\SuratKeputusan;
use PDF;
use Storage;
use QrCode;


class DekanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $dekan = Dekan::all();
        // $kaprodi = Kaprodi::all();
        // $sk = SuratKeputusan::all();

        $skdankaprodidandekan = DB::table('dekan')
            ->join('suratkeputusan', 'dekan.id_dekan', '=', 'suratkeputusan.idsk')
            ->join('kaprodi', 'dekan.id_dekan', '=', 'kaprodi.idreq')
            ->select('dekan.id_dekan', 'dekan.noreq_dekan', 'dekan.statusreq_dekan', 'suratkeputusan.tglsk', 'kaprodi.nip')
            ->get();

        return view('dekan.index_dekan', ['skdankaprodidandekan'=> $skdankaprodidandekan]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dekan = Dekan::where('id_dekan',$id)->get();
        $dekan_nip = Dekan::find($id);

        $dekan2 = Dekan::find($id);
        $qrcode = base64_encode(QrCode::format('png')->merge('logo-bl.png', 0.3, true)->size(100)->errorCorrection('H')->generate($dekan2->noreq_dekan));
        if($dekan_nip->nip_dekan == ""){
            $dekan_nip->nip_dekan = Auth::user()->nip;
            $dekan_nip->save();
        }

        return view ('dekan.edit_dekan', ['dekan' => $dekan, 'qrcode' => $qrcode]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $messages = [
			'hasil.required' => 'Data harus di Generate terlebih dahulu'
        ];

        $this->validate($request,[
            'statusreq_dekan' => 'required',
            'ttd' => 'image|mimes:jpeg,png',
            'hasil' => 'required'
        ]);

        $dekan = new Dekan;
        $suratkeputusan = new SuratKeputusan;
        
        $dekan = Dekan::find($id);
        $dekan->statusreq_dekan = $request->input('statusreq_dekan');
        $dekan->template = $request->input('hasil');

        if($dekan->statusreq_dekan == "Disetujui"){
            $suratkeputusan = SuratKeputusan::find($id);
            $suratkeputusan->status = "Disetujui (Dekan)";
            $dekan->statusreq_dekan = "Disetujui";

            $lokasifile = 'uploads/suratkeputusan/'.\Carbon\Carbon::now()->format('Y-m-d').'/';
            $pdf = PDF::loadview('dekan.templatedekan_pdf',['templatebaru'=>$request->input('hasil')]);
            //->setPaper('Legal', 'portrait');
            $namafile = 'SURATKEPUTUSAN'.'-'.time().'-'.$suratkeputusan->tglsk;
            if(file_exists($lokasifile)) {
                file_put_contents('uploads/suratkeputusan/'.\Carbon\Carbon::now()->format('Y-m-d').'/'.$namafile.'.pdf', $pdf->output());   
            }else{
                File::makeDirectory($lokasifile,0777,true);
                file_put_contents('uploads/suratkeputusan/'.\Carbon\Carbon::now()->format('Y-m-d').'/'.$namafile.'.pdf' , $pdf->output());
            }
            $suratkeputusan->file = $namafile.'.pdf';
            $suratkeputusan->lokasifile = $lokasifile;
            $suratkeputusan->save();
        }elseif($dekan->statusreq_dekan == "Tidak Disetujui"){
            $suratkeputusan = SuratKeputusan::find($id);
            $suratkeputusan->status = "Tidak Disetujui";
            $suratkeputusan->save();
            $dekan->statusreq_dekan = "Tidak Disetujui";
            $dekan->save();
        }
        
        $dekan->save();

        return redirect('dekan')->with('success', 'Data Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dekan = Dekan::where('id_dekan',$id)->first();
        $dekan->delete();

        return redirect('dekan')->with('success', 'Data Deleted');
    }
}
