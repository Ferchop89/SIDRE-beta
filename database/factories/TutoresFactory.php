<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Tutores::class, function (Faker $faker) {
    return [
      'app' => $faker->name,
      'apm' => $faker->name,
      'nombre' => $faker->name,
      'curp' => 'PAEF890101HDFCSR07',
      'telefono_fijo' => $faker->unique()->randomNumber(9),
      'telefono_celular' => $faker->unique()->randomNumber(9),
      'correo' => $faker->unique()->safeEmail,
      'lugar_trabajo' => str_random(35),
      'ocupacion' => 'OCUPACIONES DEL HOGAR',
    ];
});
