<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDatosGeneralesProfesoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datos_generales_profesores', function (Blueprint $table) {
            $table->increments('id');
            $table->string('num_trabajador', 7)->nullable();
            $table->string('nombre', 25);
            $table->string('app', 25);
            $table->string('apm', 25)->nullable();
            $table->string('sexo', 1);
            $table->string('nacionalidad', 1)->nullable();
            $table->date('fecha_nac')->nullable();
            $table->string('clv_plantel', 3)->default('022');
            $table->string('telefono', 10)->nullable();
            $table->string('RFC', 13)->nullable();

            $table->string('movimiento', 1);
            $table->string('CURP', 18)->nullable();

            /*Columnas para Llaves Foraneas*/
            $table->tinyInteger('nombramientos_id')->nullable();
            $table->unsignedInteger('grado_estudios_id')->nullable();
            /*Llaves Foraneas*/
            $table->foreign('nombramientos_id')->references('id')->on('nombramientos');
            $table->foreign('grado_estudios_id')->references('id')->on('grado_estudios');
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
      Schema::table('datos_generales_profesores', function (Blueprint $table){
        $table->dropForeign(['nombramientos_id']);
        $table->dropForeign(['grado_estudios']);
        $table->dropColumn('nombramientos_id');
        $table->dropColumn('grado_estudios');
      });
        Schema::dropIfExists('datos_generales_profesores');
    }
}
