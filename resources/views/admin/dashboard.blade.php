@extends('layouts.app')

@section('title', 'Admin Dashboard')
@section('subtitle', 'Manage users, roles, and system settings')

@section('content')
<div class="container">
    <!-- Quick Stats -->
    <div class="grid" style="grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: var(--space-6); margin-bottom: var(--space-8);">
        <!-- Total Users -->
        <div class="card">
            <div class="card-body">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-secondary font-medium">Total Users</p>
                        <p class="text-3xl font-bold text-primary" style="margin-top: var(--space-2);">{{ \App\Models\User::count() }}</p>
                    </div>
                    <div style="width: 48px; height: 48px; background: var(--accent-color); border-radius: var(--radius-lg); display: flex; align-items: center; justify-content: center; box-shadow: var(--shadow-base);">
                        <i class="fas fa-users" style="color: white; font-size: var(--text-xl);"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Role Requests -->
        @php
            $pendingRequests = \App\Models\RoleRequest::where('status', 'pending')->count();
        @endphp
        <div class="card">
            <div class="card-body">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-secondary font-medium">Pending Role Requests</p>
                        <p class="text-3xl font-bold text-primary" style="margin-top: var(--space-2);">{{ $pendingRequests }}</p>
                    </div>
                    <div style="width: 48px; height: 48px; background: #ffc107; border-radius: var(--radius-lg); display: flex; align-items: center; justify-content: center; box-shadow: var(--shadow-base);">
                        <i class="fas fa-user-shield" style="color: white; font-size: var(--text-xl);"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Admins -->
        <div class="card">
            <div class="card-body">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-secondary font-medium">Admins</p>
                        <p class="text-3xl font-bold text-primary" style="margin-top: var(--space-2);">{{ \App\Models\User::where('role', 'admin')->count() }}</p>
                    </div>
                    <div style="width: 48px; height: 48px; background: #dc3545; border-radius: var(--radius-lg); display: flex; align-items: center; justify-content: center; box-shadow: var(--shadow-base);">
                        <i class="fas fa-crown" style="color: white; font-size: var(--text-xl);"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Users -->
        @php
            $pendingUsers = \App\Models\User::where('role_status', 'pending')->count();
        @endphp
        <div class="card">
            <div class="card-body">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-secondary font-medium">Pending Users</p>
                        <p class="text-3xl font-bold text-primary" style="margin-top: var(--space-2);">{{ $pendingUsers }}</p>
                    </div>
                    <div style="width: 48px; height: 48px; background: #6c757d; border-radius: var(--radius-lg); display: flex; align-items: center; justify-content: center; box-shadow: var(--shadow-base);">
                        <i class="fas fa-user-clock" style="color: white; font-size: var(--text-xl);"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="card" style="margin-bottom: var(--space-8);">
        <div class="card-header">
            <div class="flex items-center" style="gap: var(--space-4);">
                <div style="width: 50px; height: 50px; border-radius: var(--radius-lg); display: flex; align-items: center; justify-content: center; font-size: var(--text-xl); color: white; background: var(--accent-color); box-shadow: var(--shadow-md);">
                    <i class="fas fa-bolt"></i>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-primary">Quick Actions</h2>
                    <p class="text-sm text-secondary">Manage your system efficiently</p>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="grid" style="grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: var(--space-4);">
                <!-- Role Requests -->
                <a href="{{ route('admin.role-requests.index') }}" class="card" style="text-decoration: none; text-align: center; transition: all var(--transition-base); border: 2px solid {{ $pendingRequests > 0 ? '#ffc107' : 'var(--border-light)' }};">
                    <div class="card-body">
                        <div style="width: 60px; height: 60px; border-radius: var(--radius-lg); display: flex; align-items: center; justify-content: center; font-size: var(--text-2xl); color: white; background: {{ $pendingRequests > 0 ? '#ffc107' : 'var(--accent-color)' }}; margin: 0 auto var(--space-4); transition: all var(--transition-base); box-shadow: var(--shadow-md);">
                            <i class="fas fa-user-shield"></i>
                        </div>
                        <h3 class="text-lg font-medium text-primary" style="margin-bottom: var(--space-2);">Role Requests</h3>
                        <p class="text-sm text-secondary" style="margin-bottom: var(--space-2);">Review and approve role access requests</p>
                        @if($pendingRequests > 0)
                            <span class="badge" style="background: #dc3545; color: white; padding: 4px 8px; border-radius: 12px; font-size: 12px; font-weight: bold;">
                                {{ $pendingRequests }} Pending
                            </span>
                        @else
                            <span class="badge" style="background: #28a745; color: white; padding: 4px 8px; border-radius: 12px; font-size: 12px;">
                                All Clear
                            </span>
                        @endif
                    </div>
                </a>

                <!-- User Management -->
                <a href="{{ route('admin.users.index') }}" class="card" style="text-decoration: none; text-align: center; transition: all var(--transition-base);">
                    <div class="card-body">
                        <div style="width: 60px; height: 60px; border-radius: var(--radius-lg); display: flex; align-items: center; justify-content: center; font-size: var(--text-2xl); color: var(--accent-color); background: rgba(58, 134, 255, 0.1); margin: 0 auto var(--space-4); transition: all var(--transition-base);">
                            <i class="fas fa-users-gear"></i>
                        </div>
                        <h3 class="text-lg font-medium text-primary" style="margin-bottom: var(--space-2);">User Management</h3>
                        <p class="text-sm text-secondary">Manage system users and roles</p>
                    </div>
                </a>

                <!-- Add New User -->
                <a href="{{ route('admin.users.create') }}" class="card" style="text-decoration: none; text-align: center; transition: all var(--transition-base);">
                    <div class="card-body">
                        <div style="width: 60px; height: 60px; border-radius: var(--radius-lg); display: flex; align-items: center; justify-content: center; font-size: var(--text-2xl); color: var(--accent-color); background: rgba(58, 134, 255, 0.1); margin: 0 auto var(--space-4); transition: all var(--transition-base);">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <h3 class="text-lg font-medium text-primary" style="margin-bottom: var(--space-2);">Add New User</h3>
                        <p class="text-sm text-secondary">Create a new user account</p>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <!-- Recent Activity / Alerts -->
    @if($pendingRequests > 0 || $pendingUsers > 0)
    <div class="card">
        <div class="card-header">
            <div class="flex items-center" style="gap: var(--space-4);">
                <div style="width: 50px; height: 50px; border-radius: var(--radius-lg); display: flex; align-items: center; justify-content: center; font-size: var(--text-xl); color: white; background: #ffc107; box-shadow: var(--shadow-md);">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-primary">Action Required</h2>
                    <p class="text-sm text-secondary">Items requiring your attention</p>
                </div>
            </div>
        </div>

        <div class="card-body">
            @if($pendingRequests > 0)
            <div class="card" style="margin-bottom: var(--space-4); background: rgba(255, 193, 7, 0.1); border: 1px solid rgba(255, 193, 7, 0.3);">
                <div class="card-body">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center" style="gap: var(--space-4);">
                            <div style="width: 50px; height: 50px; border-radius: var(--radius-lg); display: flex; align-items: center; justify-content: center; font-size: var(--text-xl); color: white; background: #ffc107;">
                                <i class="fas fa-user-shield"></i>
                            </div>
                            <div>
                                <h4 class="text-lg font-medium text-primary" style="margin-bottom: var(--space-1);">{{ $pendingRequests }} Pending Role Request(s)</h4>
                                <p class="text-sm text-secondary">Users are waiting for role approval</p>
                            </div>
                        </div>
                        <a href="{{ route('admin.role-requests.index') }}" class="btn" style="background: #ffc107; color: white; border: none;">
                            <i class="fas fa-arrow-right" style="margin-right: var(--space-2);"></i>Review Requests
                        </a>
                    </div>
                </div>
            </div>
            @endif

            @if($pendingUsers > 0)
            <div class="card" style="background: rgba(108, 117, 125, 0.1); border: 1px solid rgba(108, 117, 125, 0.3);">
                <div class="card-body">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center" style="gap: var(--space-4);">
                            <div style="width: 50px; height: 50px; border-radius: var(--radius-lg); display: flex; align-items: center; justify-content: center; font-size: var(--text-xl); color: white; background: #6c757d;">
                                <i class="fas fa-user-clock"></i>
                            </div>
                            <div>
                                <h4 class="text-lg font-medium text-primary" style="margin-bottom: var(--space-1);">{{ $pendingUsers }} User(s) Awaiting Role</h4>
                                <p class="text-sm text-secondary">Users have requested roles but are still pending</p>
                            </div>
                        </div>
                        <a href="{{ route('admin.users.index') }}" class="btn" style="background: #6c757d; color: white; border: none;">
                            <i class="fas fa-arrow-right" style="margin-right: var(--space-2);"></i>View Users
                        </a>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
    @else
    <!-- All Clear -->
    <div class="card">
        <div class="card-header">
            <div class="flex items-center" style="gap: var(--space-4);">
                <div style="width: 50px; height: 50px; border-radius: var(--radius-lg); display: flex; align-items: center; justify-content: center; font-size: var(--text-xl); color: white; background: #28a745; box-shadow: var(--shadow-md);">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-primary">System Status</h2>
                    <p class="text-sm text-secondary">All systems operational</p>
                </div>
            </div>
        </div>

        <div class="card-body text-center" style="padding: var(--space-12);">
            <div style="width: 80px; height: 80px; border-radius: var(--radius-xl); display: flex; align-items: center; justify-content: center; font-size: var(--text-3xl); color: white; background: #28a745; margin: 0 auto var(--space-6); box-shadow: var(--shadow-lg);">
                <i class="fas fa-check"></i>
            </div>
            <h3 class="text-2xl font-bold text-primary" style="margin-bottom: var(--space-2);">All Clear!</h3>
            <p class="text-secondary" style="max-width: 400px; margin: 0 auto;">No pending requests or actions required at this time.</p>
        </div>
    </div>
    @endif
</div>

<style>
    .card:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }
    
    .card a:hover {
        background: var(--accent-color);
        color: white;
    }
    
    .card a:hover .text-primary,
    .card a:hover .text-secondary {
        color: white;
    }
    
    .card a:hover div[style*="background: rgba(58, 134, 255, 0.1)"] {
        background: rgba(255, 255, 255, 0.2) !important;
        color: white;
    }
</style>
@endsection

