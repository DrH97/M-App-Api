<?php

use Faker\Generator as Faker;

$factory->define(App\Location::class, function (Faker $faker) {
    return [
        //
        'country' => $faker->country,
        'area' => $faker->city,
        'latitude' => $faker->latitude,
        'longitude' => $faker->longitude,
    ];
});
