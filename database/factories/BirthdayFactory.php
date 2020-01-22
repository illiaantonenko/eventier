<?php

use App\Models\Birthday;
use Faker\Generator as Faker;

$factory->define(Birthday::class, function (Faker $faker) {
    return [
        'date' => $faker->unixTime,
        'published' => $faker->numberBetween(0, 1),
    ];
});
