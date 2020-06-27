<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuratKeputusanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suratkeputusan', function (Blueprint $table) {
            $table->increments('idsk');
            $table->string('nosk', 30);
            $table->date('tglsk');
            $table->string('userstaff');
            $table->string('status')->default('Porposed');
            $table->string('semester', 30);
            $table->string('tahunajar', 30)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('surat_keputusan');
    }
}
