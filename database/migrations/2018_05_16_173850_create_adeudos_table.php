<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdeudosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adeudos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('departamento_id');
            $table->unsignedInteger('alumno_id');
            $table->string('name_user', 60);

            /*Llaves Foraneas*/
            $table->foreign('departamento_id')->references('id')->on('departamentos');
            $table->foreign('alumno_id')->references('id')->on('alumnos');

            $table->string('titulo', 200)->nullable();
            $table->string('autor', 200)->nullable();
            $table->string('material', 120)->nullable();
            $table->boolean('entrego')->default(false);
            $table->date('fecha_incidente')->nullable();
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
      Schema::table('adeudos', function (Blueprint $table){
         $table->dropForeign([
            'departamento_id',
            'alumno_id',
         ]);
         $table->dropColumn([
            'departamento_id',
            'alumno_id',
         ]);
      });
      Schema::dropIfExists('adeudos');
    }
}
