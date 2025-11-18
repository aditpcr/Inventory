@php
    $role = strtolower(auth()->user()->role ?? '');
@endphp

<header class="bg-white/80 backdrop-blur-2xl border-b border-gray-200/60 fixed top-0 left-0 right-0 z-50">
    <div class="flex items-center justify-between px-6 py-3">
        <!-- Left Section: Logo -->
        <div class="flex items-center space-x-8">
            <!-- Logo that links to dashboard -->
            <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 group">
                <div class="w-9 h-9 bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg group-hover:shadow-xl transition-all duration-200">
                    <i class="fas fa-utensils text-white text-sm"></i>
                </div>
                <div>
                    <h1 class="text-lg font-semibold text-gray-900 tracking-tight">
                        RestaurantMS
                    </h1>
                </div>
            </a>

            <!-- Main Navigation -->
            <nav class="hidden lg:flex items-center space-x-1">
                <!-- Admin Management Dropdown (Only for Admin) -->
                @if($role === 'admin')
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" 
                            class="px-4 py-2 text-sm font-medium text-gray-700 hover:text-blue-600 rounded-xl hover:bg-gray-100/80 transition-all duration-200 flex items-center">
                        <i class="fas fa-users mr-2"></i>Admin
                        <i class="fas fa-chevron-down ml-1 text-xs transition-transform duration-200" :class="{ 'rotate-180': open }"></i>
                    </button>
                    
                    <div x-show="open" @click.away="open = false" 
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 transform scale-95 -translate-y-2"
                         x-transition:enter-end="opacity-100 transform scale-100 translate-y-0"
                         class="absolute top-full left-0 mt-2 w-56 bg-white/95 backdrop-blur-2xl rounded-2xl shadow-2xl border border-gray-200/60 py-2 z-50">
                        <a href="{{ route('admin.users.index') }}" 
                           class="flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-all duration-200 group">
                            <i class="fas fa-user-cog mr-3 text-gray-400 group-hover:text-blue-500"></i>
                            <span class="font-medium">User Management</span>
                        </a>
                    </div>
                </div>
                @endif

                <!-- Inventory Management Dropdown (Only for Supervisor) -->
                @if($role === 'supervisor')
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" 
                            class="px-4 py-2 text-sm font-medium text-gray-700 hover:text-blue-600 rounded-xl hover:bg-gray-100/80 transition-all duration-200 flex items-center">
                        <i class="fas fa-boxes mr-2"></i>Inventory
                        <i class="fas fa-chevron-down ml-1 text-xs transition-transform duration-200" :class="{ 'rotate-180': open }"></i>
                    </button>
                    
                    <div x-show="open" @click.away="open = false" 
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 transform scale-95 -translate-y-2"
                         x-transition:enter-end="opacity-100 transform scale-100 translate-y-0"
                         class="absolute top-full left-0 mt-2 w-64 bg-white/95 backdrop-blur-2xl rounded-2xl shadow-2xl border border-gray-200/60 py-2 z-50">
                        <a href="{{ route('supervisor.ingredients.index') }}" 
                           class="flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-all duration-200 group">
                            <i class="fas fa-box mr-3 text-gray-400 group-hover:text-blue-500"></i>
                            <span class="font-medium">Ingredients</span>
                        </a>
                        <a href="{{ route('supervisor.menu-items.index') }}" 
                           class="flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-all duration-200 group">
                            <i class="fas fa-utensils mr-3 text-gray-400 group-hover:text-blue-500"></i>
                            <span class="font-medium">Menu Items</span>
                        </a>
                        <a href="{{ route('supervisor.recipes.index') }}" 
                           class="flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-all duration-200 group">
                            <i class="fas fa-book mr-3 text-gray-400 group-hover:text-blue-500"></i>
                            <span class="font-medium">Recipes</span>
                        </a>
                    </div>
                </div>
                @endif

                <!-- Operations Dropdown (Only for Employee) -->
                @if($role === 'employee')
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" 
                            class="px-4 py-2 text-sm font-medium text-gray-700 hover:text-blue-600 rounded-xl hover:bg-gray-100/80 transition-all duration-200 flex items-center">
                        <i class="fas fa-cash-register mr-2"></i>Operations
                        <i class="fas fa-chevron-down ml-1 text-xs transition-transform duration-200" :class="{ 'rotate-180': open }"></i>
                    </button>
                    
                    <div x-show="open" @click.away="open = false" 
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 transform scale-95 -translate-y-2"
                         x-transition:enter-end="opacity-100 transform scale-100 translate-y-0"
                         class="absolute top-full left-0 mt-2 w-56 bg-white/95 backdrop-blur-2xl rounded-2xl shadow-2xl border border-gray-200/60 py-2 z-50">
                        <a href="{{ route('employee.pos') }}" 
                           class="flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-all duration-200 group">
                            <i class="fas fa-credit-card mr-3 text-gray-400 group-hover:text-blue-500"></i>
                            <span class="font-medium">POS System</span>
                        </a>
                        <a href="{{ route('employee.orders.index') }}" 
                           class="flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-all duration-200 group">
                            <i class="fas fa-list-alt mr-3 text-gray-400 group-hover:text-blue-500"></i>
                            <span class="font-medium">Order History</span>
                        </a>
                    </div>
                </div>
                @endif
            </nav>
        </div>

        <!-- Right Section: User Menu -->
        <div class="flex items-center space-x-4">
            <!-- Notifications -->
            <button class="relative p-2 text-gray-500 hover:text-blue-600 transition-all duration-200 group">
                <div class="w-9 h-9 rounded-xl bg-gray-100/80 flex items-center justify-center group-hover:bg-blue-100/80 transition-colors">
                    <i class="fas fa-bell text-sm"></i>
                </div>
                <span class="absolute -top-1 -right-1 w-2 h-2 bg-red-500 rounded-full border-2 border-white shadow-sm"></span>
            </button>

            <!-- User Profile -->
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" 
                        class="flex items-center space-x-3 focus:outline-none group p-2 rounded-2xl hover:bg-gray-100/80 transition-all duration-200">
                    <div class="text-right hidden sm:block">
                        <p class="text-sm font-medium text-gray-800">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-gray-500 capitalize">{{ auth()->user()->role }}</p>
                    </div>
                    
                    <div class="w-9 h-9 bg-gradient-to-br from-blue-400 to-purple-500 rounded-xl flex items-center justify-center shadow-lg">
                        <span class="text-white font-semibold text-xs">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </span>
                    </div>
                    
                    <i class="fas fa-chevron-down text-gray-400 text-xs transition-transform duration-200" 
                       :class="{ 'rotate-180': open }"></i>
                </button>

                <!-- User Dropdown -->
                <div x-show="open" @click.away="open = false" 
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 transform scale-95 -translate-y-2"
                     x-transition:enter-end="opacity-100 transform scale-100 translate-y-0"
                     class="absolute right-0 mt-2 w-64 bg-white/95 backdrop-blur-2xl rounded-2xl shadow-2xl border border-gray-200/60 py-3 z-50">

                    <!-- User Info -->
                    <div class="px-5 py-4 border-b border-gray-200/60">
                        <p class="font-semibold text-gray-800">{{ auth()->user()->name }}</p>
                        <p class="text-sm text-gray-500 mt-1">{{ auth()->user()->email }}</p>
                        <span class="inline-block mt-2 px-3 py-1 bg-gradient-to-r from-blue-500 to-purple-500 text-white text-xs font-medium rounded-full capitalize">
                            {{ auth()->user()->role }}
                        </span>
                    </div>
                    
                    <!-- Menu Items -->
                    <a href="{{ route('profile.edit') }}" 
                       class="flex items-center px-5 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-all duration-200 group">
                        <div class="w-8 h-8 rounded-lg bg-blue-50 flex items-center justify-center mr-3 group-hover:bg-blue-100 transition-colors">
                            <i class="fas fa-user-edit text-blue-500 text-sm"></i>
                        </div>
                        <span class="font-medium">Edit Profile</span>
                    </a>
                    
                    <div class="border-t border-gray-200/60 mt-2 pt-2">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" 
                                    class="flex items-center w-full px-5 py-3 text-red-600 hover:bg-red-50 transition-all duration-200 group">
                                <div class="w-8 h-8 rounded-lg bg-red-50 flex items-center justify-center mr-3 group-hover:bg-red-100 transition-colors">
                                    <i class="fas fa-sign-out-alt text-red-500 text-sm"></i>
                                </div>
                                <span class="font-medium">Sign Out</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Mobile Menu Button -->
            <button id="mobileMenuButton" class="lg:hidden p-2 rounded-xl text-gray-600 hover:bg-gray-100/80 hover:text-blue-600 transition-all duration-200">
                <i class="fas fa-bars text-sm"></i>
            </button>
        </div>
    </div>

    <!-- Mobile Navigation Menu -->
    <div id="mobileMenu" class="lg:hidden bg-white/95 backdrop-blur-2xl border-t border-gray-200/60 px-6 py-4 hidden">
        <nav class="space-y-2">
            <!-- Admin Management (Only for Admin) -->
            @if($role === 'admin')
            <div class="border-l-2 border-blue-200 pl-4 ml-3">
                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Admin Management</p>
                <a href="{{ route('admin.users.index') }}" 
                   class="flex items-center px-4 py-3 text-gray-700 rounded-xl hover:bg-blue-50 hover:text-blue-600 transition-all duration-200 {{ str_starts_with(Route::currentRouteName(), 'admin.users') ? 'bg-blue-50 text-blue-600' : '' }}">
                    <i class="fas fa-users mr-3"></i>
                    <span class="font-medium">User Management</span>
                </a>
            </div>
            @endif

            <!-- Inventory Management (Only for Supervisor) -->
            @if($role === 'supervisor')
            <div class="border-l-2 border-green-200 pl-4 ml-3">
                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Inventory Management</p>
                <a href="{{ route('supervisor.ingredients.index') }}" 
                   class="flex items-center px-4 py-3 text-gray-700 rounded-xl hover:bg-blue-50 hover:text-blue-600 transition-all duration-200 {{ str_starts_with(Route::currentRouteName(), 'supervisor.ingredients') ? 'bg-blue-50 text-blue-600' : '' }}">
                    <i class="fas fa-boxes mr-3"></i>
                    <span class="font-medium">Ingredients</span>
                </a>
                <a href="{{ route('supervisor.menu-items.index') }}" 
                   class="flex items-center px-4 py-3 text-gray-700 rounded-xl hover:bg-blue-50 hover:text-blue-600 transition-all duration-200 {{ str_starts_with(Route::currentRouteName(), 'supervisor.menu-items') ? 'bg-blue-50 text-blue-600' : '' }}">
                    <i class="fas fa-utensils mr-3"></i>
                    <span class="font-medium">Menu Items</span>
                </a>
                <a href="{{ route('supervisor.recipes.index') }}" 
                   class="flex items-center px-4 py-3 text-gray-700 rounded-xl hover:bg-blue-50 hover:text-blue-600 transition-all duration-200 {{ str_starts_with(Route::currentRouteName(), 'supervisor.recipes') ? 'bg-blue-50 text-blue-600' : '' }}">
                    <i class="fas fa-book mr-3"></i>
                    <span class="font-medium">Recipes</span>
                </a>
            </div>
            @endif

            <!-- Operations (Only for Employee) -->
            @if($role === 'employee')
            <div class="border-l-2 border-orange-200 pl-4 ml-3">
                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Operations</p>
                <a href="{{ route('employee.pos') }}" 
                   class="flex items-center px-4 py-3 text-gray-700 rounded-xl hover:bg-blue-50 hover:text-blue-600 transition-all duration-200 {{ str_starts_with(Route::currentRouteName(), 'employee.pos') ? 'bg-blue-50 text-blue-600' : '' }}">
                    <i class="fas fa-cash-register mr-3"></i>
                    <span class="font-medium">POS System</span>
                </a>
                <a href="{{ route('employee.orders.index') }}" 
                   class="flex items-center px-4 py-3 text-gray-700 rounded-xl hover:bg-blue-50 hover:text-blue-600 transition-all duration-200 {{ str_starts_with(Route::currentRouteName(), 'employee.orders') ? 'bg-blue-50 text-blue-600' : '' }}">
                    <i class="fas fa-list-alt mr-3"></i>
                    <span class="font-medium">Order History</span>
                </a>
            </div>
            @endif

            <!-- Profile Settings -->
            <a href="{{ route('profile.edit') }}" 
               class="flex items-center px-4 py-3 text-gray-700 rounded-xl hover:bg-blue-50 hover:text-blue-600 transition-all duration-200 {{ Route::currentRouteName() === 'profile.edit' ? 'bg-blue-50 text-blue-600' : '' }}">
                <i class="fas fa-user-edit mr-3"></i>
                <span class="font-medium">Profile Settings</span>
            </a>
        </nav>
    </div>
</header>

<script>
    // Mobile menu functionality
    document.addEventListener('DOMContentLoaded', function() {
        const mobileMenuButton = document.getElementById('mobileMenuButton');
        const mobileMenu = document.getElementById('mobileMenu');

        if (mobileMenuButton && mobileMenu) {
            mobileMenuButton.addEventListener('click', function() {
                mobileMenu.classList.toggle('hidden');
                
                // Toggle icon
                const icon = mobileMenuButton.querySelector('i');
                if (mobileMenu.classList.contains('hidden')) {
                    icon.className = 'fas fa-bars text-sm';
                } else {
                    icon.className = 'fas fa-times text-sm';
                }
            });
        }

        // Close mobile menu when clicking outside
        document.addEventListener('click', function(event) {
            if (mobileMenu && mobileMenuButton && !mobileMenu.contains(event.target) && !mobileMenuButton.contains(event.target)) {
                mobileMenu.classList.add('hidden');
                const icon = mobileMenuButton.querySelector('i');
                if (icon) {
                    icon.className = 'fas fa-bars text-sm';
                }
            }
        });

        // Close mobile menu when clicking a link
        if (mobileMenu) {
            const mobileLinks = mobileMenu.querySelectorAll('a');
            mobileLinks.forEach(link => {
                link.addEventListener('click', () => {
                    mobileMenu.classList.add('hidden');
                    const icon = mobileMenuButton.querySelector('i');
                    if (icon) {
                        icon.className = 'fas fa-bars text-sm';
                    }
                });
            });
        }
    });
</script>