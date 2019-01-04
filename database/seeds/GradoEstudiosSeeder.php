<?php

use Illuminate\Database\Seeder;
use App\Models\GradoEstudios;
use Illuminate\Support\Facades\DB;

class GradoEstudiosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $table = new GradoEstudios();
      $table->descripcion = 'POSTDOCTORADO';
      $table->save();

      $table = new GradoEstudios();
      $table->descripcion = 'DOCTORADO';
      $table->save();

      $table = new GradoEstudios();
      $table->descripcion = 'MAESTRIA';
      $table->save();

      $table = new GradoEstudios();
      $table->descripcion = 'DIPLOMADO';
      $table->save();

      $table = new GradoEstudios();
      $table->descripcion = 'LICENCIATURA';
      $table->save();

      $table = new GradoEstudios();
      $table->descripcion = 'TECNICO';
      $table->save();

      $table = new GradoEstudios();
      $table->descripcion = 'BACHILLERATO';
      $table->save();
    }
}
