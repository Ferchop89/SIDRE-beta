<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDatosMedicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datos_medicos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tipo_sangre', 3)->nullable();
            $table->string('seguro_medico', 10)->nullable();
            $table->string('alergias')->nullable();
            $table->string('tratamiento_especial')->nullable();
            $table->string('padecimientos')->nullable();
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
        Schema::dropIfExists('datos_medicos');
    }
}
