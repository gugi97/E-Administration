<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SuratKeputusan extends Model
{
    protected $table = "suratkeputusan";
    protected $primaryKey = "idsk";

    protected $fillable = ['nosk', 'tglsk', 'userstaff', 'semester', 'tahunajar'];

    public $timestamps = false;
}
