<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $this->truncateTables([
         // 'asignaturas',
         // 'grupos',
         // 'asignatura_grupo',
         'users',
         'nombramientos',
         'grado_estudios',
         // 'datos_generales_profesores',

         // 'grupo_profesor',

        'modalidades',
        'datos_academicos',
        'datos_emergencias',
        'datos_medicos',
        'tutores',
        'domicilio_alumnos',
        'datos_personales_alumnos',
        'alumnos',

        'departamentos',
        'adeudos',

          ]);

        // $this->call(AsignaturasSeeder::class);
        // $this->call(GruposSeeder::class);
        // $this->call(AsignaturaGrupoSeeder::class);
        $this->call(NombramientosSeeder::class);
        $this->call(GradoEstudiosSeeder::class);
        // $this->call(DatosGeneralesProfesoresSeeder::class);
        // $this->call(GrupoProfesorSeeder::class);
        $this->call(ModalidadesSeeder::class);
        $this->call(DatosAcademicosSeeder::class);
        $this->call(DatosEmergenciaSeeder::class);
        $this->call(DatosMedicosSeeder::class);
        $this->call(TutoresSeeder::class);
        $this->call(DomicilioAlumnosSeeder::class);
        $this->call(DatosPersonalesAlumnosSeeder::class);
        $this->call(AlumnoSeeder::class);
        $this->call(AdminSeeder::class);

        $this->call(DepartamentosSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(AdeudosSeeder::class);
    }

    protected function truncateTables(array $tables){
      DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
      foreach ($tables as $table) {
        DB::table($table)->truncate();
      }
      DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
