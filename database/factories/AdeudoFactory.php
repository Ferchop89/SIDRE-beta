<?php

use Faker\Generator as Faker;
use App\Models\Alumno;

$factory->define(App\Models\Adeudo::class, function (Faker $faker) {
   $departamento = rand(1,3);
   if($departamento == 1)
   {
      $titulo = str_random(20);
      $autor = str_random(20);
      $material = null;
      $entrego = 0;
   }
   else {
      $titulo = null;
      $autor = null;
      $material = str_random(20);
      $entrego = 0;
   }
    return [
      'departamento_id' => $departamento,
      'alumno_id' => rand(1, Alumno::count()),
      'titulo' => $titulo,
      'autor' => $autor,
      'material' => $material,
      'entrego' => $entrego,
    ];
});
