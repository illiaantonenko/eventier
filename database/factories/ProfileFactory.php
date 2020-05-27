<?php

use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

/** @var Factory $factory */
$factory->define(\App\Models\Profile::class, function (Faker $faker) {
    return [
        'firstname'=>$faker->firstName,
        'lastname'=>$faker->lastName,
        'nickname'=>$faker->userName,
    ];
});
