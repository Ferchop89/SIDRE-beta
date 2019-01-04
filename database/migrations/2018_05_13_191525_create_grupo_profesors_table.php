<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGrupoProfesorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grupo_profesor', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('grupo_id')->unsigned();
            $table->foreign('grupo_id')->references('id')->on('grupos');

            $table->integer('datos_generales_profesores_id')->unsigned();
            $table->foreign('datos_generales_profesores_id')->references('id')->on('datos_generales_profesores');

            $table->integer('datos_generales_profesores_cambio_id')->unsigned()->nullable();


            $table->string('MOV', 1)->default('A');
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
      Schema::table('grupo_profesor', function (Blueprint $table){

        $table->dropForeign(['grupo_id']);
        $table->dropForeign(['datos_generales_profesores_id']);

        $table->dropColumn('grupo_id');
        $table->dropColumn('datos_generales_profesores_id');
      });
      Schema::dropIfExists('grupo_profesor');
    }
}
