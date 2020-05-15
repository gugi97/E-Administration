<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\UnitInduk;
use App\User;

class UnitIndukController extends Controller
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
        $induk = UnitInduk::all();
        return view('unit_induk')->with('induk', $induk);
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
            'untinduk' => 'required',
            'nminduk' => 'required',
        ]);

        $induk = new UnitInduk;

        $induk->kd_unit = $request->input('untinduk');
        $induk->nama_unit = $request->input('nminduk');

        $induk->save();

        return redirect('unitinduk')->with('success', 'Data Saved');
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
        $this->validate($request,[
            'untinduk' => 'required',
            'nminduk' => 'required',
        ]);

        $induk = UnitInduk::where('kd_unit',$kode)->first();

        $induk->kd_unit = $request->input('untinduk');
        $induk->nama_unit = $request->input('nminduk');

        $induk->save();

        return redirect('unitinduk')->with('success', 'Data Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($kode)
    {
        $induk = UnitInduk::where('kd_unit',$kode)->first();
        $induk->delete();

        return redirect('unitinduk')->with('success', 'Data Deleted');
    }
}
