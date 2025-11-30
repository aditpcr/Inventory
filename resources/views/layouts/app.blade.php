<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Restaurant Management System')</title>

    <!-- Davis Design System CSS -->
    <link rel="stylesheet" href="{{ asset('css/davis-design-system.css') }}">
    
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Alpine.js for interactivity -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    
    <style>
        .sidebar-transition {
            transition: all var(--transition-base);
        }
        .active-nav-item {
            background-color: var(--background-light);
            border-left: 4px solid var(--accent-color);
            color: var(--accent-color);
        }
        
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
        }
        ::-webkit-scrollbar-track {
            background: var(--background-light);
        }
        ::-webkit-scrollbar-thumb {
            background: var(--border-light);
            border-radius: 3px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: var(--text-light);
        }
    </style>
</head>
<body>
    @auth
        <!-- Include the updated header partial -->
        @include('partials.header')

        <!-- Spacer for fixed header -->
        <div style="height: 120px;"></div>

        <!-- Page Header with Actions Section -->
        <div class="container" style="margin-bottom: var(--space-6);">
            <div class="flex items-center justify-between">
                <div>
                    @hasSection('title')
                        <h1 class="text-3xl font-bold text-primary" style="margin-bottom: var(--space-2);">@yield('title')</h1>
                    @endif
                    @hasSection('subtitle')
                        <p class="text-secondary" style="margin-top: var(--space-2);">@yield('subtitle')</p>
                    @endif
                    
                    @hasSection('breadcrumbs')
                        <div style="margin-top: var(--space-2);">
                            @yield('breadcrumbs')
                        </div>
                    @endif
                </div>
                
                @hasSection('actions')
                    <div class="actions">
                        @yield('actions')
                    </div>
                @endif
            </div>
        </div>

        <main style="min-height: calc(100vh - 200px); padding-bottom: var(--space-12);">
            @yield('content')
        </main>
    @else
        <main style="padding-bottom: var(--space-12);">
            @yield('content')
        </main>
    @endauth

    @include('partials.footer')
    
    @stack('scripts')
</body>
</html>