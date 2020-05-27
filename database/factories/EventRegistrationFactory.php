<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\EventRegistration::class, function (Faker $faker) {
    return [
        'came' => $faker->numberBetween(0,1),
        'user_id' => $faker->numberBetween(1,25)
    ];
});
