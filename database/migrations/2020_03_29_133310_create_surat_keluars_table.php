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
            $table->integer('no_agenda');
            $table->string('tujuan',100);
            $table->string('no_suratkeluar',50);
            $table->longtext('isi');
            $table->string('kode_klasifikasi',30);
            $table->date('tgl_surat');
            $table->date('tgl_catat');
            $table->string('file');
            $table->string('keterangan');
            $table->bigInteger('id')->nullable()->default(null);
            $table->timestamps();
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
