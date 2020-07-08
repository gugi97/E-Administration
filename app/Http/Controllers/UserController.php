<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

		if (Hash::needsRehash($request)) {
			$hashed = Hash::make('plain-text');
		}

		$user = User::find($id);

		$user->name = $request->input('name');
		$user->email = $request->input('email');
		if($user->password == $request->password)
		{
			$user->password = $request->input('password');
		}
		else{
			$user->password = Hash::make($request->input('password'));
		}
		$user->status = $request->input('status');

		$user->save();
		
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
