<?php

namespace App\Providers;

use App\Models\Event;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @param Dispatcher $events
     * @return void
     */
    public function boot(Dispatcher $events)
    {
        Schema::defaultStringLength(191);

        $events->listen(BuildingMenu::class, function (BuildingMenu $event) {
            foreach ($this->getAdminMenu() as $item) {
                $event->menu->add($item);
            }
        });

        $this->registerBladeDirectives();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    protected function getAdminMenu()
    {
        $newEvents = Event::where('published', '=', '0')->count();
        return [
            'MAIN NAVIGATION',
            [
                'text' => __('Calendar'),
                'route' => 'admin.calendar',
                'icon' => 'calendar',
                'label_color' => 'info',
            ],
            [
                'text' => __('Events'),
                'route' => 'admin.events.index',
                'icon' => 'bell',
                $newEvents ? 'label' : '' => $newEvents ?? '',
                'label_color' => 'success',

            ],
            [
                'text' => __('News'),
                'route' => 'admin.news.index',
                'icon' => 'book',
                'label_color' => 'info',
            ],
            [
                'text' => __('Absences'),
                'route' => 'admin.absences.index',
                'icon' => 'comments',
                'label_color' => 'warning',
            ],
            [
                'text' => __('Categories'),
                'route' => 'admin.events.categories.index',
                'icon' => 'folder-open',
                'label_color' => 'warning',
            ],
            [
                'text' => __('Users'),
                'route' => 'admin.users.index',
                'icon' => 'users',
                'label_color' => 'success',
            ],
            [
                'text' => __('Groups'),
                'route' => 'admin.group.index',
                'icon' => 'institution',
                'label_color' => 'success',
            ],
            [
                'text' => __('Courses'),
                'route' => 'admin.course.index',
                'icon' => 'graduation-cap',
                'label_color' => 'success',
            ],
            [
                'text' => __('Birthdays'),
                'route' => 'admin.birthdays.index',
                'icon' => 'birthday-cake',
                'label_color' => 'success',
            ],
//        'ACCOUNT SETTINGS',
//        [
//            'text' => 'Profile',
//            'url'  => 'admin/settings',
//            'icon' => 'user',
//        ],
//        [
//            'text' => 'Change Password',
//            'url'  => 'admin/settings',
//            'icon' => 'lock',
//        ],
//        'LABELS',
//        [
//            'text'       => 'Important',
//            'icon_color' => 'red',
//        ],
//        [
//            'text'       => 'Warning',
//            'icon_color' => 'yellow',
//        ],
//        [
//            'text'       => 'Information',
//            'icon_color' => 'aqua',
//        ],
        ];
    }

    protected function registerBladeDirectives()
    {

        Blade::directive('verified', function () {
            $string = "<?php if(auth()->check()): ?>";
            $string .= "<?php if(auth()->user()->hasVerifiedEmail()): ?>";
            return $string;
        });
        Blade::directive('endverified', function () {
            return "<?php endif; endif; ?>";
        });

        Blade::directive('moderated', function () {
            $string = "<?php if(auth()->check()): ?>";
            $string .= "<?php if(auth()->user()->moderated): ?>";
            return $string;
        });
        Blade::directive('endmoderated', function () {
            return "<?php endif; endif; ?>";
        });

        Blade::directive('admin', function () {
            $string = "<?php if(auth()->check()): ?>";
            $string .= "<?php if(auth()->user()->role == 'admin'): ?>";
            return $string;
        });
        Blade::directive('endadmin', function () {
            return "<?php endif; endif; ?>";
        });
    }
}
