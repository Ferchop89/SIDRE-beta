<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDatosPersonalesAlumnosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datos_personales_alumnos', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('nombre', 60);
            $table->string('app', 40);
            $table->string('apm', 40);
            $table->date('fecha_nac');
            $table->string('curp', 18)->nullable();
            $table->string('sexo', 1)->nullable();
            $table->float('peso', 6, 2)->nullable();
            $table->float('estatura', 6, 2)->nullable();
            $table->string('nacionalidad', 1)->nullable();
            $table->string('lugar_nac', 40)->nullable();
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
        Schema::dropIfExists('datos_personales_alumnos');
    }
}
