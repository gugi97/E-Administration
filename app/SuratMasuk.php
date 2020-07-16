<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SuratMasuk extends Model
{
    protected $table = "suratmasuk";

    // protected $guarded = [];
    protected $fillable = ['no_surat', 'tgl_surat', 'tgl_terima', 'pengirim', 'perihal', 'keterangan', 'kode_jenissurat', 'kode_jenjang', 'gambar', 'file', 'nip', 'lokasi', 'lokasifile'];
    
    protected $primaryKey = 'id_suratmasuk';

    public $timestamps = false;

    public function scopegetallsuratmasuk(){
        $result = DB::table('suratmasuk')->get();
        return $result;
    }
}
