<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Validation\Rule;
use Exception;

class Dosen extends Model
{
    protected $table = "dosen";

    public $timestamps = false;
}
