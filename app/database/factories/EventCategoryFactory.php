<?php

use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

/** @var Factory $factory */
$factory->define(\App\Models\EventCategory::class, function (Faker $faker) {
    return [
        'name'=>$faker->userName,
        'color'=>$faker->safeHexColor,
        'textColor'=>$faker->safeHexColor,
    ];
});
