<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->isLocal()) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('isAdmin', function () {
            return "<?php if(Auth::user()->isAdmin()): ?>";
        });

        Blade::directive('endisAdmin', function() {
            return "<?php endif; ?>";
        });

        Blade::directive('isSuperAdmin', function () {
            return "<?php if(Auth::user()->isSuperAdmin()): ?>";
        });

        Blade::directive('endisSuperAdmin', function() {
            return "<?php endif; ?>";
        });
    }
}
