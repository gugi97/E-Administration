<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\RequestSurat;

class DosenRequestController extends Controller
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
        $reqdos = RequestSurat::all();

        return view('dosen_request', ['reqdos'=> $reqdos]);
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
        $this->validate($request,[
            'nip' => 'required',
            'kebutuhan' => 'required',
            'detailsurat' => 'required',
            'maxtglsurat' => 'required'
        ]);
        $nama = Auth::user()->name;

        $reqdos = new RequestSurat;

        $reqdos->nip = $request->input('nip');
        $reqdos->kebutuhan = $request->input('kebutuhan');
        $reqdos->detail_surat = $request->input('detailsurat');
        $reqdos->tgl_maxsurat = $request->input('maxtglsurat');
        $reqdos->nama = $nama;  

        $reqdos->save();

        return redirect('dosenrequest')->with('success', 'Data Saved');
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
        //
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
            'kebutuhan' => 'required',
            'detailsurat' => 'required',
            'maxtglsurat' => 'required',
        ]);

        $reqdos = RequestSurat::where('no_req',$id)->first();

        $reqdos->kebutuhan = $request->input('kebutuhan');
        $reqdos->detail_surat = $request->input('detailsurat');
        $reqdos->tgl_maxsurat = $request->input('maxtglsurat');

        $reqdos->save();

        return redirect('dosenrequest')->with('success', 'Data Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reqdos = RequestSurat::where('no_req',$id)->first();
        $reqdos->delete();

        return redirect('dosenrequest')->with('success', 'Data Deleted');
    }
}
