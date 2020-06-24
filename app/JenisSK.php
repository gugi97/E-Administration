<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JenisSK extends Model
{
    protected $table = "jenis_sk";
    protected $primaryKey = "idjenis_sk";

    public $timestamps = false;
}
