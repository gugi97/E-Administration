<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\SuratKeputusan;

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
        return view('sk.transaksi.skindex', ['sk'=> $sk]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sk = SuratKeputusan::all();
        return view('sk.transaksi.skcreate', ['sk'=> $sk]);
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
            'nosk' => 'required',
            'tglsk' => 'required',
            'userstaff' => 'required',
            'semester' => 'required',
            'tahunajar' => 'required',
        ]);

        $sk = new SuratKeputusan;

        $sk->nosk = $request->input('nosk');
        $sk->tglsk = $request->input('tglsk');
        $sk->userstaff = $request->input('userstaff');
        $sk->semester = $request->input('semester');
        $sk->tahunajar = $request->input('tahunajar');

        $sk->save();

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
        //
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
