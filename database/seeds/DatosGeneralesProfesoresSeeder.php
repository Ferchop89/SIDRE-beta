<?php

use Illuminate\Database\Seeder;
use App\Models\DatosGeneralesProfesores;
use Illuminate\Support\Facades\DB;

class DatosGeneralesProfesoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $table = new DatosGeneralesProfesores();
      $table->num_trabajador = '149897';
      $table->nombre = 'HECTOR ALEJANDRO';
      $table->app = 'CHAVEZ';
      $table->apm = 'ESCAMILLA';
      //$table->dateTime('fecha_nac');
      //curp', 18);
      $table->sexo = 'M'; //M ó F
      $table->nacionalidad = 'M'; //M ó E
      // $table->telefono = '1234567890';
      $table->RFC = 'EACH590210PV0';
      // $table->clv_plantel = '022';
      $table->movimiento = 'A';
      $table->CURP = 'EACH590210HDFSHC06';
      $table->nombramientos_id = 1;
      $table->grado_estudios_id = 5;
      $table->save();
    }
}
