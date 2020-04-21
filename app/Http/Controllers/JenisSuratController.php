<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Jenis;
use App\User;

class JenisSuratController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // $alluser = Jenis::getalluser();
        // $nama = Auth::user()->name;
        // // $admin = $this->modeluser->ambiladmin($nama);
  	    // // $data['coba'] = $admin;
        // $data['nama'] = $nama;
        // $data['jenissurat'] = $alluser;
        // return view('jenis_surat', ['inputjenis' => $data]);

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
            'kodejns' => 'required',
            'namajns' => 'required',
        ]);

        $jns = new Jenis;

        $jns->kode_jenissurat = $request->input('kodejns');
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
        $kode = $id;
        $nama = $request->input('nama');

        $result = Jenis::where('kode_jenissurat',$kode)->update([
            'kode_jenissurat' => $kode,
            'nama_jenissurat' => $nama
        ]);

        $data = NULL;
        if($result){
            return view('jenis_surat');
        }else{

            $nama = Auth::user()->name;
            $data['nama'] = $nama;
            $data['result'] = "Gagal";
            return view('jenis_surat', ['inputjenis' => $data]);
        }
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
            'kodejns' => 'required',
            'namajns' => 'required',
        ]);

        $jns = Jenis::find($id);

        $jns->kode_jenissurat = $request->input('kodejns');
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
    public function destroy($id)
    {
        $result = Jenis::DeleteUser($id);

        if($result){
            return redirect()->back();
        }else{
            $nama = Auth::user()->name;
            $data['nama'] = $nama;
            $data['result'] = "Gagal";
            return view('jenis_surat', ['inputjenis' => $data]);
        }
    }
}