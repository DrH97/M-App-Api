<?php

use Faker\Generator as Faker;

$factory->define(App\PlaceActivity::class, function (Faker $faker) {
    return [
        //
        'place_id' => $faker->randomElement($array = array ('2','12','22','32','42')),
        'price' => $faker->numberBetween(200, 6000)
    ];
});
