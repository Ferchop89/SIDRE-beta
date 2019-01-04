<?php

use Faker\Generator as Faker;

$factory->define(App\Models\DatosMedicos::class, function (Faker $faker) {
   $tipo_sangre=['O+','O-','A+','A-','B+','B-','AB+','AB-'];
    return [
        //
         'tipo_sangre' => $tipo_sangre[rand(0,7)],
         'seguro_medico' => 'ISSSTE',
    ];
});
