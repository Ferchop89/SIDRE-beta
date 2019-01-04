<?php

use Illuminate\Database\Seeder;
use App\Models\Grupos;
use Illuminate\Support\Facades\DB;

class GruposSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $table = new Grupos();
      $table->clv_grupo = '0305';
      //$table->profesor_cambio_id =
      // $table->TREG
      // $table->TIRR
      // $table->TREP
      // $table->REG
      // $table->IRR
      // $table->REP
      // $table->MOV = 'A';
      $table->cupo = 50;
      $table->save();
    }
}
