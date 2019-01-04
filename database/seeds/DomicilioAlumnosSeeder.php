<?php

use Illuminate\Database\Seeder;
use App\Models\DomicilioAlumnos;
use Illuminate\Support\Facades\DB;

class DomicilioAlumnosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $table = new DomicilioAlumnos();
        $table->id = 999999;
        $table->cp = '04480';
        $table->calle_cnum = 'Elvira Vargas, edif. 41, depto. 303';
        $table->colonia = 'CTM Culhuacan';
        $table->del_mun = 'Coyoacán';
        $table->estado = 'CIUDAD DE MEXICO';
        $table->telefono_fijo = '5556081885';
        $table->telefono_celular = '5529386948';
        $table->correo = 'ferchop89@msn.com';
        $table->save();
    }
}
