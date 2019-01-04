<?php

use Illuminate\Database\Seeder;
use App\Models\AsignaturaGrupo;
use Illuminate\Support\Facades\DB;

class AsignaturaGrupoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $table = new AsignaturaGrupo();
      $table->asignatura_id = 29;
      $table->grupo_id = 1;
      $table->HR_1 = 'LU1';
      $table->SALON_1 = 'H204';
      $table->HR_2 = 'LU2';
      $table->SALON_2 = 'H204';
      $table->HR_3 = 'MI5';
      $table->SALON_3 = 'H204';
      $table->HR_4 = 'MI6';
      $table->SALON_4 = 'H204';
      $table->HR_5 = 'JU4';
      $table->SALON_5 = 'H111';
      $table->save();

      $table = new AsignaturaGrupo();
      $table->asignatura_id = 30;
      $table->grupo_id = 1;
      $table->HR_1 = 'MA1';
      $table->SALON_1 = 'C404';
      $table->HR_2 = 'MI1';
      $table->SALON_2 = 'C401';
      $table->HR_3 = 'MI2';
      $table->SALON_3 = 'C401';
      $table->HR_4 = 'JU3';
      $table->SALON_4 = 'C402';
      $table->HR_5 = 'VI3';
      $table->SALON_5 = 'C401';
      $table->save();

      $table = new AsignaturaGrupo();
      $table->asignatura_id = 31;
      $table->grupo_id = 1;
      $table->HR_1 = 'LU6';
      $table->SALON_1 = 'H221';
      $table->HR_2 = 'MA4';
      $table->SALON_2 = 'H101';
      $table->HR_3 = 'MI3';
      $table->SALON_3 = 'H215';
      $table->save();

      $table = new AsignaturaGrupo();
      $table->asignatura_id = 32;
      $table->grupo_id = 1;
      $table->HR_1 = 'MA6';
      $table->SALON_1 = 'C201';
      $table->HR_2 = 'VI1';
      $table->SALON_2 = 'C201';
      $table->HR_3 = 'VI2';
      $table->SALON_3 = 'C201';
      $table->save();

      $table = new AsignaturaGrupo();
      $table->asignatura_id = 33;
      $table->grupo_id = 1;
      $table->HR_1 = 'LU4';
      $table->SALON_1 = 'C222';
      $table->HR_2 = 'JU5';
      $table->SALON_2 = 'C321';
      $table->HR_3 = 'JU6';
      $table->SALON_3 = 'C321';
      $table->save();

      $table = new AsignaturaGrupo();
      $table->asignatura_id = 34;
      $table->grupo_id = 1;
      $table->HR_1 = 'MA8';
      $table->SALON_1 = 'D121';
      $table->HR_2 = 'MI8';
      $table->SALON_2 = 'D104';
      $table->HR_3 = 'JU7';
      $table->SALON_3 = 'D113';
      $table->save();

      $table = new AsignaturaGrupo();
      $table->asignatura_id = 35;
      $table->grupo_id = 1;
      $table->HR_1 = 'MA3';
      $table->SALON_1 = 'C101';
      $table->save();

      $table = new AsignaturaGrupo();
      $table->asignatura_id = 36;
      $table->grupo_id = 1;
      $table->HR_1 = 'LU3';
      $table->SALON_1 = 'C213';
      $table->HR_2 = 'JU1';
      $table->SALON_2 = 'C111';
      $table->HR_3 = 'JU2';
      $table->SALON_3 = 'C111';
      $table->save();

      $table = new AsignaturaGrupo();
      $table->asignatura_id = 37;
      $table->grupo_id = 1;
      $table->HR_1 = 'MI7';
      $table->SALON_1 = 'H121';
      $table->HR_2 = 'VI7';
      $table->SALON_2 = 'H127';
      $table->save();

      $table = new AsignaturaGrupo();
      $table->asignatura_id = 38;
      $table->grupo_id = 1;
      $table->HR_1 = 'MA5';
      $table->SALON_1 = '';
      $table->HR_2 = 'VI8';
      $table->SALON_2 = '';
      $table->save();

      $table = new AsignaturaGrupo();
      $table->asignatura_id = 39;
      $table->grupo_id = 1;
      $table->HR_1 = 'MA2';
      $table->SALON_1 = 'C413';
      $table->HR_2 = 'VI5';
      $table->SALON_2 = 'C413';
      $table->save();

      $table = new AsignaturaGrupo();
      $table->asignatura_id = 40;
      $table->grupo_id = 1;
      $table->HR_1 = 'LU9';
      $table->SALON_1 = 'A115';
      $table->HR_2 = 'MI4';
      $table->SALON_2 = 'A222';
      $table->save();

      $table = new AsignaturaGrupo();
      $table->asignatura_id = 41;
      $table->grupo_id = 1;
      $table->HR_1 = 'LU7';
      $table->SALON_1 = 'H221';
      $table->HR_2 = 'MA7';
      $table->SALON_2 = 'D121';
      $table->HR_3 = 'VI6';
      $table->SALON_3 = 'D127';
      $table->save();

      $table = new AsignaturaGrupo();
      $table->asignatura_id = 42;
      $table->grupo_id = 1;
      $table->HR_1 = 'LU8';
      $table->SALON_1 = 'D126';
      $table->HR_2 = 'MI9';
      $table->SALON_2 = 'D127';
      $table->HR_3 = 'JU8';
      $table->SALON_3 = 'D127';
      $table->save();
    }
}
