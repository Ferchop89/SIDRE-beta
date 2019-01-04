<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoriasAcademicasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historias_academicas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('num_cta', 9);
            $table->string('plantel', 3);
            $table->string('carrera', 3);
            $table->string('clv_plan', 4);
            $table->string('csa_ingreso', 2);
            $table->string('clv_asignatura', 4);
            $table->string('axo_sem', 5);
            $table->string('calif', 2);
            $table->string('grupo', 4);
            $table->string('folio', 7);
            $table->string('tipo_exa', 1);
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
        Schema::dropIfExists('historias_academicas');
    }
}
