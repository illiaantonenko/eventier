<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Profile::class, function (Faker $faker) {
    return [
        'firstname'=>$faker->firstName,
        'middlename'=>$faker->firstName,
        'lastname'=>$faker->lastName,
        'nickname'=>$faker->userName,
        'birthdate'=>$faker->unixTime,
        'hideyear'=>$faker->numberBetween(0,1),
        'phone'=>$faker->phoneNumber,
    ];
});
