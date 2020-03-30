<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SuratMasuk extends Model
{
    protected $table = "suratmasuk";

    // protected $guarded = [];
    protected $fillable = ['no_surat', 'tgl_surat', 'tgl_terima', 'pengirim', 'perihal', 'keterangan', 'kode_jenissurat', 'kode_jenjang', 'nip'];
    public $timestamps = false;
}
