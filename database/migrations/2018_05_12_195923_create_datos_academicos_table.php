<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDatosAcademicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datos_academicos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('esc_procedencia', 45)->nullable();
            $table->tinyInteger('materias_aprobadas')->nullable();
            $table->tinyInteger('materias_no_aprobadas')->nullable();
            $table->text('clvs_asignaturas_NA')->nullable();
            // $table->string('MNA2clv_asignatura', 4)->nullable();
            // $table->string('MNA3clv_asignatura', 4)->nullable();
            $table->float('promedio')->nullable();
            $table->string('REG', 1)->default('0');
            $table->string('IRR', 1)->default('0');
            $table->string('REP', 1)->default('0');
            $table->string('axo_inicial', 5)->nullable();
            $table->string('axo_actual', 5)->nullable();
            $table->tinyInteger('grado_a_cursar')->nullable();
            $table->string('clv_plantel', 3)->default('022');
            $table->string('clv_carrera', 3)->nullable();
            $table->string('clv_plan_estudio', 4)->nullable();
            $table->string('csa_ingreso', 2)->nullable();
            $table->string('csa_egreso', 2)->nullable();
            $table->string('UPHA', 5)->nullable();
            $table->string('PAart22', 5)->nullable();
            $table->string('modalidades_id', 3)->default('ESC');
            $table->foreign('modalidades_id')->references('id')->on('modalidades');
            $table->string('turno', 3)->default('002');
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
      Schema::table('datos_academicos', function (Blueprint $table){
         $table->dropForeign('modalidades_id');
         $table->dropColumn('modalidades_id');
      });
      Schema::dropIfExists('datos_academicos');
    }
}
