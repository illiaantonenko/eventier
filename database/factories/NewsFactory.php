<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\News::class, function (Faker $faker) {
    return [
        'title'=>$faker->realText(50),
        'description'=>$faker->realText(),
        'important'=>$faker->numberBetween(0,1),
        'published'=>$faker->numberBetween(0,1)
    ];
});
