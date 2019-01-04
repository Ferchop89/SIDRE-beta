<?php

use Illuminate\Database\Seeder;
use App\Models\DatosPersonalesAlumnos;
use Illuminate\Support\Facades\DB;

class DatosPersonalesAlumnosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $table = new DatosPersonalesAlumnos();
        $table->id = 999999;
        $table->nombre = 'Fernando';
        $table->app = 'Pacheco';
        $table->apm = 'Estrada';
        $table->fecha_nac = '1989-01-01';
        $table->curp = 'PAEF890101HDFCSR07';
        $table->sexo = 'M';
        $table->peso = '82.50';
        $table->estatura = '164';
        $table->nacionalidad = 'M';
        $table->lugar_nac = 'DISTRITO FEDERAL';
        $table->save();
    }
}
