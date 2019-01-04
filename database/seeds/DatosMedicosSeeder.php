<?php

use Illuminate\Database\Seeder;
use App\Models\DatosMedicos;
use Illuminate\Support\Facades\DB;

class DatosMedicosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $table = new DatosMedicos();
      $table->id = 999999;
      $table->tipo_sangre = 'O+';
      $table->seguro_medico = 'IMSS';
      $table->alergias = 'NINGUNA';
      $table->save();
    }
}
