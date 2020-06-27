<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            'noreq' => 'required',
            'nip' => 'required',
            'ttd' => 'required',
            'skreq' => 'required',
            'statusreq' => 'required',
        ]);

        $kaprodi = Kaprodi::find($id);

        $kaprodi->noreq = $request->input('noreq');
        $kaprodi->nip = $request->input('nip');
        $kaprodi->ttd = $request->input('ttd');
        $kaprodi->skreq = $request->input('skreq');
        $kaprodi->statusreq = $request->input('statusreq');

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
