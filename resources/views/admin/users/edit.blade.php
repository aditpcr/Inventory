@extends('layouts.app')

@section('title', 'Edit ' . $user->name)
@section('subtitle', 'Update user information and role')

@section('breadcrumbs')
<div class="flex items-center" style="gap: var(--space-2); font-size: var(--text-sm);">
    <a href="{{ route('admin.users.index') }}" class="text-accent font-medium flex items-center nav-link">
        <i class="fas fa-users" style="margin-right: var(--space-2);"></i>Users
    </a>
    <i class="fas fa-chevron-right text-light" style="font-size: var(--text-xs);"></i>
    <a href="#" class="text-accent font-medium nav-link">{{ $user->name }}</a>
    <i class="fas fa-chevron-right text-light" style="font-size: var(--text-xs);"></i>
    <span class="text-secondary font-medium">Edit</span>
</div>
@endsection

@section('content')
<div class="container" style="max-width: 800px;">
    <!-- Form Card -->
    <div class="card">
        <div class="card-header">
            <div class="flex items-center" style="gap: var(--space-3);">
                <div style="width: 40px; height: 40px; background: var(--accent-color); border-radius: var(--radius-lg); display: flex; align-items: center; justify-content: center; box-shadow: var(--shadow-base);">
                    <i class="fas fa-user-edit" style="color: var(--primary-dark); font-size: var(--text-lg);"></i>
                </div>
                <h2 class="text-lg font-bold text-primary">Edit User Information</h2>
            </div>
        </div>
        
        <form action="{{ route('admin.users.update', $user) }}" method="POST" class="card-body">
            @csrf
            @method('PUT')
            
            <div style="display: flex; flex-direction: column; gap: var(--space-6);">
                <!-- Name -->
                <div>
                    <label for="name" class="form-label flex items-center">
                        <i class="fas fa-user" style="margin-right: var(--space-2); color: var(--accent-color);"></i>Full Name *
                    </label>
                    <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" 
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
                    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" 
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
                        <i class="fas fa-lock" style="margin-right: var(--space-2); color: #dc3545;"></i>Password
                    </label>
                    <input type="password" name="password" id="password" 
                           class="form-input"
                           placeholder="Leave blank to keep current password">
                    <p class="text-sm text-secondary" style="margin-top: var(--space-2); display: flex; align-items: center;">
                        <i class="fas fa-info-circle" style="margin-right: var(--space-2); color: var(--accent-color);"></i>Only enter if you want to change the password
                    </p>
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
                        <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Administrator</option>
                        <option value="supervisor" {{ old('role', $user->role) == 'supervisor' ? 'selected' : '' }}>Supervisor</option>
                        <option value="employee" {{ old('role', $user->role) == 'employee' ? 'selected' : '' }}>Employee</option>
                    </select>
                    @error('role')
                        <p class="text-sm" style="color: #dc3545; margin-top: var(--space-2); display: flex; align-items: center;">
                            <i class="fas fa-exclamation-circle" style="margin-right: var(--space-1);"></i>{{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Current User Info -->
                <div class="card" style="background: rgba(58, 134, 255, 0.1); border-color: rgba(58, 134, 255, 0.3);">
                    <div class="card-body">
                        <h4 class="font-medium text-primary" style="margin-bottom: var(--space-2); display: flex; align-items: center;">
                            <i class="fas fa-info-circle" style="color: var(--accent-color); margin-right: var(--space-2);"></i>Current Information
                        </h4>
                        <div class="grid" style="grid-template-columns: repeat(2, 1fr); gap: var(--space-4); font-size: var(--text-sm);">
                            <div>
                                <span class="text-secondary">Current Role:</span>
                                <span class="font-medium text-primary" style="text-transform: capitalize; margin-left: var(--space-2);">{{ $user->role }}</span>
                            </div>
                            <div>
                                <span class="text-secondary">Member Since:</span>
                                <span class="font-medium text-primary" style="margin-left: var(--space-2);">{{ $user->created_at->format('M j, Y') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex items-center justify-end" style="gap: var(--space-4); padding-top: var(--space-6); margin-top: var(--space-6); border-top: 1px solid var(--border-light);">
                <a href="{{ route('admin.users.index') }}" class="btn btn-outline">
                    <i class="fas fa-times" style="margin-right: var(--space-2);"></i>Cancel
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save" style="margin-right: var(--space-2);"></i>Update User
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
