<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Exception;

class Jenis extends Model
{
    protected $table = "jenis_surat";

		public $timestamps = false;

    public function scopegetalluser(){
        $result = DB::table('jenis_surat')->get();
        return $result;
    }

    public function getalluser2(){
        $result = Jenis::all()->groupBy('status');
        return $result;
    }

    public function InsertData($data){
		$checkinsert = false;
		try{
            DB::insert('jenis_surat', $data);
			$checkinsert = true;
		}catch (Exception $e) {
			$checkinsert = false;
		}
		return $checkinsert;
    }
    
    public function DeleteUser($id){
		$checkupdate = false;
		try{
			DB::table('jenis_surat')->where('kode_jenissurat',$id)->delete('jenis_surat');
			$checkupdate = true;
		}catch (Exception $e) {
			$checkupdate = false;
		}
		return $checkupdate;
	}
}
