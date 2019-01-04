<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDatosEmergenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datos_emergencias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('app', 40)->nullable();
            $table->string('apm', 40)->nullable();
            $table->string('nombre', 60)->nullable();
            $table->string('parentesco', 60)->nullable();
            $table->string('telefono_fijo', 10)->nullable();
            $table->string('telefono_celular', 13)->nullable();
            $table->string('info_adicional', 255)->nullable();
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
        Schema::dropIfExists('datos_emergencias');
    }
}
