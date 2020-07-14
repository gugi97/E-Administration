<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Dekan;
use App\Kaprodi;
use App\SuratKeputusan;
use App\Mail\NotifSKDekan;
use Illuminate\Support\Facades\DB;


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
        // $sk = SuratKeputusan::all();
        // $kaprodi = Kaprodi::all();

        $skdankaprodi = DB::table('kaprodi')
            ->join('suratkeputusan', 'kaprodi.idreq', '=', 'suratkeputusan.idsk')
            ->select('kaprodi.*', 'suratkeputusan.*')
            ->get();

        return view('kaprodi.index_kaprodi', ['skdankaprodi'=> $skdankaprodi]);
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
        $dekan = Kaprodi::getalluser();

        if($kapnip->nip == ""){
            $kapnip->nip = Auth::user()->nip;
            $kapnip->save();
        }

        return view ('kaprodi.edit_kaprodi', ['kaprodi' => $kaprodi, 'dekan' => $dekan]);
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
            'tujuan' => 'required'
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

        $nip = User::where('nip', $kaprodi->nip)->first();
        $email = $nip->email;
        $nama = $nip->name;        

        if($kaprodi->statusreq == "Diterima"){
            \Mail::to($request->input('tujuan'))->send(new NotifSKDekan($email, $nama));
        }

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
        
    }
}
