<?php

namespace App\Providers;

use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\EmployeeMiddleware;
use App\Http\Middleware\SupervisorMiddleware;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        foreach ([
            'admin' => AdminMiddleware::class,
            'supervisor' => SupervisorMiddleware::class,
            'employee' => EmployeeMiddleware::class,
        ] as $alias => $middleware) {
            Route::aliasMiddleware($alias, $middleware);
        }

        // Share user role globally with all views
        View::composer('*', function ($view) {
            if (auth()->check()) {
                $view->with('role', auth()->user()->role);
            }
        });
    }
}
