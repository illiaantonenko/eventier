<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Category::class,10)->create();
        factory(\App\Models\User::class,25)->create()->each(function ($user){
            $user->profile()->save(factory(\App\Models\Profile::class)->make());
            $user->news()->saveMany(factory(\App\Models\News::class,10)->make());
            $user->event()->saveMany(factory(\App\Models\Event::class,10)->make());
            $user->absence()->saveMany(factory(\App\Models\Absence::class,10)->make());
        });

    }
}
