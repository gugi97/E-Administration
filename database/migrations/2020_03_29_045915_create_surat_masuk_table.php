<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuratMasukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suratmasuk', function (Blueprint $table) {
            $table->increments('id_suratmasuk', 10);
            $table->string('no_surat', 30);
            $table->date('tgl_surat');
            $table->date('tgl_terima');
            $table->string('pengirim', 30);
            $table->string('perihal', 30);
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
        Schema::dropIfExists('suratmasuk');
    }
}
