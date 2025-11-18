<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ route('dashboard') }}">Restaurant MS</a>
        
        @auth
        <div class="navbar-nav ms-auto">
            <span class="navbar-text me-3">
                {{ Auth::user()->name }} ({{ Auth::user()->role }})
            </span>
            
            <!-- Quick Links -->
            <div class="navbar-nav">
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
            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-outline-light btn-sm">Logout</button>
            </form>
        </div>
        @endauth
    </div>
</nav> 