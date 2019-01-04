<?php

use Faker\Generator as Faker;

$factory->define(App\Models\DatosAcademicos::class, function (Faker $faker) {

   $clv_plan = ['1091', '0471', '0472', '0473', '0474', '0475'];
   $ap_ingreso = ['2012', '2013', '2014', '2015', '2016', '2017'];
   $csa_ingreso = ['50', '51', '52', '60', '69'];
   $modalidades = ['ESC', 'SED', 'SUA'];

    return [
       'esc_procedencia' => str_random(25),
       'promedio' => rand(0, 100)/10,
       'clv_carrera' => '111',
       'clv_plan_estudio' => $clv_plan[rand(0,5)],
       'ap_ingreso' => $ap_ingreso[rand(0,5)],
       'csa_ingreso' => $csa_ingreso[rand(0,4)],
       'csa_egreso' => '12',
       'UPHA' => '12345',
       'PAart22' => $axo+1,
       'modalidades_id' => $modalidades[rand(0, 2)],
    ];
});
