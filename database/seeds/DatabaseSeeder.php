<?php

use App\Models\Absence;
use App\Models\Birthday;
use App\Models\Category;
use App\Models\Event;
use App\Models\EventRegistration;
use App\Models\News;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'email' => 'test@test.com',
            'role' => 'admin',
            'moderated' => 1,
            'email_verified_at' => now(),
            'password' => bcrypt('secret'),
            'remember_token' => str_random(10),
        ]);
        DB::table('profiles')->insert([
            'user_id' => 1,
            'firstname' => 'Illia',
            'middlename' => '',
            'lastname' => 'Antonenko',
            'nickname' => 'redrevan',
            'birthdate' => strtotime('11.08.1997'),
            'hideyear' => 0,
            'phone' => '+380999999999',
        ]);
        factory(Category::class, 10)->create();
        factory(User::class, 25)->create()->each(function ($user) {
            /** @var User $user */
            $user->profile()->save(factory(Profile::class)->make());
            $user->birthday()->save(factory(Birthday::class)->make());
            $user->news()->saveMany(factory(News::class, 10)->make());
            $user->absence()->saveMany(factory(Absence::class, 10)->make());
            $user->event()->saveMany(factory(Event::class, 10)->make());
            $user->event()->each(function ($event) {
                /** @var Event $event */
                $event->eventRegistration()->saveMany(factory(EventRegistration::class, 5)->make());
            });
        });

    }
}
