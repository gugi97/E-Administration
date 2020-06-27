<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SuratKeputusan extends Model
{
    protected $table = "suratkeputusan";
    protected $primaryKey = "idsk";

    public $timestamps = false;
}
