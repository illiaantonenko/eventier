<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Event::class, function (Faker $faker) {
    return [
        'title'=>$faker->realText(50),
        'description'=>$faker->realText(),
        'category_id'=>$faker->numberBetween(1,10),
        'start'=>$faker->unixTime,
        'end'=>$faker->unixTime,
        'repeat'=>$faker->randomElement(['never','everyday','everyweek','everymonth','everyyear']),
        'published'=>$faker->numberBetween(0,1)
    ];
});
