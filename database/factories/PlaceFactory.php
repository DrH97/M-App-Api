<?php

use Faker\Generator as Faker;

$factory->define(App\Place::class, function (Faker $faker) {
    return [
        //
        'title' => $faker->name,
        'image' => $faker->url,
        'description' => $faker->sentence
    ];
});
