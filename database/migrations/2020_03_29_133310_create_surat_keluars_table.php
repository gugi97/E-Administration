<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuratKeluarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suratkeluar', function (Blueprint $table) {
            $table->increments('id_suratkeluar',10);
            $table->string('no_suratkeluar',30);
            $table->date('tgl_suratkeluar');
            $table->string('perihal', 30);
            $table->string('lampiran', 10);
            $table->string('tujuan_surat',100);
            $table->text('keterangan');
            $table->text('gambar')->nullable();
            $table->char('nip', 9);
            $table->string('kode_jenissurat', 30);
            $table->string('kode_jenjang', 30);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('suratkeluar');
    }
}
