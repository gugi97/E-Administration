<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $sm_count = DB::table('suratmasuk')->count();
        $sk_count = DB::table('suratkeluar')->count();
        return view('home',['sm_count' => $sm_count], ['sk_count' => $sk_count]);
    }
}
