<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SuratKeputusan extends Model
{
    protected $table = "suratkeputusan";
    protected $primaryKey = "idsk";

    public $timestamps = false;

    protected $attributes = [
        'status' => "Proposed",
     ];
     
    public function scopegetalltemplate(){
        $result = DB::table('jenis_sk')->get();
        return $result;
    }

    public function scopegetallsuratkeputusan(){
        $result = DB::table('suratkeputusan')->get();
        return $result;
    }

    public function scopegetalluser(){
        $result = DB::table('users')->where('status', 'Ketua Program Studi')->get();
        return $result;
    }
}
