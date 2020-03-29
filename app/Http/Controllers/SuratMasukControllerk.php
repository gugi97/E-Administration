<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SuratMasuk;

class SuratMasukControllerk extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('suratmasuk');
    }
}
