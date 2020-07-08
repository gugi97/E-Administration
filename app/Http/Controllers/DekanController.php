<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Dekan;
use App\Kaprodi;
use App\SuratKeputusan;


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
        $dekan = Dekan::all();
        $kaprodi = Kaprodi::all();
        $sk = SuratKeputusan::all();

        return view('dekan.index_dekan', ['dekan'=> $dekan, 'sk'=> $sk, 'kaprodi'=> $kaprodi]);
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
        if($dekan_nip->nip_dekan == ""){
            $dekan_nip->nip_dekan = Auth::user()->nip;
            $dekan_nip->save();
        }


        return view ('dekan.edit_dekan', ['dekan' => $dekan]);
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
            'hasil' => 'required'
        ]);

        $dekan = new Dekan;
        $suratkeputusan = new SuratKeputusan;
        
        $dekan = Dekan::find($id);
        
        $dekan->statusreq_dekan = $request->input('statusreq_dekan');
        $dekan->template = $request->input('hasil');

        // if($files = $request->file('ttd')){
		// 	//Hapus File
        //     $file_ttd = Dekan::where('noreq_dekan',$id)->first();
        //     $tujuan_uploadfile = 'uploads/dekan/'.\Carbon\Carbon::now()->format('Y-m-d').'/ TTD';
		// 	$hidden_tujuanfile = $file_ttd->$tujuan_uploadfile;
		// 	$lokasittd = $file_ttd->$tujuan_uploadfile;
		// 	$filename = $lokasittd;
		// 	File::deleteDirectory($filename);
        //     $namefile=$files->getClientOriginalName();
        //     if($hidden_tujuanfile == null){
        //         $files->move($tujuan_uploadfile,$namefile);
        //     }else{
        //         $tujuan_uploadfile=$hidden_tujuanfile;
		// 	    $files->move($tujuan_uploadfile,$namefile);
        //     }
		// }else{
		// 	$file_ttd = Dekan::where('noreq_dekan',$id)->first();
		// 	$tujuan_uploadfile = 'uploads/dekan/'.\Carbon\Carbon::now()->format('Y-m-d').'/ TTD';
        //     $hidden_tujuanfile = $file_ttd->$tujuan_uploadfile;
        //     $namefiles = null;
		// 	$hidden_namafile = $file_ttd->$namefiles;
		// 	$namefile = $hidden_namafile;
		// 	$tujuan_uploadfile = $hidden_tujuanfile;
        // }

        // Dekan::where('noreq_dekan',$id)->update([
		// 	'ttd_dekan' => $namefile,
		// ]);
        
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
