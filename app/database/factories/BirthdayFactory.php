<?php

use App\Models\Birthday;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

/** @var Factory $factory */
$factory->define(Birthday::class, function (Faker $faker) {
    return [
        'date' => $faker->dateTime,
    ];
});
