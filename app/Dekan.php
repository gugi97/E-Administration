<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dekan extends Model
{
    protected $table = "dekan";

    protected $primaryKey = "noreq_dekan";

    protected $fillable = ['noreq_dekan', 'nip_dekan', 'ttd_dekan', 'statusreq_dekan'];

    public $timestamps = false;
}
