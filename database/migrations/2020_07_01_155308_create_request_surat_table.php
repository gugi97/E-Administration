<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestSuratTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_surat', function (Blueprint $table) {
            $table->increments('no_req');
            $table->char('nip', 9);
            $table->string('nama', 50);
            $table->string('kebutuhan', 50);
            $table->text('detail_surat');
            $table->date('tgl_maxsurat');
            $table->string('statusreq', 20);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('request_surat');
    }
}
