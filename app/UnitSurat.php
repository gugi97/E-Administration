<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Validation\Rule;
use Exception;

class UnitSurat extends Model
{
    protected $table = "unit_surat";

    public $timestamps = false;
}
