@extends('layouts.app')

@section('title', 'User Management')
@section('subtitle', 'Manage system users and roles')

@section('breadcrumbs')
<div class="flex items-center" style="gap: var(--space-2); font-size: var(--text-sm);">
    <span class="text-secondary font-medium">User Management</span>
</div>
@endsection

@section('actions')
<div class="flex items-center" style="gap: var(--space-3);">
    <a href="{{ route('admin.role-requests.index') }}" class="btn" style="background: #ffc107; color: white; border: none;">
        <i class="fas fa-user-shield" style="margin-right: var(--space-2);"></i>Role Requests
        @php
            $pendingCount = \App\Models\RoleRequest::where('status', 'pending')->count();
        @endphp
        @if($pendingCount > 0)
            <span class="badge" style="background: #dc3545; color: white; margin-left: var(--space-2); padding: 2px 6px; border-radius: 10px; font-size: 11px;">{{ $pendingCount }}</span>
        @endif
    </a>
    <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
        <i class="fas fa-plus" style="margin-right: var(--space-2);"></i>Add New User
    </a>
</div>
@endsection

@section('content')
<div class="container">
    <!-- Header Stats -->
    <div class="grid" style="grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: var(--space-6); margin-bottom: var(--space-8);">
        <div class="card">
            <div class="card-body">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-secondary font-medium">Total Users</p>
                        <p class="text-3xl font-bold text-primary" style="margin-top: var(--space-2);">{{ $users->count() }}</p>
                    </div>
                    <div style="width: 48px; height: 48px; background: var(--accent-color); border-radius: var(--radius-lg); display: flex; align-items: center; justify-content: center; box-shadow: var(--shadow-base);">
                        <i class="fas fa-users" style="color: white; font-size: var(--text-xl);"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-secondary font-medium">Admins</p>
                        <p class="text-3xl font-bold text-primary" style="margin-top: var(--space-2);">{{ $users->where('role', 'admin')->count() }}</p>
                    </div>
                    <div style="width: 48px; height: 48px; background: #dc3545; border-radius: var(--radius-lg); display: flex; align-items: center; justify-content: center; box-shadow: var(--shadow-base);">
                        <i class="fas fa-crown" style="color: white; font-size: var(--text-xl);"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-secondary font-medium">Supervisors</p>
                        <p class="text-3xl font-bold text-primary" style="margin-top: var(--space-2);">{{ $users->where('role', 'supervisor')->count() }}</p>
                    </div>
                    <div style="width: 48px; height: 48px; background: #28a745; border-radius: var(--radius-lg); display: flex; align-items: center; justify-content: center; box-shadow: var(--shadow-base);">
                        <i class="fas fa-user-shield" style="color: white; font-size: var(--text-xl);"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-secondary font-medium">Employees</p>
                        <p class="text-3xl font-bold text-primary" style="margin-top: var(--space-2);">{{ $users->where('role', 'employee')->count() }}</p>
                    </div>
                    <div style="width: 48px; height: 48px; background: #f59e0b; border-radius: var(--radius-lg); display: flex; align-items: center; justify-content: center; box-shadow: var(--shadow-base);">
                        <i class="fas fa-user-tie" style="color: white; font-size: var(--text-xl);"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Users Table -->
    <div class="card">
        <div class="card-header">
            <div class="flex items-center justify-between">
                <div class="flex items-center" style="gap: var(--space-3);">
                    <div style="width: 40px; height: 40px; background: var(--accent-color); border-radius: var(--radius-lg); display: flex; align-items: center; justify-content: center; box-shadow: var(--shadow-base);">
                        <i class="fas fa-users" style="color: white; font-size: var(--text-lg);"></i>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-primary">All Users</h2>
                        <p class="text-sm text-secondary">Manage system users and permissions</p>
                    </div>
                </div>
            </div>
        </div>

        <div style="overflow-x: auto;">
            <table class="table">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>
                            <div class="flex items-center">
                                <div style="width: 40px; height: 40px; background: var(--accent-color); border-radius: var(--radius-lg); display: flex; align-items: center; justify-content: center; margin-right: var(--space-3); box-shadow: var(--shadow-base);">
                                    <span style="color: white; font-weight: var(--font-weight-medium); font-size: var(--text-sm);">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </span>
                                </div>
                                <div>
                                    <span class="font-bold text-primary block">{{ $user->name }}</span>
                                    <span class="text-xs text-secondary">ID: {{ $user->id }}</span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="text-sm font-medium text-primary">{{ $user->email }}</span>
                        </td>
                        <td>
                            @if($user->role === 'admin')
                            <span class="badge badge-danger">
                                <i class="fas fa-crown" style="margin-right: var(--space-1);"></i> Admin
                            </span>
                            @elseif($user->role === 'supervisor')
                            <span class="badge badge-success">
                                <i class="fas fa-user-shield" style="margin-right: var(--space-1);"></i> Supervisor
                            </span>
                            @else
                            <span class="badge badge-info">
                                <i class="fas fa-user-tie" style="margin-right: var(--space-1);"></i> Employee
                            </span>
                            @endif
                        </td>
                        <td>
                            <span class="badge badge-success">
                                <i class="fas fa-check-circle" style="margin-right: var(--space-1);"></i> Active
                            </span>
                        </td>
                        <td>
                            <div class="flex items-center" style="gap: var(--space-2);">
                                <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-primary" style="padding: var(--space-2) var(--space-3);">
                                    <i class="fas fa-edit" style="font-size: var(--text-sm);"></i>
                                </a>
                                <form action="{{ route('admin.users.reset-password', $user) }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn" style="padding: var(--space-2) var(--space-3); background: #28a745; color: white; border: none;">
                                        <i class="fas fa-key" style="font-size: var(--text-sm);"></i>
                                    </button>
                                </form>
                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            onclick="return confirm('Are you sure you want to delete {{ $user->name }}?')"
                                            class="btn" style="padding: var(--space-2) var(--space-3); background: #dc3545; color: white; border: none;">
                                        <i class="fas fa-trash" style="font-size: var(--text-sm);"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if($users->isEmpty())
        <div class="card-body text-center" style="padding: var(--space-16);">
            <div style="width: 96px; height: 96px; background: var(--background-light); border-radius: var(--radius-xl); display: flex; align-items: center; justify-content: center; margin: 0 auto var(--space-4); box-shadow: var(--shadow-base);">
                <i class="fas fa-users" style="color: var(--text-light); font-size: var(--text-3xl);"></i>
            </div>
            <h3 class="text-xl font-bold text-primary" style="margin-bottom: var(--space-2);">No users found</h3>
            <p class="text-secondary" style="margin-bottom: var(--space-6); max-width: 400px; margin-left: auto; margin-right: auto;">Start by creating the first user for your system.</p>
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
                <i class="fas fa-plus" style="margin-right: var(--space-2);"></i>Create First User
            </a>
        </div>
        @endif
    </div>
</div>
@endsection
