<?php

use Illuminate\Database\Seeder;
use App\Models\GrupoProfesor;
use Illuminate\Support\Facades\DB;

class GrupoProfesorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $table = new GrupoProfesor();
        $table->grupo_id = 1;
        $table->datos_generales_profesores_id = 1;
        // $table->datos_generales_profesores_cambio_id =
        $table->MOV = 'A';
        $table->save();
    }
}
