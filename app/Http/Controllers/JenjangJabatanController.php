<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\JenjangJabatan;
use App\UnitInduk;
use App\UnitSurat;
use App\User;

class JenjangJabatanController extends Controller
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
        $jenjang = JenjangJabatan::all();
        $induk = UnitInduk::all();
        $surat = UnitSurat::all();
        return view('jenjang_jabatan', ['jenjang'=> $jenjang, 'induk' => $induk, 'surat' => $surat]);
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
        $messages = [
			'numeric' => ':attribute hanya bisa diisi oleh angka saja!',
        ];
        
        $this->validate($request,[
            'kdjabatan' => 'required,numeric',
            'nmjabatan' => 'required',
            'untinduk' => 'required',
            'untsurat' => 'required',
        ]);

        $jenjang = new JenjangJabatan;

        $jenjang->kode_jenjang = $request->input('kdjabatan');
        $jenjang->nama_jabatan = $request->input('nmjabatan');
        $jenjang->kode_unitinduk = $request->input('untinduk');
        $jenjang->kode_unitsurat = $request->input('untsurat');

        $jenjang->save();

        return redirect('jenjangjabatan')->with('success', 'Data Saved');
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
    public function update(Request $request, $kode)
    {
        $messages = [
			'numeric' => ':attribute hanya bisa diisi oleh angka saja!',
        ];

        $this->validate($request,[
            'kdjabatan' => 'required,numeric',
            'nmjabatan' => 'required',
            'untinduk' => 'required',
            'untsurat' => 'required',
        ]);

        $jenjang = JenjangJabatan::where('id',$kode)->first();

        $jenjang->kode_jenjang = $request->input('kdjabatan');
        $jenjang->nama_jabatan = $request->input('nmjabatan');
        $jenjang->kode_unitinduk = $request->input('untinduk');
        $jenjang->kode_unitsurat = $request->input('untsurat');

        $jenjang->save();

        return redirect('jenjangjabatan')->with('success', 'Data Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($kode)
    {
        $jenjang = JenjangJabatan::where('id',$kode)->first();
        $jenjang->delete();

        return redirect('jenjangjabatan')->with('success', 'Data Deleted');
    }
}
