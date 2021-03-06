<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SuratKeluar extends Model
{
    protected $table = "suratkeluar";

    protected $fillable = ['no_suratkeluar','tgl_suratkeluar','perihal','lampiran','tujuan_surat','keterangan','gambar','file','nip','kode_jenissurat','kode_jenjang','lokasi','lokasifile'];
    
    protected $primaryKey = 'id_suratkeluar';

    public $timestamps = false;

    public function scopegetallsuratkeluar(){
        $result = DB::table('suratkeluar')->get();
        return $result;
    }
}
