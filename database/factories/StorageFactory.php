<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Storage;
use Faker\Generator as Faker;

$factory->define(Storage::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween(5, 10),
        'name' => $faker->name . " Storage",
        'address' => 'Jl. Aiueo',
        'city' => 'Jakarta' | 'Depok' | 'Bogor' | 'Tangerang' | '',
        'description' => 'Lorem ipsum de amot',
        'cctv' => $faker->numberBetween(0, 1),
        'ac' => $faker->numberBetween(0, 1),
        'fullday' => $faker->numberBetween(0, 1),
        'start_contract' => '2021-04-07',
        'end_contract' => '2022-04-07'
    ];
});
