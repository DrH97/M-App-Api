<?php

use Faker\Generator as Faker;

$factory->define(App\Activity::class, function (Faker $faker) {
    return [
        //
        'parent_id' => $faker->numberBetween(1, 5),
        'name' => $faker->name,
        'description' => $faker->text(180)
    ];
});
