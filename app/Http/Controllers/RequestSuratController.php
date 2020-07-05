<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\RequestSurat;

class RequestSuratController extends Controller
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
        $req = RequestSurat::all();

        return view('request_surat', ['req'=> $req]);
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

    public function diterima(Request $request,$no_req){
        $req = RequestSurat::find($no_req);
        $req->statusreq = "Diterima";
        $req->save();
        return redirect('requestsurat')->with('success', 'Data Diterima');
    }

    public function ditolak(Request $request,$no_req){
        $req = RequestSurat::find($no_req);
        $req->statusreq = "Ditolak";
        $req->save();
        return redirect('requestsurat')->with('success', 'Data Ditolak');
    }

    public function proses(Request $request,$no_req){
        $req = RequestSurat::find($no_req);
        $req->statusreq = "Proses";
        $req->save();
        return redirect('requestsurat')->with('success', 'Data Diproses');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $req = RequestSurat::where('no_req',$id)->first();
        $req->delete();

        return redirect('requestsurat')->with('success', 'Data Deleted');
    }
}
