<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Kaprodi;
use Illuminate\Support\Facades\File;
use App\SuratKeputusan;


class KaprodiController extends Controller
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
        $sk = SuratKeputusan::all();
        $kaprodi = Kaprodi::all();

        return view('kaprodi.index_kaprodi', ['sk'=> $sk, 'kaprodi'=> $kaprodi]);
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
        $kaprodi = Kaprodi::where('noreq',$id)->get();
        return view ('kaprodi.edit_kaprodi', ['kaprodi' => $kaprodi]);
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
        $this->validate($request,[
            'nip' => 'required',
            'ttd' => 'required',
            'statusreq' => 'required',
        ]);

        $kaprodi = Kaprodi::find($id);
        $kaprodi->nip = $request->input('nip');
        $kaprodi->statusreq = $request->input('statusreq');

        if($files = $request->file('ttd')){
			//Hapus File
            $file_ttd = Kaprodi::where('noreq',$id)->first();
            $tujuan_uploadfile = 'uploads/kaprodi/'.\Carbon\Carbon::now()->format('Y-m-d').'/ TTD';
			$hidden_tujuanfile = $file_ttd->$tujuan_uploadfile;
			$lokasittd = $file_ttd->$tujuan_uploadfile;
			$filename = $lokasittd;
			File::deleteDirectory($filename);
            $namefile=$files->getClientOriginalName();
            if($hidden_tujuanfile == null){
                $files->move($tujuan_uploadfile,$namefile);
            }else{
                $tujuan_uploadfile=$hidden_tujuanfile;
			    $files->move($tujuan_uploadfile,$namefile);
            }
		}else{
			$file_ttd = Kaprodi::where('noreq',$id)->first();
			$tujuan_uploadfile = 'uploads/kaprodi/'.\Carbon\Carbon::now()->format('Y-m-d').'/ TTD';
            $hidden_tujuanfile = $file_ttd->$tujuan_uploadfile;
            $namefiles = null;
			$hidden_namafile = $file_ttd->$namefiles;
			$namefile = $hidden_namafile;
			$tujuan_uploadfile = $hidden_tujuanfile;
        }
        
        Kaprodi::where('noreq',$id)->update([
			'ttd' => $namefile,
		]);

        $kaprodi->save();

        return redirect('kaprodi')->with('success', 'Data Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
