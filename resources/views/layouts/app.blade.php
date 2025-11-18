<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Restaurant Management System')</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        .sidebar-transition {
            transition: all 0.3s ease;
        }
        .active-nav-item {
            background-color: #dbeafe;
            border-left: 4px solid #2563eb;
            color: #2563eb;
        }
        
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }
        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 3px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
    </style>
</head>
<body class="bg-gray-50/50">
    @auth
        <!-- Include the updated header partial -->
        @include('partials.header')

        <!-- Spacer for fixed header -->
        <div class="h-20"></div>

        <!-- Page Header with Actions Section -->
        <div class="container mx-auto px-6 mb-6">
            <div class="flex items-center justify-between">
                <div>
                    @hasSection('title')
                        <h1 class="text-3xl font-black text-gray-900">@yield('title')</h1>
                    @endif
                    @hasSection('subtitle')
                        <p class="text-gray-600 mt-2">@yield('subtitle')</p>
                    @endif
                    
                    @hasSection('breadcrumbs')
                        <div class="mt-2">
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

        <main class="min-h-screen">
            @yield('content')
        </main>
    @else
        <main>
            @yield('content')
        </main>
    @endauth

    @include('partials.footer')

    <!-- Alpine.js for interactivity -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    
    @stack('scripts')
</body>
</html>