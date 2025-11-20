<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Supervisor\IngredientController;
use App\Http\Controllers\Supervisor\MenuItemController;
use App\Http\Controllers\Supervisor\RecipeController;
use App\Http\Controllers\Employee\OrderController;
use App\Http\Controllers\Employee\PosController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SupervisorDashboardController;

// ---------------------------
// AUTHENTICATION
// ---------------------------
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/', fn() => redirect('/login'));

// ---------------------------
// AUTH PROTECTED ROUTES
// ---------------------------
Route::middleware(['auth'])->group(function () {

    // Shared dashboard (redirects by role internally)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // ----------------------------------------
    // ADMIN ROUTES
    // ----------------------------------------
    Route::prefix('admin')
        ->middleware('admin')  // Use string reference
        ->name('admin.')
        ->group(function () {

            Route::get('/dashboard', function () {
                return view('admin.dashboard');
            })->name('dashboard');

            Route::resource('users', UserController::class);
            Route::post('users/{user}/reset-password', [UserController::class, 'resetPassword'])
                ->name('users.reset-password');
        });

    // ----------------------------------------
    // SUPERVISOR ROUTES
    // ----------------------------------------
    Route::prefix('supervisor')
    ->middleware('supervisor')
    ->name('supervisor.')
    ->group(function () {

        Route::get('/dashboard', [SupervisorDashboardController::class, 'index'])
            ->name('dashboard');

        // Ingredient Management
        Route::resource('ingredients', IngredientController::class);
        Route::post('ingredients/{ingredient}/adjust-stock', [IngredientController::class, 'adjustStock'])
            ->name('ingredients.adjust-stock');

        // Menu Items Management
        Route::resource('menu-items', MenuItemController::class);
        Route::post('menu-items/{menu_item}/toggle-availability', [MenuItemController::class, 'toggleAvailability'])
            ->name('menu-items.toggle-availability');

        // Recipe Management
        Route::resource('recipes', RecipeController::class);
    });
    // ----------------------------------------
    // EMPLOYEE ROUTES
    // ----------------------------------------
    Route::prefix('employee')
        ->middleware('employee')  // Use string reference
        ->name('employee.')
        ->group(function () {

            // POS System
            Route::get('/pos', [PosController::class, 'index'])->name('pos');
            Route::post('/pos', [PosController::class, 'store'])->name('pos.store');

            // Order Management
            Route::resource('orders', OrderController::class)->only(['index', 'show']);
        });

    // ----------------------------------------
    // PROFILE MANAGEMENT (All Authenticated Users)
    // ----------------------------------------
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

