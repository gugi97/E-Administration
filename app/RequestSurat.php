<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestSurat extends Model
{
    protected $table = "request_surat";

    protected $primaryKey = "no_req";

    protected $attributes = [
        'statusreq' => 'Porposed',
    ];

    public function updateterima($id){
		$result = $this->db->set('statusreq','Diterima')->where('no_req',$id)->update('request_surat');
		return $result;
	}

    public $timestamps = false;
}
