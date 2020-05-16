<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Exception;

class JenjangJabatan extends Model
{
    protected $table = "jenjang_jabatan";

    public $timestamps = false;

    // public function InsertData($data){
	// 	$checkinsert = false;
	// 	try{
	// 		DB::insert('jenjang_jabatan', $data);
	// 		$checkinsert = true;
	// 	}catch (Exception $e) {
	// 		$checkinsert = false;
	// 	}
	// 	return $checkinsert;
    // }

    public function scopegetalluser(){
        $result = DB::table('jenjang_jabatan')->get();
        return $result;
    }

    public function getjabat($id){
		$result = DB::table('jenjang_jabatan')->where('id', $id)->get('jenjang_jabatan');
		return $result->row();
    }

    // public function UpdateUser($id,$data){
	// 	$checkupdate = false;
	// 	try{
    //         DB::table('jenjang_jabatan')
    //         ->where('id', $id)
    //         ->update(array('jenjang_jabatan' => $data));
	// 		// $this->db->where('kode_jabatan',$id);
	// 		// $this->db->update('jenjang_jabatan',$data);
	// 		$checkupdate = true;
	// 	}catch (Exception $e) {
	// 		$checkupdate = false;
	// 	}
	// 	return $checkupdate;
    // }

    // public function DeleteUser($id){
	// 	$checkupdate = false;
	// 	try{
    //         DB::table('jenjang_jabatan')->where('id', $id)->delete();
	// 		// $this->db->where('kode_jabatan',$id);
	// 		// $this->db->delete('jenjang_jabatan');
	// 		$checkupdate = true;
	// 	}catch (Exception $ex) {
	// 		$checkupdate = false;
	// 	}
	// 	return $checkupdate;
	// }
}
