<?php

use Illuminate\Database\Seeder;
use App\Models\Nombramientos;
use Illuminate\Support\Facades\DB;

class NombramientosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $table = new Nombramientos();
        $table->id = 0;
        $table->descripcion = 'SIN NOMBRAMIENTO';
        $table->save();

        $table = new Nombramientos();
        $table->id = 1;
        $table->descripcion = 'PROFESOR DE ASIGNATURA';
        $table->save();

        $table = new Nombramientos();
        $table->id = 2;
        $table->descripcion = 'PROFESOR DE CARRERA';
        $table->save();

        $table = new Nombramientos();
        $table->id = 3;
        $table->descripcion = 'TECNICO ACADEMICO';
        $table->save();

        $table = new Nombramientos();
        $table->id = 4;
        $table->descripcion = 'AYUDANTE DE PROFESOR';
        $table->save();

        $table = new Nombramientos();
        $table->id = 5;
        $table->descripcion = 'AYUDANTE DE INVESTIGADOR';
        $table->save();

        $table = new Nombramientos();
        $table->id = 6;
        $table->descripcion = 'INVESTIGADOR';
        $table->save();
    }
}
