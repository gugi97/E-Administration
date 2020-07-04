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

    public $timestamps = false;
}
