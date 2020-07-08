<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJenjangJabatanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jenjang_jabatan', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode_jenjang', 5);
            $table->string('nama_jabatan', 50);
            $table->string('kode_unitsurat', 3);
            $table->string('kode_unitinduk', 3);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jenjang_jabatan');
    }
}
