<?php

use App\Models\Absence;
use App\Models\Birthday;
use App\Models\EventCategory;
use App\Models\Event;
use App\Models\EventRegistration;
use App\Models\News;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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
            'remember_token' => Str::random(10),
        ]);
        DB::table('profiles')->insert([
            'user_id' => 1,
            'firstname' => 'Illia',
            'lastname' => 'Antonenko',
            'nickname' => 'redrevan',
        ]);
        DB::table('birthdays')->insert([
            'user_id' => 1,
            'date' => \Carbon\Carbon::createFromDate('1997','08','11')->toDateString()
        ]);
        factory(EventCategory::class, 10)->create();
        factory(User::class, 25)->create()->each(function ($user) {
            /** @var User $user */
            $user->profile()->save(factory(Profile::class)->make());
            $user->birthday()->save(factory(Birthday::class)->make());
            $user->news()->saveMany(factory(News::class, 10)->make());
            $user->absences()->saveMany(factory(Absence::class, 10)->make());
            $user->event()->saveMany(factory(Event::class, 10)->make());
            $user->event()->each(function ($event) {
                /** @var Event $event */
                $event->eventRegistration()->saveMany(factory(EventRegistration::class, 5)->make());
            });
        });

    }
}
