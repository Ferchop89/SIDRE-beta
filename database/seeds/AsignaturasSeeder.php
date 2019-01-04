<?php

use Illuminate\Database\Seeder;
use App\Models\Asignaturas;
use Illuminate\Support\Facades\DB;

class AsignaturasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $table = new Asignaturas();
      $table->clv_asignatura = '1108';
      $table->nombre = 'LENGUA EXTRANJERA (INGLESI)';
      // $table->clv_plantel =
      $table->no_creditos = '12';
      $table->AXO = '01';
      $table->nivel = 'S';
      $table->plan = '0470';
      // $table->area = ''
      $table->tipo = 'OBL';
      $table->vigente = 'S';
      // $table->seriada =
      // $table->num_seriad =
      // $table->seriada_1 =
      // $table->seriada_2 =
      $table->hrs_teori = '03';
      $table->hrs_pract = '00';
      $table->total_hrs = '03';
      $table->colegio = 'LENGUAS VIVAS';
      $table->save();
    }
}
