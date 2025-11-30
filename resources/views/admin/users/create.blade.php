@extends('layouts.app')

@section('title', 'Create New User')
@section('subtitle', 'Add a new user to the system')

@section('breadcrumbs')
<div class="flex items-center" style="gap: var(--space-2); font-size: var(--text-sm);">
    <a href="{{ route('admin.users.index') }}" class="text-accent font-medium flex items-center nav-link">
        <i class="fas fa-users" style="margin-right: var(--space-2);"></i>Users
    </a>
    <i class="fas fa-chevron-right text-light" style="font-size: var(--text-xs);"></i>
    <span class="text-secondary font-medium">Create New</span>
</div>
@endsection

@section('content')
<div class="container" style="max-width: 800px;">
    <!-- Form Card -->
    <div class="card">
        <div class="card-header">
            <div class="flex items-center" style="gap: var(--space-3);">
                <div style="width: 40px; height: 40px; background: var(--accent-color); border-radius: var(--radius-lg); display: flex; align-items: center; justify-content: center; box-shadow: var(--shadow-base);">
                    <i class="fas fa-user-plus" style="color: var(--primary-dark); font-size: var(--text-lg);"></i>
                </div>
                <h2 class="text-lg font-bold text-primary">User Information</h2>
            </div>
        </div>
        
        <form action="{{ route('admin.users.store') }}" method="POST" class="card-body">
            @csrf
            
            <div style="display: flex; flex-direction: column; gap: var(--space-6);">
                <!-- Name -->
                <div>
                    <label for="name" class="form-label flex items-center">
                        <i class="fas fa-user" style="margin-right: var(--space-2); color: var(--accent-color);"></i>Full Name *
                    </label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" 
                           class="form-input"
                           placeholder="Enter user's full name" required>
                    @error('name')
                        <p class="text-sm" style="color: #dc3545; margin-top: var(--space-2); display: flex; align-items: center;">
                            <i class="fas fa-exclamation-circle" style="margin-right: var(--space-1);"></i>{{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="form-label flex items-center">
                        <i class="fas fa-envelope" style="margin-right: var(--space-2); color: #28a745;"></i>Email Address *
                    </label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" 
                           class="form-input"
                           placeholder="Enter email address" required>
                    @error('email')
                        <p class="text-sm" style="color: #dc3545; margin-top: var(--space-2); display: flex; align-items: center;">
                            <i class="fas fa-exclamation-circle" style="margin-right: var(--space-1);"></i>{{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="form-label flex items-center">
                        <i class="fas fa-lock" style="margin-right: var(--space-2); color: #dc3545;"></i>Password *
                    </label>
                    <input type="password" name="password" id="password" 
                           class="form-input"
                           placeholder="Enter password" required>
                    @error('password')
                        <p class="text-sm" style="color: #dc3545; margin-top: var(--space-2); display: flex; align-items: center;">
                            <i class="fas fa-exclamation-circle" style="margin-right: var(--space-1);"></i>{{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Role -->
                <div>
                    <label for="role" class="form-label flex items-center">
                        <i class="fas fa-user-tag" style="margin-right: var(--space-2); color: #8b5cf6;"></i>Role *
                    </label>
                    <select name="role" id="role" class="form-input" required>
                        <option value="">Select Role</option>
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Administrator</option>
                        <option value="supervisor" {{ old('role') == 'supervisor' ? 'selected' : '' }}>Supervisor</option>
                        <option value="employee" {{ old('role') == 'employee' ? 'selected' : '' }}>Employee</option>
                    </select>
                    @error('role')
                        <p class="text-sm" style="color: #dc3545; margin-top: var(--space-2); display: flex; align-items: center;">
                            <i class="fas fa-exclamation-circle" style="margin-right: var(--space-1);"></i>{{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Role Descriptions -->
                <div class="card" style="background: var(--background-light); border-color: var(--border-light);">
                    <div class="card-body">
                        <h4 class="font-medium text-primary" style="margin-bottom: var(--space-2);">Role Permissions:</h4>
                        <div style="display: flex; flex-direction: column; gap: var(--space-2); font-size: var(--text-sm); color: var(--text-secondary);">
                            <div class="flex items-center">
                                <i class="fas fa-crown" style="color: #dc3545; margin-right: var(--space-2);"></i>
                                <span><strong>Admin:</strong> Full system access, user management</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-user-shield" style="color: #28a745; margin-right: var(--space-2);"></i>
                                <span><strong>Supervisor:</strong> Inventory and menu management</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-user-tie" style="color: var(--accent-color); margin-right: var(--space-2);"></i>
                                <span><strong>Employee:</strong> POS access and order processing</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex items-center justify-end" style="gap: var(--space-4); padding-top: var(--space-6); margin-top: var(--space-6); border-top: 1px solid var(--border-light);">
                <a href="{{ route('admin.users.index') }}" class="btn btn-outline">
                    <i class="fas fa-arrow-left" style="margin-right: var(--space-2);"></i>Cancel
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-user-plus" style="margin-right: var(--space-2);"></i>Create User
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
