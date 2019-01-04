<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAsignaturaGruposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asignatura_grupo', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('asignatura_id')->unsigned();
            $table->foreign('asignatura_id')->references('id')->on('asignaturas');
            $table->integer('grupo_id')->unsigned();
            $table->foreign('grupo_id')->references('id')->on('grupos');
            $table->string('HR_1', 4)->nullable();
            $table->string('SALON_1', 4)->nullable();
            $table->string('HR_2', 4)->nullable();
            $table->string('SALON_2', 4)->nullable();
            $table->string('HR_3', 4)->nullable();
            $table->string('SALON_3', 4)->nullable();
            $table->string('HR_4', 4)->nullable();
            $table->string('SALON_4', 4)->nullable();
            $table->string('HR_5', 4)->nullable();
            $table->string('SALON_5', 4)->nullable();
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
      Schema::table('asignatura_grupo', function (Blueprint $table){

          $table->dropForeign(['asignatura_id']);
          $table->dropForeign(['grupo_id']);

          $table->dropColumn('asignatura_id');
          $table->dropColumn('grupo_id');
      });
      Schema::dropIfExists('asignatura_grupo');
    }
}
