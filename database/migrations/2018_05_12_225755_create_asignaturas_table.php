<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAsignaturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asignaturas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('clv_asignatura', 4);
            $table->string('nombre', 45);
            $table->string('clv_plantel', 3)->default('020');
            $table->string('no_creditos', 2);
            $table->string('AXO', 2);
            $table->string('nivel', 1);
            $table->string('plan', 4);
            $table->smallInteger('area')->nullable();
            $table->string('tipo', 3);
            $table->string('vigente', 1);
            $table->string('seriada', 1)->nullable();
            $table->string('num_seriad', 1)->nullable();
            $table->string('seriada_1', 4)->nullable();
            $table->string('seriada_2', 4)->nullable();
            $table->string('hrs_teori', 2);
            $table->string('hrs_pract', 2);
            $table->string('total_hrs', 2);
            $table->string('colegio', 45);
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
        Schema::dropIfExists('asignaturas');
    }
}
