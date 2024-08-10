<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as AppServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends AppServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->routes(function () {
            Route::prefix('admin')
                ->middleware(['web', 'auth', 'VerifyIsAdmin'])
                ->group(base_path('routes/admin.php'));
        });
        parent::register();
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
