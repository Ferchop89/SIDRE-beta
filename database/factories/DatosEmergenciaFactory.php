<?php

use Faker\Generator as Faker;

$factory->define(App\Models\DatosEmergencia::class, function (Faker $faker) {
    return [
         'app' => $faker->name,
         'apm' => $faker->name,
         'nombre' => $faker->name,
         'parentesco' => str_random(18),
         'telefono_fijo' => $faker->unique()->randomNumber(9),
         'telefono_celular' => $faker->unique()->randomNumber(9),
    ];
});
