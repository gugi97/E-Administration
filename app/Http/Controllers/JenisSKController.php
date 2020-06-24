<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\JenisSK;

class JenisSKController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * untuk membaca seluruh data dan biasanya akan me-return sebuah view
     * kemudian mengambil data tabel tertentu dari database
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jenis = JenisSK::all();
        return view('sk.jenis_sk_index', ['jenis'=> $jenis]);
    }

    /**
     * tidak dibuat untuk proses insert data pada database melainkan hanya menampilkan form create
     * method create ini hanya me-return view saja
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jenis = JenisSK::all();
        return view('sk.jenis_sk_create', ['jenis'=> $jenis]);
    }

    /**
     * Untuk proses insert, gunakan method create pada model untuk menginsert data
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'jenissk' => 'required',
            'namask' => 'required',
            'templatesk' => 'required',
        ]);

        $jenis = new JenisSK;

        $jenis->jenis_sk = $request->input('jenissk');
        $jenis->nama_template = $request->input('namask');
        $jenis->template = $request->input('templatesk');

        $jenis->save();

        return redirect('jenissk')->with('success', 'Data Saved');
    }

    /**
     * Hanya mengambil single data dengan id sebagai parameternya
     * biasanya method ini digunakan untuk melihat detail dari satu row data
     * isi viewnya tidak harus berupa form bisa saja hanya list detail saja
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Mengambil single data, view-nya harus berupa form
     * sebab disinilah user akan melakukan proses edit data hingga update
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $jenis = JenisSK::where('idjenis_sk',$id)->get();
        return view ('sk.jenis_sk_edit', ['jenis' => $jenis]);
    }

    /**
     * Sama seperti create, hanya saja eloquent method yang digunakan berbeda
     * Method update hanya bisa dipanggil ketika single collectionnya sudah diterima
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'jenissk' => 'required',
            'namask' => 'required',
            'templatesk' => 'required',
        ]);

        $jenis = JenisSK::find($id);

        $jenis->jenis_sk = $request->input('jenissk');
        $jenis->nama_template = $request->input('namask');
        $jenis->template = $request->input('templatesk');

        $jenis->save();

        return redirect('jenissk')->with('success', 'Data Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($kode)
    {
        $jenis = JenisSk::where('idjenis_sk', $kode)->first();
        $jenis->delete();

        return redirect('jenissk')->with('success', 'Data Deleted');
    }
}
