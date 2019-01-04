<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Adeudo;

class AdeudosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $table = new Adeudo();
      $table->departamento_id = 1;
      $table->alumno_id = 999999;
      $table->titulo = 'ORGULLO Y PREJUICIO';
      $table->autor = 'JAME';
      $table->name_user = 'prueba';
      $table->save();

      $table = new Adeudo();
      $table->departamento_id = 2;
      $table->alumno_id = 999999;
      $table->material = 'VIDRIO DE RELOJ';
      $table->name_user = 'prueba';
      $table->save();

      $table = new Adeudo();
      $table->departamento_id = 3;
      $table->alumno_id = 999999;
      $table->material = 'BALON';
      $table->name_user = 'prueba';
      $table->save();
    }
}
