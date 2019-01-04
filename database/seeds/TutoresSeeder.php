<?php

use Illuminate\Database\Seeder;
use App\Models\Tutores;
use Illuminate\Support\Facades\DB;

class TutoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $table = new Tutores();

        $table->app = strtoupper('Estrada');
        $table->id = 999999;
        $table->apm = 'Bonilla';
        $table->nombre = 'María Esther';
        $table->curp = 'EBMa890101HDF123KK';
        $table->telefono_fijo = '5556081885';
        $table->telefono_celular = '0445529386948';
        $table->correo = 'tete@test.com';
        $table->lugar_trabajo = 'DGAE Departamento de Proyectos Especiales';
        $table->ocupacion = 'OCUPACIONES DEL HOGAR';

        $table->save();
    }
}
