<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDomicilioAlumnosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('domicilio_alumnos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cp', 5)->nullable();
            $table->string('calle_cnum', 100)->nullable();
            $table->string('colonia', 60)->nullable();
            $table->string('del_mun', 50)->nullable();
            $table->string('estado', 45)->nullable();
            $table->string('telefono_fijo', 10)->nullable();
            $table->string('telefono_celular', 13)->nullable();
            $table->string('correo', 100)->nullable();
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
        Schema::dropIfExists('domicilio_alumnos');
    }
}
