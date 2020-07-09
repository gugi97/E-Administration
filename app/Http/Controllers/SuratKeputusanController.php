<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\SuratKeputusan;
use App\Kaprodi;
use App\User;
use App\Dosen;

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
        $alltemplate = SuratKeputusan::getalltemplate();
        $nama = Auth::user()->name;
        $nip = User::where('name',$nama)->first();
        return view('sk.transaksi.skcreate', ['sk'=> $sk, 'alltemplate' => $alltemplate, 'nama' => $nama, 'nip' => $nip]);
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
            'nosk' => 'required',
            'tentangsk' => 'required',
            'tglsk' => 'required',
            'semester' => 'required',
            'tahunajar' => 'required',
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

        return view ('sk.transaksi.skedit', ['sk' => $sk, 'alltemplate' => $alltemplate,]);
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
            'nosk' => 'required',
            'tentangsk' => 'required',
            'tglsk' => 'required',
            'semester' => 'required',
            'tahunajar' => 'required',
            'hasil' => 'required'
        ]);

        $sk = SuratKeputusan::find($id);
        $kaprodi = Kaprodi::find($id);

        $sk->nosk = $request->input('nosk');
        $sk->tentangsk = $request->input('tentangsk');

        $kaprodi->noreq = $request->input('nosk');

        $sk->tglsk = $request->input('tglsk');
        $sk->semester = $request->input('semester');
        $sk->tahunajar = $request->input('tahunajar');
        $sk->template = $request->input('hasil');

        $kaprodi->template = $request->input('hasil');

        $sk->save();
        $kaprodi->save();

        return redirect('suratkeputusan')->with('success', 'Data Saved');
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
