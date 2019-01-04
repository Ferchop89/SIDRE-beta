<?php

use Faker\Generator as Faker;

$factory->define(App\Models\DomicilioAlumnos::class, function (Faker $faker) {
    return [
      'cp' => $faker->postcode,
      'calle_cnum' => $faker->streetAddress,
      'colonia' => $faker->streetName,
      'del_mun' => $faker->city,
      'estado' => $faker->state,
      'telefono_fijo' => $faker->unique()->randomNumber(9),
      'telefono_celular' => $faker->unique()->randomNumber(9),
      'correo' => $faker->unique()->safeEmail,
    ];
});
