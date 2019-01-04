<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlumnosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumnos', function (Blueprint $table) {
            $table->increments('id');
            $table->Integer('num_cta')->unique();
            $table->string('password');
            $table->string('foto')->nullable();
            $table->string('comentarios')->nullable();
            $table->boolean('activo')->default(true);
            $table->integer('num_reinscripcion')->unnique()->nullable();
            $table->dateTimeTz('fecha_reinscripcion')->nullable();

            /*Columnas para Llaves Foraneas*/
            $table->unsignedInteger('datos_personales_alumnos_id');
            $table->unsignedInteger('domicilio_alumnos_id')->nullable();
            $table->unsignedInteger('tutores_id')->nullable();
            $table->unsignedInteger('datos_medicos_id')->nullable();
            $table->unsignedInteger('datos_emergencias_id')->nullable();
            $table->unsignedInteger('datos_academicos_id');
            $table->unsignedInteger('grupo_id')->nullable();
            $table->string('clv_seccion', 4)->nullable();
            $table->string('clv_grupo_cambio', 4)->nullable();
            $table->string('clv_seccion_cambio', 4)->nullable();
            $table->string('clv_idioma', 4)->nullable();
            $table->string('optativa1', 4)->nullable();
            $table->string('optativa2', 4)->nullable();
            $table->string('ultimo_grado', 4)->nullable();


            /*Llaves Foraneas*/
            $table->foreign('datos_personales_alumnos_id')->references('id')->on('datos_personales_alumnos');
            $table->foreign('domicilio_alumnos_id')->references('id')->on('domicilio_alumnos');
            $table->foreign('tutores_id')->references('id')->on('tutores');
            $table->foreign('datos_medicos_id')->references('id')->on('datos_medicos');
            $table->foreign('datos_emergencias_id')->references('id')->on('datos_emergencias');
            $table->foreign('datos_academicos_id')->references('id')->on('datos_academicos');
            $table->foreign('grupo_id')->references('id')->on('grupos');

            $table->rememberToken();
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
        Schema::table('alumnos', function (Blueprint $table){

          // $table->dropForeign(['grupo_id']);
          // $table->dropForeign(['datos_medicos_id']);
          // $table->dropForeign(['datos_emergencias_id']);
          // $table->dropForeign(['domicilio_alumnos_id']);
          // $table->dropForeign(['tutores_id']);
          $table->dropForeign([
            'datos_personales_alumnos_id',
            'domicilio_alumnos_id',
            'tutores_id',
            'datos_medicos_id',
            'datos_emergencias_id',
            'datos_academicos_id',
            'grupo_id',
          ]);

          $table->dropColumn([
            'datos_personales_alumnos_id',
            'domicilio_alumnos_id',
            'tutores_id',
            'datos_medicos_id',
            'datos_emergencias_id',
            'datos_academicos_id',
            'grupo_id',
          ]);
          // $table->dropColumn('grupo_id');
          // $table->dropColumn('datos_academicos_id');
          // $table->dropColumn('datos_medicos_id');
          // $table->dropColumn('datos_emergencias_id');
          // $table->dropColumn('domicilio_alumnos_id');
          // $table->dropColumn('tutores_id');
        });
        Schema::dropIfExists('alumnos');
    }
}
