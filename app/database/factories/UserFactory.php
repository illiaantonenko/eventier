<?php

use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

/** @var Factory $factory */
$factory->define(App\Models\User::class, function (Faker $faker) {
    return [
        'email' => $faker->unique()->safeEmail,
        'role' => $faker->randomElement(['admin','teacher','student']),
        'moderated'=>$faker->numberBetween(0,1),
        'group_id'=>$faker->numberBetween(1,10),
        'email_verified_at' => now(),
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});
