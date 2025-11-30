@extends('layouts.app')

@section('title', 'Profile')
@section('subtitle', 'Manage your account settings and profile information')

@section('content')
<div class="container" style="max-width: 800px;">
    <div style="display: flex; flex-direction: column; gap: var(--space-6);">
        <div class="card">
            <div class="card-header">
                <h2 class="text-lg font-bold text-primary">Profile Information</h2>
                <p class="text-sm text-secondary" style="margin-top: var(--space-1);">Update your account's profile information and email address.</p>
            </div>
            <div class="card-body">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h2 class="text-lg font-bold text-primary">Update Password</h2>
                <p class="text-sm text-secondary" style="margin-top: var(--space-1);">Ensure your account is using a long, random password to stay secure.</p>
            </div>
            <div class="card-body">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h2 class="text-lg font-bold text-primary">Delete Account</h2>
                <p class="text-sm text-secondary" style="margin-top: var(--space-1);">Once your account is deleted, all of its resources and data will be permanently deleted.</p>
            </div>
            <div class="card-body">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</div>
@endsection
