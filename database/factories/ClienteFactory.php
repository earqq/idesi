<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Cliente;
use Faker\Generator as Faker;

$factory->define(Cliente::class, function (Faker $faker) {
    return [
        'departamentos_id'=> '1',
        'provincias_id'=>'101',
        'distritos_id'=>'10105',
        'documento'=> $faker->randomDigit,
        'nombres' =>  $faker->firstNameMale,
    ];
});
