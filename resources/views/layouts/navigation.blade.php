<nav class="navbar">
    <div class="container">
        <a href="{{ route('dashboard') }}" class="flex items-center" style="text-decoration: none; gap: var(--space-3);">
            <div style="width: 40px; height: 40px; background: var(--accent-color); border-radius: var(--radius-lg); display: flex; align-items: center; justify-content: center; box-shadow: var(--shadow-base);">
                <i class="fas fa-utensils" style="color: var(--primary-dark);"></i>
            </div>
            <span class="text-lg font-bold text-primary">Restaurant MS</span>
        </a>
        
        @auth
        <div class="flex items-center" style="gap: var(--space-4);">
            <span class="text-sm text-secondary">
                {{ Auth::user()->name }} ({{ Auth::user()->role }})
            </span>
            
            <!-- Quick Links -->
            <div class="nav-links">
                @if(auth()->user()->isAdmin())
                <a class="nav-link" href="{{ route('admin.users.index') }}">Users</a>
                @endif
                
                @if(auth()->user()->isSupervisor() || auth()->user()->isAdmin())
                <a class="nav-link" href="{{ route('supervisor.dashboard') }}">Supervisor</a>
                @endif
                
                @if(auth()->user()->isEmployee())
                <a class="nav-link" href="{{ route('employee.pos') }}">POS</a>
                @endif
            </div>
            
            <!-- Logout -->
            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                @csrf
                <button type="submit" class="btn btn-outline">Logout</button>
            </form>
        </div>
        @endauth
    </div>
</nav>
