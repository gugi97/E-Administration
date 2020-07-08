<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Dekan;
use App\Kaprodi;
use App\SuratKeputusan;


class DekanController extends Controller
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
        $dekan = Dekan::all();
        $kaprodi = Kaprodi::all();
        $sk = SuratKeputusan::all();

        return view('dekan.index_dekan', ['dekan'=> $dekan, 'sk'=> $sk, 'kaprodi'=> $kaprodi]);
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
        $dekan = Dekan::where('id_dekan',$id)->get();
        return view ('dekan.edit_dekan', ['dekan' => $dekan]);
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
        ]);

        $dekan = new Dekan;
        $dekan = Dekan::find($id);
        
        $dekan->statusreq_dekan = $request->input('statusreq');
        
        $dekan->save();

        return redirect('dekan')->with('success', 'Data Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dekan = Dekan::where('id_dekan',$id)->first();
        $dekan->delete();

        return redirect('dekan')->with('success', 'Data Deleted');
    }
}
