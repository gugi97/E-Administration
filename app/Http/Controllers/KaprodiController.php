<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Dekan;
use App\Kaprodi;
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
        $kaprodi = Kaprodi::where('idreq',$id)->get();
        $kapnip = Kaprodi::find($id);
        if($kapnip->nip == ""){
            $kapnip->nip = Auth::user()->nip;
            $kapnip->save();
        }

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
            'statusreq' => 'required',
        ]);

        $dekan = new Dekan;
        $kaprodi = new Kaprodi;
        $suratkeputusan = new SuratKeputusan;

        $kaprodi = Kaprodi::find($id);
        $kaprodi->nip = Auth::user()->nip;
        $kaprodi->statusreq = $request->input('statusreq');
        
        if($kaprodi->statusreq == "Ditolak"){
            $dekan = Dekan::find($id);
            if($dekan != $kaprodi){
                $dekan = Dekan::where('id_dekan',$id)->first();
                if($dekan != null){
                    $dekan->delete();
                }
                $suratkeputusan = SuratKeputusan::find($id);
                $suratkeputusan->status = "Ditolak";
                $suratkeputusan->save();
            }
        }elseif($kaprodi->statusreq == "Diterima"){
            $dekan = Dekan::find($id);
            if($dekan != null){  
                if($dekan->id_dekan == $kaprodi->idreq){
                $dekan->statusreq_dekan = "Diterima";
                $dekan->save();
                }
            }else{
                $dekan = new Dekan;
                $dekan->id_dekan = $kaprodi->idreq;

                $dekan->noreq_dekan = $kaprodi->noreq;
                $dekan->statusreq_dekan = "Menunggu Persetujuan";
                $dekan->template = $kaprodi->template;
                $dekan->save();
                $suratkeputusan = SuratKeputusan::find($id);
                $suratkeputusan->status = "Diterima (Kaprodi)";
                $suratkeputusan->save();
            }
        }
        
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
        $kaprodi = Kaprodi::where('idreq',$id)->first();
        $kaprodi->delete();

        return redirect('kaprodi')->with('success', 'Data Deleted');
    }
}
