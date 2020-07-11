<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Kaprodi extends Model
{
    protected $table = "kaprodi";

    protected $primaryKey = "idreq";

    protected $fillable = ['nip', 'stattusreq', 'noreq'];

    public $timestamps = false;

    public function scopegetalluser(){
        $result = DB::table('users')->where('status', 'Dekan')->get();
        return $result;
    }
}
