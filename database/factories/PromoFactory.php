<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Promo;
use Faker\Generator as Faker;

$factory->define(Promo::class, function (Faker $faker) {
    return [
        //
        'name' => $faker->name,
        'description' => 'lorem ipsum promo',
        'start_date' => '2021-04-02',
        'end_date' => '2021-05-02',
        'discount' => '2000',
        'code' => Str::random(4) . $faker->numberBetween(0, 9) . $faker->numberBetween(0, 9),
        'image' => 'NULL'
    ];
});
