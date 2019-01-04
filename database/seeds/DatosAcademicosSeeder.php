<?php

use Illuminate\Database\Seeder;
use App\Models\DatosAcademicos;
use Illuminate\Support\Facades\DB;

class DatosAcademicosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $table = new DatosAcademicos();
      $table->id = 999999;
      $table->esc_procedencia = 'alguna';
      $table->materias_aprobadas = '24';
      $table->materias_no_aprobadas = '2';
      $table->promedio = '8.19';
      $table->clv_plantel = '111';
      $table->clv_carrera = '111';
      $table->clv_plan_estudio = '1234';
      $table->csa_ingreso = '12';
      $table->csa_egreso = '12';
      $table->UPHA = '12345';
      $table->PAart22 = '12345';
      $table->modalidades_id = 'ESC';
      $table->save();
    }
}
