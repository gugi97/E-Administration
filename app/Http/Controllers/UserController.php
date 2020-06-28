<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
		// mengambil data dari table user
        $user = User::getalluser();

    	// mengirim data user ke view index
		return view('user',['user' => $user]);
    }
    
    public function edit($id)
	{
		// mengambil data user berdasarkan id yang dipilih
		$user = User::where('id',$id)->get();
		// passing data user yang didapat ke view user_edit.blade.php
		return view('user_edit', ['user' => $user]);
    }

    public function update($id, Request $request)
	{
		$messages = [
			'required' => ':attribute Wajib di isi!',
			'min' => ':attribute harus 9 digit!'
		];

		$this->validate($request,[
            'name' => 'required', 'string', 'max:255',
            'email' => 'required', 'string', 'email', 'max:255', 'unique:users',
            'password' => 'required', 'string', 'min:8', 'confirmed',
            'status' => 'required'
		],$messages);

		// update data user
		User::where('id',$id)->update([
			'name' => $request->name,
			'email' => $request->email,
			'password' => $request->password,
			'status' => $request->status
		]);
		// alihkan halaman ke halaman user
		return redirect('/user');
	}
    
    public function delete($id)
	{
        $user = User::where('id',$id)->first();
        $user->delete();
		// alihkan halaman ke halaman user
		return redirect('user')->with('success', 'Data Deleted');
	}
}
