<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKaprodiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kaprodi', function (Blueprint $table) {
            $table->unsignedinteger('idreq')->primary();
            $table->string('noreq', 30)->unique();
            $table->char('nip', 9)->nullable();
            $table->string('statusreq')->nullable();
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
        Schema::dropIfExists('kaprodi');
    }
}
