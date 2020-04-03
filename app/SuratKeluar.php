<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SuratKeluar extends Model
{
    protected $table = "suratkeluar";

    protected $fillable = ['no_agenda','kode_klasifikasi','isi','tujuan','no_suratkeluar','tgl_surat','tgl_catat','file','keterangan'];
    
    public $timestamps = false;
}
