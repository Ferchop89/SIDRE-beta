<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Alumno;

class AlumnoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('alumnos')->insert([
        //     'name' => str_random(10),
        //     'username' => str_random(5),
        //     'email' => str_random(2).'@gmail.com',
        //     'fecha_nac' => date("Y-m-d", mt_rand(0, 500000000)),
        //     'password' => bcrypt('123456'),
        // ]);
        $table = new Alumno();
        $table->id = 999999;
        $table->num_cta = '305016614';
        $table->password = bcrypt('12345678');
        // $table->foto = '';
        $table->num_reinscripcion = '7356';
        // $table->fecha_reinscripcion = '';
        $table->datos_personales_alumnos_id = 999999;
        $table->domicilio_alumnos_id = 999999;
        $table->tutores_id = 999999;
        $table->datos_medicos_id = 999999;
        $table->datos_emergencias_id = 999999;
        $table->datos_academicos_id = 999999;
        $table->save();
        // $table->grupo_id = ;
        // factory(Alumno::class, 20)->create(
        // [
        //   'password' => bcrypt('12345678'),
        // ]);
    }
}
