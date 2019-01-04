<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGruposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grupos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('clv_grupo', 4);
            $table->string('TREG', 100)->default('0');
            $table->string('TIRR', 100)->default('0');
            $table->string('TREP', 100)->default('0');
            $table->string('REG', 100)->default('0');
            $table->string('IRR', 100)->default('0');
            $table->string('REP', 100)->default('0');
            $table->string('turno', 1);
            $table->boolean('activo')->default(true);
            $table->unsignedInteger('cupo')->default('50');
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
        Schema::dropIfExists('grupos');
    }
}
