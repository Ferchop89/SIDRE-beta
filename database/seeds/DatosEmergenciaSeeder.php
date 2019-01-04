<?php

use Illuminate\Database\Seeder;
use App\Models\DatosEmergencia;
use Illuminate\Support\Facades\DB;
class DatosEmergenciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $table = new DatosEmergencia();
        $table->id = 999999;
        $table->app = 'Contacto_1';
        $table->apm = 'Pérez';
        $table->nombre = 'Test_1';
        $table->telefono_fijo = '5556081885';
        $table->telefono_celular = '0445529386948';
        $table->save();
    }
}
