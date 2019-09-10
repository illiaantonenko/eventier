<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        Blade::directive('verified', function () {
            $string = "<?php if(auth()->check()): ?>";
            $string .= "<?php if(auth()->user()->hasVerifiedEmail()): ?>";
            return $string;
        });
        Blade::directive('endverified', function () {
            $string = "<?php endif; endif; ?>";
            return $string;
        });

        Blade::directive('moderated',function (){
            $string = "<?php if(auth()->check()): ?>";
            $string .= "<?php if(auth()->user()->moderated): ?>";
            return $string;
        });
        Blade::directive('endmoderated', function () {
            $string = "<?php endif; endif; ?>";
            return $string;
        });

        Blade::directive('admin',function (){
            $string = "<?php if(auth()->check()): ?>";
            $string .= "<?php if(auth()->user()->role == 'admin'): ?>";
            return $string;
        });
        Blade::directive('endadmin', function () {
            $string = "<?php endif; endif; ?>";
            return $string;
        });

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
}
