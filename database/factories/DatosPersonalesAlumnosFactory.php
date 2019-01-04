<?php

use Faker\Generator as Faker;
use App\Models\DatosPersonalesAlumnos;
// 'app' => $faker->name,
//
$factory->define(DatosPersonalesAlumnos::class, function (Faker $faker) {
   $sexo = ['M', 'F'];
   $nacionalidad = ['M', 'E'];
    return [
      'nombre' => $faker->name,
      'app' => $faker->name,
      'apm' => $faker->name,
      'fecha_nac' => $faker->date('Y-m-d'),
      // 'num_cta' => $faker->unique()->randomNumber(9),
      'curp' => 'PAEF890101HDFCSR07',
      'sexo' => $sexo[rand(0,1)],
      'peso' => '82.50',
      'estatura' => random_int(150, 250),
      'nacionalidad' => $nacionalidad[rand(0,1)],
      'lugar_nac' => 'CIUDAD DE MEXICO',
    ];
});
