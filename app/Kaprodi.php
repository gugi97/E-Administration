<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kaprodi extends Model
{
    protected $table = "kaprodi";

    protected $primaryKey = "noreq";

    protected $fillable = ['nip', 'stattusreq', 'noreq'];

    public $timestamps = false;
}
