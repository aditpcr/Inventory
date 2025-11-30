@extends('layouts.app')

@section('title', $menuItem->name)
@section('subtitle', 'Menu item details and information')

@section('breadcrumbs')
<div class="flex items-center" style="gap: var(--space-2); font-size: var(--text-sm);">
    <a href="{{ route('supervisor.menu-items.index') }}" class="text-accent font-medium flex items-center nav-link">
        <i class="fas fa-utensils" style="margin-right: var(--space-2);"></i>Menu Items
    </a>
    <i class="fas fa-chevron-right text-light" style="font-size: var(--text-xs);"></i>
    <span class="text-secondary font-medium">{{ $menuItem->name }}</span>
</div>
@endsection

@section('actions')
<a href="{{ route('supervisor.menu-items.edit', $menuItem) }}" class="btn btn-primary">
    <i class="fas fa-edit" style="margin-right: var(--space-2);"></i>Edit
</a>
@endsection

@section('content')
<div class="container">
    <div class="grid" style="grid-template-columns: 1fr; gap: var(--space-6);">
        @if(true)
        <div style="grid-column: 1 / -1;">
            <div class="card">
                <div class="card-header">
                    <h2 class="text-xl font-bold text-primary">Menu Item Details</h2>
                </div>
                
                <div class="card-body" style="display: flex; flex-direction: column; gap: var(--space-6);">
                    <!-- Header -->
                    <div class="flex items-center" style="gap: var(--space-4);">
                        <div style="width: 64px; height: 64px; background: var(--accent-color); border-radius: var(--radius-xl); display: flex; align-items: center; justify-content: center; box-shadow: var(--shadow-base);">
                            <i class="fas fa-utensils" style="color: var(--primary-dark); font-size: var(--text-2xl);"></i>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-primary">{{ $menuItem->name }}</h2>
                            <p class="text-secondary">Menu Item • ID: {{ $menuItem->id }}</p>
                        </div>
                    </div>

                    <!-- Stats -->
                    <div class="grid" style="grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: var(--space-6);">
                        <div class="card" style="background: rgba(58, 134, 255, 0.1); border-color: rgba(58, 134, 255, 0.3);">
                            <div class="card-body">
                                <p class="text-sm font-medium text-secondary" style="margin-bottom: var(--space-2);">Price</p>
                                <p class="text-3xl font-bold text-primary">Rp {{ number_format($menuItem->price, 0, ',', '.') }}</p>
                            </div>
                        </div>
                        
                        <div class="card" style="background: {{ $menuItem->available ? 'rgba(40, 167, 69, 0.1)' : 'rgba(220, 53, 69, 0.1)' }}; border-color: {{ $menuItem->available ? 'rgba(40, 167, 69, 0.3)' : 'rgba(220, 53, 69, 0.3)' }};">
                            <div class="card-body">
                                <p class="text-sm font-medium text-secondary" style="margin-bottom: var(--space-2);">Status</p>
                                <p class="text-3xl font-bold text-primary">
                                    {{ $menuItem->available ? 'Available' : 'Unavailable' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Status Alert -->
                    <div class="card" style="background: {{ $menuItem->available ? 'rgba(40, 167, 69, 0.1)' : 'rgba(220, 53, 69, 0.1)' }}; border: 2px solid {{ $menuItem->available ? 'rgba(40, 167, 69, 0.3)' : 'rgba(220, 53, 69, 0.3)' }};">
                        <div class="card-body">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center" style="gap: var(--space-4);">
                                    <div style="width: 48px; height: 48px; background: {{ $menuItem->available ? '#28a745' : '#dc3545' }}; border-radius: var(--radius-lg); display: flex; align-items: center; justify-content: center; box-shadow: var(--shadow-base);">
                                        <i class="fas {{ $menuItem->available ? 'fa-check-circle' : 'fa-times-circle' }}" style="color: white; font-size: var(--text-xl);"></i>
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-primary" style="font-size: var(--text-lg);">
                                            {{ $menuItem->available ? 'Available for Ordering' : 'Currently Unavailable' }}
                                        </h3>
                                        <p class="text-secondary">
                                            {{ $menuItem->available ? 'This item can be ordered by customers' : 'This item is temporarily unavailable for ordering' }}
                                        </p>
                                    </div>
                                </div>
                                @if(!$menuItem->available)
                                <div>
                                    <i class="fas fa-bell" style="color: #dc3545; font-size: var(--text-2xl);"></i>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Quick Actions & Info -->
        <div style="display: flex; flex-direction: column; gap: var(--space-6);">
            <!-- Quick Actions -->
            <div class="card">
                <div class="card-header">
                    <h2 class="text-lg font-bold text-primary">Quick Actions</h2>
                </div>
                <div class="card-body" style="display: flex; flex-direction: column; gap: var(--space-3);">
                    <form action="{{ route('supervisor.menu-items.toggle-availability', $menuItem) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn w-full" style="background: {{ $menuItem->available ? 'var(--accent-color)' : '#28a745' }}; color: var(--primary-dark); border: none;">
                            <i class="fas fa-toggle-{{ $menuItem->available ? 'on' : 'off' }}" style="margin-right: var(--space-2);"></i>
                            {{ $menuItem->available ? 'Disable Item' : 'Enable Item' }}
                        </button>
                    </form>
                    
                    <a href="{{ route('supervisor.menu-items.edit', $menuItem) }}" class="btn btn-primary w-full">
                        <i class="fas fa-edit" style="margin-right: var(--space-2);"></i>Edit Details
                    </a>
                    
                    <form action="{{ route('supervisor.menu-items.destroy', $menuItem) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                onclick="return confirm('Are you sure you want to delete {{ $menuItem->name }}?')"
                                class="btn w-full" style="background: #dc3545; color: white; border: none;">
                            <i class="fas fa-trash" style="margin-right: var(--space-2);"></i>Delete Menu Item
                        </button>
                    </form>
                </div>
            </div>

            <!-- Additional Information -->
            <div class="card">
                <div class="card-header">
                    <h2 class="text-lg font-bold text-primary">Additional Information</h2>
                </div>
                <div class="card-body" style="display: flex; flex-direction: column; gap: var(--space-4);">
                    <div class="flex justify-between items-center">
                        <span class="text-secondary font-medium">Item ID:</span>
                        <span class="font-bold text-primary">{{ $menuItem->id }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-secondary font-medium">Created:</span>
                        <span class="font-bold text-primary">{{ $menuItem->created_at->format('M j, Y') }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-secondary font-medium">Last Updated:</span>
                        <span class="font-bold text-primary">{{ $menuItem->updated_at->format('M j, Y') }}</span>
                    </div>
                </div>
            </div>

            <!-- Price History -->
            <div class="card">
                <div class="card-header">
                    <h2 class="text-lg font-bold text-primary">Pricing</h2>
                </div>
                <div class="card-body text-center">
                    <p class="text-3xl font-bold text-primary" style="margin-bottom: var(--space-2);">Rp {{ number_format($menuItem->price, 0, ',', '.') }}</p>
                    <p class="text-sm text-secondary">Current price</p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    @media (min-width: 1024px) {
        .container > .grid {
            grid-template-columns: 2fr 1fr;
        }
    }
</style>
@endsection
