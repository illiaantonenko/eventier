<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Schema::defaultStringLength(191);

//        $events->listen(BuildingMenu::class, function (BuildingMenu $event) {
//            foreach ($this->getAdminMenu() as $item) {
//                $event->menu->add($item);
//            }
//        });

        $this->registerBladeDirectives();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
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
