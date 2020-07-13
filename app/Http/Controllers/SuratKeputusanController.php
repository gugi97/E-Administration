<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\SuratKeputusan;
use App\Kaprodi;
use App\Dekan;
use App\User;
use App\Dosen;
use App\Mail\NotifSKDosen;
use App\Mail\NotifSKKaprodi;


class SuratKeputusanController extends Controller
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
        $dosen = Dosen::all();

        return view('sk.transaksi.skindex', ['sk'=> $sk, 'dosen'=> $dosen]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sk = SuratKeputusan::all();
        $kaprodi = SuratKeputusan::getalluser();
        $alltemplate = SuratKeputusan::getalltemplate();
        $nama = Auth::user()->name;
        $nip = User::where('name',$nama)->first();
        return view('sk.transaksi.skcreate', ['sk'=> $sk, 'alltemplate' => $alltemplate, 'nama' => $nama, 'nip' => $nip, 'kaprodi' => $kaprodi]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = [
			'hasil.required' => 'Data harus di Generate terlebih dahulu'
        ];
        
        $this->validate($request,[
            'nosk' => 'required|unique:suratkeputusan',
            'tentangsk' => 'required',
            'tglsk' => 'required',
            'semester' => 'required',
            'tahunajar' => 'required',
            'tujuan' => 'required',
            'hasil' => 'required'
        ]);

        $sk = new SuratKeputusan;
        $kaprodi = new Kaprodi;

        $sk->nosk = $request->input('nosk');
        $sk->tentangsk = $request->input('tentangsk');
        
        $kaprodi->noreq = $request->input('nosk');
        $kaprodi->statusreq = $sk->status;
        
        $sk->tglsk = $request->input('tglsk');
        $sk->semester = $request->input('semester');
        $sk->tahunajar = $request->input('tahunajar');
        $sk->template = $request->input('hasil');

        $kaprodi->template = $request->input('hasil');
        
        $sk->nip = $request->input('nip');

        $sk->save();

        $kaprodi->idreq = $sk->idsk;

        $kaprodi->save();

        \Mail::to($request->input('tujuan'))->send(new NotifSKKaprodi);

        return redirect('suratkeputusan')->with('success', 'Data Saved');
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
        $sk = SuratKeputusan::where('idsk',$id)->get();
        $alltemplate = SuratKeputusan::getalltemplate();
        $kaprodi = SuratKeputusan::getalluser();

        return view ('sk.transaksi.skedit', ['sk' => $sk, 'alltemplate' => $alltemplate, 'kaprodi' => $kaprodi]);
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
            'tentangsk' => 'required',
            'tglsk' => 'required',
            'semester' => 'required',
            'tahunajar' => 'required',
            'tujuan' => 'required',
            'hasil' => 'required'
        ]);

        $sk = SuratKeputusan::find($id);
        $kaprodi = Kaprodi::find($id);

        $sk->tentangsk = $request->input('tentangsk');

        $sk->tglsk = $request->input('tglsk');
        $sk->semester = $request->input('semester');
        $sk->tahunajar = $request->input('tahunajar');
        $sk->template = $request->input('hasil');

        $kaprodi->template = $request->input('hasil');

        $sk->save();
        $kaprodi->save();

        \Mail::to($request->input('tujuan'))->send(new NotifSKKaprodi);

        return redirect('suratkeputusan')->with('success', 'Data Saved');
    }

    public function kirim(Request $request, $id)
    {   
        $dosen = $request->input('dosen');
		foreach($dosen as $email){
            $dosen = $email;

            $sk = SuratKeputusan::find($id);
            $lokfiles = $sk->lokasifile;
            $files  = $lokfiles.$sk->file;
            $namafiles = $sk->file;
                
            \Mail::to($dosen)->send(new NotifSKDosen($files, $namafiles));
        }

        return redirect('suratkeputusan')->with('success', 'File Terkirim');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sk = SuratKeputusan::where('idsk', $id)->first();
        $kaprodi = Kaprodi::where('idreq', $id)->first();
        $dekan = dekan::where('id_dekan', $id)->first();
        if($dekan != null){
            $dekan->delete();
        }
        $sk->delete();
        $kaprodi->delete();

        return redirect('suratkeputusan')->with('success', 'Data Deleted');
    }
}
