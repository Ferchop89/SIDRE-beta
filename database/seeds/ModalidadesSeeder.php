<?php

use Illuminate\Database\Seeder;
use App\Models\Modalidades;
use Illuminate\Support\Facades\DB;

class ModalidadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $table = new Modalidades();
      $table->id = 'ESC';
      $table->descripcion = 'Escolarizado';
      $table->save();

      $table = new Modalidades();
      $table->id = 'SUA';
      $table->descripcion = 'Abierto';
      $table->save();

      $table = new Modalidades();
      $table->id = 'SED';
      $table->descripcion = 'A distancia';
      $table->save();
    }
}
