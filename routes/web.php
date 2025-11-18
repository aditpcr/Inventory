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







// Temporary debug route — REMOVE after debugging
Route::get('/__supervisor-debug', function () {
    $result = [
        'timestamp' => now()->toDateTimeString(),
        'kernel_route_middleware' => null,
        'alias_exists' => false,
        'alias_class' => null,
        'class_exists' => false,
        'container_make' => null,
        'routes_using_supervisor' => [],
        'files_referencing_supervisor' => [],
        'controllers_using_middleware_in_constructor' => [],
        'errors' => [],
    ];

    try {
        $kernel = app(\App\Http\Kernel::class);
        $map = $kernel->getRouteMiddleware();
        $result['kernel_route_middleware'] = $map;
        $result['alias_exists'] = array_key_exists('supervisor', $map);
        $result['alias_class'] = $map['supervisor'] ?? null;
        $result['class_exists'] = $result['alias_class'] ? class_exists($result['alias_class']) : false;

        // attempt to make via container and capture exception text if fails
        try {
            $instance = app()->make($result['alias_class']);
            $result['container_make'] = [
                'ok' => true,
                'class' => get_class($instance),
            ];
        } catch (\Throwable $e) {
            $result['container_make'] = [
                'ok' => false,
                'error' => $e->getMessage(),
            ];
        }

        // Search routes (route list) for middleware usage
        $routes = collect(\Route::getRoutes())->map(function ($r) {
            return [
                'uri' => $r->uri(),
                'name' => $r->getName(),
                'action' => is_array($r->getAction()) ? $r->getAction() : $r->getAction(),
                'middleware' => $r->gatherMiddleware(),
            ];
        })->filter(function ($r) {
            return in_array('supervisor', $r['middleware']) || collect($r['middleware'])->contains(function ($m) {
                return stripos($m, 'supervisor') !== false;
            });
        })->values()->all();

        $result['routes_using_supervisor'] = $routes;

        // Files to scan: routes and app folder controllers and middleware
        $pathsToScan = [
            base_path('routes'),
            app_path(),
        ];

        $foundFiles = [];

        foreach ($pathsToScan as $path) {
            $it = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path));
            foreach ($it as $file) {
                if (! $file->isFile()) continue;
                $ext = $file->getExtension();
                if (! in_array($ext, ['php'])) continue;
                $filePath = $file->getPathname();
                $contents = @file_get_contents($filePath);
                if ($contents === false) continue;

                $lower = strtolower($contents);

                $found = false;
                $matches = [];

                // Find ->middleware('supervisor') usage (alias)
                if (preg_match_all("/->middleware\s*\(\s*'([^']*)'\s*\)/i", $contents, $m1)) {
                    foreach ($m1[1] as $alias) {
                        if (stripos($alias, 'supervisor') !== false) {
                            $found = true;
                            $matches[] = [
                                'type' => 'route_middleware_alias',
                                'match' => $alias,
                            ];
                        }
                    }
                }

                // Find ->middleware([... 'supervisor' ...]) style
                if (preg_match_all("/->middleware\s*\(\s*\[([^\]]*)\]\s*\)/i", $contents, $mArr)) {
                    foreach ($mArr[1] as $groupStr) {
                        if (stripos($groupStr, 'supervisor') !== false) {
                            $found = true;
                            $matches[] = [
                                'type' => 'route_middleware_alias_array',
                                'match' => trim($groupStr),
                            ];
                        }
                    }
                }

                // Find ->middleware(SupervisorMiddleware::class) usage (class form)
                if (preg_match_all("/->middleware\s*\(\s*([A-Za-z0-9_\\\\]+::class)\s*\)/i", $contents, $m2)) {
                    foreach ($m2[1] as $classRef) {
                        if (stripos($classRef, 'Supervisor') !== false) {
                            $found = true;
                            $matches[] = [
                                'type' => 'route_middleware_class',
                                'match' => $classRef,
                            ];
                        }
                    }
                }

                // Find any direct 'supervisor' string references
                if (stripos($contents, 'supervisor') !== false) {
                    $found = true;
                    $matches[] = [
                        'type' => 'text_contains_supervisor',
                        'excerpt' => substr($contents, max(0, stripos($contents, 'supervisor') - 40), 120),
                    ];
                }

                // Check controllers constructors for $this->middleware usage referencing supervisor
                if (preg_match('/class\s+[A-Za-z0-9_]+Controller/i', $contents)
                    && preg_match('/__construct\s*\(/i', $contents)) {
                    // find lines with middleware in constructor
                    if (preg_match_all("/\\$this->middleware\s*\(\s*([^\)]*)\)/i", $contents, $m3)) {
                        foreach ($m3[1] as $param) {
                            if (stripos($param, 'supervisor') !== false || stripos($param, 'SupervisorMiddleware') !== false) {
                                $found = true;
                                $matches[] = [
                                    'type' => 'controller_constructor_middleware',
                                    'match' => trim($param),
                                ];
                                // record controller name
                                if (preg_match('/class\s+([A-Za-z0-9_]+Controller)/i', $contents, $cname)) {
                                    $controllerName = $cname[1] ?? null;
                                } else {
                                    $controllerName = null;
                                }
                                $result['controllers_using_middleware_in_constructor'][] = [
                                    'file' => str_replace(base_path() . DIRECTORY_SEPARATOR, '', $filePath),
                                    'controller' => $controllerName,
                                    'param' => trim($param),
                                ];
                            }
                        }
                    }
                }

                if ($found) {
                    $foundFiles[] = [
                        'file' => str_replace(base_path() . DIRECTORY_SEPARATOR, '', $filePath),
                        'matches' => $matches,
                    ];
                }
            }
        }

        $result['files_referencing_supervisor'] = $foundFiles;

    } catch (\Throwable $ex) {
        $result['errors'][] = $ex->getMessage();
        $result['errors_trace'] = $ex->getTraceAsString();
    }

    return response()->json($result, 200, [], JSON_PRETTY_PRINT);
});
