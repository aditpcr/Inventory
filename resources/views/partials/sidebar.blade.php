@php
    use Illuminate\Support\Str;
    $routeName = Route::currentRouteName();
    $user = Auth::user();
@endphp

<aside class="card" style="position: fixed; left: 0; top: 80px; bottom: 0; width: 250px; border-radius: 0; border-right: 1px solid var(--border-light); overflow-y: auto; z-index: 100;">
    <div class="card-header" style="border-bottom: 1px solid var(--border-light);">
        <div class="flex items-center" style="gap: var(--space-3);">
            <div style="width: 40px; height: 40px; background: var(--accent-color); border-radius: var(--radius-lg); display: flex; align-items: center; justify-content: center;">
                <i class="fas fa-utensils" style="color: var(--primary-dark);"></i>
            </div>
            <div>
                <div class="text-base font-bold text-primary">DeResto</div>
                <small class="text-xs text-secondary">Operations Hub</small>
            </div>
        </div>
    </div>

    <nav style="padding: var(--space-4); display: flex; flex-direction: column; gap: var(--space-2);">
        <a href="{{ route('dashboard') }}" class="nav-link {{ $routeName === 'dashboard' ? 'active-nav-item' : '' }}" style="display: flex; align-items: center; gap: var(--space-3); padding: var(--space-3); border-radius: var(--radius-md);">
            <i class="fas fa-chart-line"></i>
            <span>Dashboard</span>
        </a>

        @if($user->isAdmin())
            <a href="{{ route('admin.users.index') }}" class="nav-link {{ Str::startsWith($routeName, 'admin.users') ? 'active-nav-item' : '' }}" style="display: flex; align-items: center; gap: var(--space-3); padding: var(--space-3); border-radius: var(--radius-md);">
                <i class="fas fa-users-gear"></i>
                <span>User Management</span>
            </a>
            <a href="{{ route('admin.role-requests.index') }}" class="nav-link {{ Str::startsWith($routeName, 'admin.role-requests') ? 'active-nav-item' : '' }}" style="display: flex; align-items: center; gap: var(--space-3); padding: var(--space-3); border-radius: var(--radius-md);">
                <i class="fas fa-user-shield"></i>
                <span>Role Requests</span>
            </a>
        @endif

        @if($user->isSupervisor() || $user->isAdmin())
            <a href="{{ route('supervisor.dashboard') }}" class="nav-link {{ Str::startsWith($routeName, 'supervisor.dashboard') ? 'active-nav-item' : '' }}" style="display: flex; align-items: center; gap: var(--space-3); padding: var(--space-3); border-radius: var(--radius-md);">
                <i class="fas fa-layer-group"></i>
                <span>Supervisor</span>
            </a>
            <a href="{{ route('supervisor.ingredients.index') }}" class="nav-link {{ Str::startsWith($routeName, 'supervisor.ingredients') ? 'active-nav-item' : '' }}" style="display: flex; align-items: center; gap: var(--space-3); padding: var(--space-3); border-radius: var(--radius-md);">
                <i class="fas fa-box"></i>
                <span>Ingredients</span>
            </a>
            <a href="{{ route('supervisor.menu-items.index') }}" class="nav-link {{ Str::startsWith($routeName, 'supervisor.menu-items') ? 'active-nav-item' : '' }}" style="display: flex; align-items: center; gap: var(--space-3); padding: var(--space-3); border-radius: var(--radius-md);">
                <i class="fas fa-burger"></i>
                <span>Menu Items</span>
            </a>
            <a href="{{ route('supervisor.recipes.index') }}" class="nav-link {{ Str::startsWith($routeName, 'supervisor.recipes') ? 'active-nav-item' : '' }}" style="display: flex; align-items: center; gap: var(--space-3); padding: var(--space-3); border-radius: var(--radius-md);">
                <i class="fas fa-book"></i>
                <span>Recipes</span>
            </a>
        @endif

        @if($user->isEmployee() || $user->isAdmin())
            <a href="{{ route('employee.pos') }}" class="nav-link {{ Str::startsWith($routeName, 'employee.pos') ? 'active-nav-item' : '' }}" style="display: flex; align-items: center; gap: var(--space-3); padding: var(--space-3); border-radius: var(--radius-md);">
                <i class="fas fa-cash-register"></i>
                <span>POS</span>
            </a>
            <a href="{{ route('employee.orders.index') }}" class="nav-link {{ Str::startsWith($routeName, 'employee.orders') ? 'active-nav-item' : '' }}" style="display: flex; align-items: center; gap: var(--space-3); padding: var(--space-3); border-radius: var(--radius-md);">
                <i class="fas fa-receipt"></i>
                <span>Orders</span>
            </a>
        @endif

        <a href="{{ route('profile.edit') }}" class="nav-link {{ Str::startsWith($routeName, 'profile') ? 'active-nav-item' : '' }}" style="display: flex; align-items: center; gap: var(--space-3); padding: var(--space-3); border-radius: var(--radius-md);">
            <i class="fas fa-user"></i>
            <span>Profile</span>
        </a>
    </nav>

    <div class="card-footer" style="margin-top: auto; border-top: 1px solid var(--border-light);">
        <div class="text-xs text-secondary" style="margin-bottom: var(--space-1);">Signed in as</div>
        <div class="text-sm text-primary font-medium">{{ $user->email }}</div>
    </div>
</aside>

<style>
    .nav-link {
        transition: all var(--transition-fast);
    }
    
    .nav-link:hover {
        background-color: var(--background-light);
    }
</style>
