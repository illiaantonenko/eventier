<?php

use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

/** @var Factory $factory */
$factory->define(\App\Models\Group::class, function (Faker $faker) {
    return [
        'title' => $faker->realText(50),
        'description' => $faker->realText(),
    ];
});
