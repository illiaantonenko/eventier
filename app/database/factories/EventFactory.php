<?php

use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

/** @var Factory $factory */
$factory->define(\App\Models\Event::class, function (Faker $faker) {
    $startTime = $faker->unixTime;
    return [
        'title' => $faker->realText(50),
        'description' => $faker->realText(),
        'category_id' => $faker->numberBetween(1, 10),
        'start' => $startTime,
        'end' => $startTime + 10000,
        'repeat' => $faker->randomElement(['never', 'daily', 'weekly', 'monthly', 'yearly']),
        'published' => $faker->numberBetween(0, 1),
        'course_id' => $faker->numberBetween(1, 20),
    ];
});
