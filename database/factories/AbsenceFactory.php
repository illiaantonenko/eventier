<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Absence::class, function (Faker $faker) {
    return [
        'reason'=>$faker->text,
        'date'=>$faker->unixTime
    ];
});
