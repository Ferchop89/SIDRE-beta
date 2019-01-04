<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Alumno::class, function (Faker $faker) {
    static $password;

    return [
        // 'name' => $faker->name,
        'num_cta' => $faker->unique()->randomNumber(9),
        // 'username' => str_random(3),
        'email' => $faker->unique()->safeEmail,
        // 'fecha_nac' => $faker->date('Y-m-d'),
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});
