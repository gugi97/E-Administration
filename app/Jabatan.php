<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Exception;

class Jabatan extends Model
{
    protected $table = "jabatan";

    public function InsertData($data){
		$checkinsert = false;
		try{
			DB::insert('jabatan', $data);
			$checkinsert = true;
		}catch (Exception $e) {
			$checkinsert = false;
		}
		return $checkinsert;
    }

    public function scopegetalluser(){
        $result = DB::table('jabatan')->get();
        return $result;
    }

    public function getjabat($id){
		$result = DB::table('jabatan')->where('kode_jabatan', $id)->get('jabatan');
		return $result->row();
    }

    public function UpdateUser($id,$data){
		$checkupdate = false;
		try{
            DB::table('jabatan')
            ->where('kode_jabatan', $id)
            ->update(array('jabatan' => $data));
			// $this->db->where('kode_jabatan',$id);
			// $this->db->update('jabatan',$data);
			$checkupdate = true;
		}catch (Exception $e) {
			$checkupdate = false;
		}
		return $checkupdate;
    }

    public function DeleteUser($id){
		$checkupdate = false;
		try{
            DB::table('jabatan')->where('kode_jabatan', $id)->delete();
			// $this->db->where('kode_jabatan',$id);
			// $this->db->delete('jabatan');
			$checkupdate = true;
		}catch (Exception $ex) {
			$checkupdate = false;
		}
		return $checkupdate;
	}

}
