<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDekanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dekan', function (Blueprint $table) {
            $table->unsignedinteger('id_dekan')->primary();
            $table->string('noreq_dekan', 30)->unique();
            $table->char('nip_dekan', 9)->nullable();
            $table->text('ttd_dekan')->nullable();
            $table->string('statusreq_dekan')->nullable();
            $table->longText('template');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dekan');
    }
}
