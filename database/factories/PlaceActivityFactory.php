<?php

use Faker\Generator as Faker;

$factory->define(App\PlaceActivity::class, function (Faker $faker) {
    return [
        //
        'place_id' => $faker->numberBetween(1, 5),
        'price' => $faker->numberBetween(200, 6000)
    ];
});
