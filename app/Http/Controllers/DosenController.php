<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Dosen;

class DosenController extends Controller
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
        $dosen = Dosen::all();
        return view('dosen', ['dosen'=> $dosen]);
    }

    /**
     * tidak dibuat untuk proses insert data pada database melainkan hanya menampilkan form create
     * method create ini hanya me-return view saja
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $dosen = Dosen::all();
        // return view('dosen', ['dosen'=> $dosen]);
    }

    /**
     * Untuk proses insert, gunakan method create pada model untuk menginsert data
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = [
            'numeric' => ':attribute hanya bisa diisi oleh angka saja!',
            'min' => ':attribute harus 9 digit',
            'unique' => ':attribute sudah ada atau sudah dipakai!'
        ];

        $this->validate($request,[
            'nip' => 'required|numeric|min:9|unique:dosen',
            'gelar_depan' => 'nullable',
            'name' => 'required',
            'gelar_belakang' => 'required',
            'no_hp' => 'required|numeric',
            'email' => 'required|unique:dosen',
        ]);

        $dosen = new Dosen;

        $dosen->nip = $request->input('nip');
        $dosen->gelar_depan = $request->input('gelar_depan');
        $dosen->name = $request->input('name');
        $dosen->gelar_belakang = $request->input('gelar_belakang');
        $dosen->no_hp = $request->input('no_hp');
        $dosen->email = $request->input('email');

        $dosen->save();

        return redirect('dosen')->with('success', 'Data Saved');
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
        // $dosen = Dosen::where('id',$id)->get();
        // return view ('dosen', ['dosen' => $dosen]);
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
        $messages = [
            'numeric' => ':attribute hanya bisa diisi oleh angka saja!',
            'min' => ':attribute harus 9 digit'
        ];

        $this->validate($request,[
            'nip' => 'required|numeric|min:9',
            'gelar_depan' => 'required',
            'name' => 'required',
            'gelar_belakang' => 'required',
            'no_hp' => 'required|numeric',
            'email' => 'required',
        ]);

        $dosen = new Dosen;
        $dosen = Dosen::findOrFail($id);

        $dosen->nip = $request->input('nip');
        $dosen->gelar_depan = $request->input('gelar_depan');
        $dosen->name = $request->input('name');
        $dosen->gelar_belakang = $request->input('gelar_belakang');
        $dosen->no_hp = $request->input('no_hp');
        $dosen->email = $request->input('email');

        $dosen->save();

        return redirect('dosen')->with('success', 'Data Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dosen = Dosen::find($id);

        $dosen->delete();
        return redirect('dosen')->with('success', 'Data Deleted');
    }
}
