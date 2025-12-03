@php
    $role = auth()->user()->role ?? 'guest';
@endphp

<!-- Header -->
<header class="navbar" id="header" style="position: fixed; top: 0; left: 0; right: 0; z-index: 1000;">
    <div class="container" style="display: flex; align-items: center; justify-content: space-between;">
        <!-- Left Section: Logo -->
        <div class="flex items-center" style="gap: var(--space-4);">
            <a href="{{ route('dashboard') }}" class="flex items-center" style="text-decoration: none; gap: var(--space-3); padding: var(--space-2); border-radius: var(--radius-lg); transition: all var(--transition-fast);">
                <div style="width: 40px; height: 40px; background: var(--accent-color); border-radius: var(--radius-lg); display: flex; align-items: center; justify-content: center; box-shadow: var(--shadow-base);">
                    <i class="fas fa-utensils" style="color: var(--primary-dark);"></i>
                </div>
                <div class="flex flex-col">
                    <div class="text-lg font-bold text-primary">RestaurantPro</div>
                    <div class="text-xs text-secondary font-medium">Management System</div>
                </div>
            </a>
        </div>

        <!-- Middle Section: Navigation -->
        <div class="flex items-center" style="gap: var(--space-4);">
            <!-- Desktop Navigation Menu -->
            <nav class="nav-links" style="display: flex; align-items: center; gap: var(--space-2);">
                <!-- Admin Management (Only for Admin) -->
                @if($role === 'admin')
                <a href="{{ route('admin.users.index') }}" class="btn btn-outline" style="display: flex; align-items: center; gap: var(--space-2);">
                    <i class="fas fa-user-cog"></i>
                    <span>User Management</span>
                </a>
                @endif

                <!-- Inventory Management (Only for Supervisor) -->
                @if($role === 'supervisor')
                <a href="{{ route('supervisor.ingredients.index') }}" class="btn btn-outline" style="display: flex; align-items: center; gap: var(--space-2);">
                    <i class="fas fa-box"></i>
                    <span>Ingredients</span>
                </a>
                <a href="{{ route('supervisor.menu-items.index') }}" class="btn btn-outline" style="display: flex; align-items: center; gap: var(--space-2);">
                    <i class="fas fa-utensils"></i>
                    <span>Menu Items</span>
                </a>
                <a href="{{ route('supervisor.recipes.index') }}" class="btn btn-outline" style="display: flex; align-items: center; gap: var(--space-2);">
                    <i class="fas fa-book"></i>
                    <span>Recipes</span>
                </a>
                @endif

                <!-- Operations (Only for Employee) -->
                @if($role === 'employee')
                <a href="{{ route('employee.pos') }}" class="btn btn-outline" style="display: flex; align-items: center; gap: var(--space-2);">
                    <i class="fas fa-credit-card"></i>
                    <span>POS System</span>
                </a>
                <a href="{{ route('employee.orders.index') }}" class="btn btn-outline" style="display: flex; align-items: center; gap: var(--space-2);">
                    <i class="fas fa-list-alt"></i>
                    <span>Order History</span>
                </a>
                @endif
            </nav>

            <!-- Right Section: User Menu -->
            <div class="flex items-center" style="gap: var(--space-4);">
                <!-- Profile Button -->
                <a href="#" class="btn btn-outline" style="display: flex; align-items: center; gap: var(--space-2);">
                    <div style="width: 32px; height: 32px; background: var(--accent-color); border-radius: var(--radius-lg); display: flex; align-items: center; justify-content: center; color: var(--primary-dark); font-weight: 600; font-size: var(--text-sm);">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <span>Profile</span>
                </a>

                <!-- Logout Button -->
                <form method="POST" action="{{ route('logout') }}" style="display: inline; margin: 0;">
                    @csrf
                    <button type="submit" class="btn" style="background: #dc3545; color: white; border: none; display: flex; align-items: center; gap: var(--space-2);">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </button>
                </form>

                <!-- Mobile Menu Button -->
                <button class="btn btn-outline" id="mobileMenuButton" style="display: none; width: 40px; height: 40px; padding: 0;">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Navigation Menu -->
    <div id="mobileMenu" style="display: none; border-top: 1px solid var(--border-light); padding: var(--space-4);">
        <nav style="display: flex; flex-direction: column; gap: var(--space-2);">
            <!-- Admin Management (Only for Admin) -->
            @if($role === 'admin')
            <div style="margin-bottom: var(--space-4);">
                <div class="text-xs font-medium text-secondary" style="text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: var(--space-2); padding-left: var(--space-4);">Admin Management</div>
                <a href="{{ route('admin.users.index') }}" class="dropdown-item">
                    <i class="fas fa-user-cog"></i>
                    <span>User Management</span>
                </a>
            </div>
            @endif

            <!-- Inventory Management (Only for Supervisor) -->
            @if($role === 'supervisor')
            <div style="margin-bottom: var(--space-4);">
                <div class="text-xs font-medium text-secondary" style="text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: var(--space-2); padding-left: var(--space-4);">Inventory Management</div>
                <a href="{{ route('supervisor.ingredients.index') }}" class="dropdown-item">
                    <i class="fas fa-box"></i>
                    <span>Ingredients</span>
                </a>
                <a href="{{ route('supervisor.menu-items.index') }}" class="dropdown-item">
                    <i class="fas fa-utensils"></i>
                    <span>Menu Items</span>
                </a>
                <a href="{{ route('supervisor.recipes.index') }}" class="dropdown-item">
                    <i class="fas fa-book"></i>
                    <span>Recipes</span>
                </a>
            </div>
            @endif

            <!-- Operations (Only for Employee) -->
            @if($role === 'employee')
            <div style="margin-bottom: var(--space-4);">
                <div class="text-xs font-medium text-secondary" style="text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: var(--space-2); padding-left: var(--space-4);">Operations</div>
                <a href="{{ route('employee.pos') }}" class="dropdown-item">
                    <i class="fas fa-cash-register"></i>
                    <span>POS System</span>
                </a>
                <a href="{{ route('employee.orders.index') }}" class="dropdown-item">
                    <i class="fas fa-list-alt"></i>
                    <span>Order History</span>
                </a>
            </div>
            @endif

            <!-- Profile Settings -->
            <div style="margin-bottom: var(--space-4);">
                <div class="text-xs font-medium text-secondary" style="text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: var(--space-2); padding-left: var(--space-4);">Account</div>
                <a href="{{ route('profile.edit') }}" class="dropdown-item">
                    <i class="fas fa-user-edit"></i>
                    <span>Edit Profile</span>
                </a>
                <form method="POST" action="{{ route('logout') }}" style="margin-top: var(--space-2);">
                    @csrf
                    <button type="submit" class="dropdown-item" style="width: 100%; color: #dc3545; text-align: left; border: none; background: none; cursor: pointer;">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Sign Out</span>
                    </button>
                </form>
            </div>
        </nav>
    </div>
</header>

<script>
    // Header scroll effect
    window.addEventListener('scroll', function() {
        const header = document.getElementById('header');
        if (window.scrollY > 10) {
            header.style.boxShadow = 'var(--shadow-lg)';
            header.style.background = 'var(--background-card)';
        } else {
            header.style.boxShadow = 'var(--shadow-sm)';
            header.style.background = 'var(--background-card)';
        }
    });

    // Mobile menu functionality
    document.addEventListener('DOMContentLoaded', function() {
        // Mobile menu toggle
        const mobileMenuButton = document.getElementById('mobileMenuButton');
        const mobileMenu = document.getElementById('mobileMenu');

        if (mobileMenuButton && mobileMenu) {
            // Show mobile menu button on small screens
            if (window.innerWidth <= 1024) {
                mobileMenuButton.style.display = 'flex';
            }

            window.addEventListener('resize', function() {
                if (window.innerWidth <= 1024) {
                    mobileMenuButton.style.display = 'flex';
                } else {
                    mobileMenuButton.style.display = 'none';
                    mobileMenu.style.display = 'none';
                }
            });

            mobileMenuButton.addEventListener('click', function() {
                mobileMenu.style.display = mobileMenu.style.display === 'block' ? 'none' : 'block';

                // Toggle icon
                const icon = mobileMenuButton.querySelector('i');
                if (mobileMenu.style.display === 'block') {
                    icon.className = 'fas fa-times';
                } else {
                    icon.className = 'fas fa-bars';
                }
            });
        }
    });
</script>

<style>
    @media (max-width: 1024px) {
        .nav-links {
            display: none !important;
        }

        #mobileMenuButton {
            display: flex !important;
        }
    }

    @media (max-width: 640px) {
        .dropdown-toggle .flex.flex-col {
            display: none;
        }
    }
</style>
