<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Jenis;
use App\Rules\HurufBesar;

class JenisSuratController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $jns = Jenis::all();
        return view('jenis_surat')->with('jenis', $jns);
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
            'kode_jenissurat' => ['required', new HurufBesar, 'unique:jenis_surat'],
            'namajns' => 'required',
        ]);

        $jns = new Jenis;

        $jns->kode_jenissurat = $request->input('kode_jenissurat');
        $jns->nama_jenissurat = $request->input('namajns');

        $jns->save();

        return redirect('jenissurat')->with('success', 'Data Saved');
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
    public function edit(Request $request, $id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $kode)
    {
        $this->validate($request,[
            'namajns' => 'required',
        ]);

        $jns = Jenis::where('kode_jenissurat',$kode)->first();

        $jns->nama_jenissurat = $request->input('namajns');

        $jns->save();

        return redirect('jenissurat')->with('success', 'Data Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($kode)
    {
        $jns = Jenis::where('kode_jenissurat',$kode)->first();
        $jns->delete();

        return redirect('jenissurat')->with('success', 'Data Deleted');
    }
}
