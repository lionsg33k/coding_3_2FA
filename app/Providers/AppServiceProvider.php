<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Spatie\Permission\Models\Role;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //

        Blade::directive("checkRole", function (string $role) {
            return "<?php if (Auth::check() && Auth::user()->hasRole($role)) : ?>";
        });

        Blade::directive("endCheckRole", function () {
            return "<?php endif ; ?>";
        });


        $roles = Role::all();
        view()->share([
            "roles" => $roles
        ]);
    }
}
