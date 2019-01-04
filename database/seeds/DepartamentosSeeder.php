<?php

use Illuminate\Database\Seeder;
use App\Models\Departamentos;
use Illuminate\Support\Facades\DB;

class DepartamentosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $table = new Departamentos();
      $table->nombre = 'BIBLIOTECA';
      $table->save();

      $table = new Departamentos();
      $table->nombre = 'CIENCIAS EXPERIMENTALES';
      $table->save();

      $table = new Departamentos();
      $table->nombre = 'EDUCACION FISICA';
      $table->save();

    }
}
