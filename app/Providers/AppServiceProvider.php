<?php

namespace App\Providers;

use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\EmployeeMiddleware;
use App\Http\Middleware\SupervisorMiddleware;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Laravel\Socialite\Contracts\Factory as SocialiteFactory;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Fix SSL certificate issues for Windows/Laragon
        // This is safe for local development but should be configured properly in production
        if (app()->environment(['local', 'development', 'testing'])) {
            // For local development, disable SSL verification to avoid certificate issues
            // In production, ensure proper SSL certificates are configured
            $this->app->singleton(\GuzzleHttp\Client::class, function ($app) {
                return new \GuzzleHttp\Client([
                    'verify' => env('GUZZLE_VERIFY_SSL', false), // Set to true in production
                    'timeout' => 30,
                    'connect_timeout' => 10,
                ]);
            });
        }
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

        // Note: SSL certificate handling is configured in register() method
        // Socialite will automatically use the configured Guzzle client
    }
}
