@extends('layouts.app')

@section('title', 'Add New Menu Item')
@section('subtitle', 'Create a new menu item for your restaurant')

@section('breadcrumbs')
<div class="flex items-center" style="gap: var(--space-2); font-size: var(--text-sm);">
    <a href="{{ route('supervisor.menu-items.index') }}" class="text-accent font-medium flex items-center nav-link">
        <i class="fas fa-utensils" style="margin-right: var(--space-2);"></i>Menu Items
    </a>
    <i class="fas fa-chevron-right text-light" style="font-size: var(--text-xs);"></i>
    <span class="text-secondary font-medium">Add New</span>
</div>
@endsection

@section('content')
<div class="container" style="max-width: 800px;">
    <!-- Form Card -->
    <div class="card">
        <div class="card-header">
            <div class="flex items-center" style="gap: var(--space-3);">
                <div style="width: 40px; height: 40px; background: var(--accent-color); border-radius: var(--radius-lg); display: flex; align-items: center; justify-content: center; box-shadow: var(--shadow-base);">
                    <i class="fas fa-plus" style="color: var(--primary-dark); font-size: var(--text-lg);"></i>
                </div>
                <h2 class="text-lg font-bold text-primary">Menu Item Information</h2>
            </div>
        </div>
        
        <form action="{{ route('supervisor.menu-items.store') }}" method="POST" class="card-body">
            @csrf
            
            <div style="display: flex; flex-direction: column; gap: var(--space-6);">
                <!-- Menu Item Name -->
                <div>
                    <label for="name" class="form-label flex items-center">
                        <i class="fas fa-tag" style="margin-right: var(--space-2); color: var(--accent-color);"></i>Menu Item Name *
                    </label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" 
                           class="form-input"
                           placeholder="Enter menu item name" required>
                    @error('name')
                        <p class="text-sm" style="color: #dc3545; margin-top: var(--space-2); display: flex; align-items: center;">
                            <i class="fas fa-exclamation-circle" style="margin-right: var(--space-1);"></i>{{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Price -->
                <div>
                    <label for="price" class="form-label flex items-center">
                        <i class="fas fa-money-bill-wave" style="margin-right: var(--space-2); color: #28a745;"></i>Price *
                    </label>
                    <div style="position: relative;">
                        <div style="position: absolute; top: 50%; left: var(--space-3); transform: translateY(-50%); pointer-events: none;">
                            <span class="text-secondary font-medium">Rp</span>
                        </div>
                        <input type="number" name="price" id="price" value="{{ old('price') }}" 
                               class="form-input" style="padding-left: 3rem;"
                               min="0" step="0.01" placeholder="0.00" required>
                    </div>
                    @error('price')
                        <p class="text-sm" style="color: #dc3545; margin-top: var(--space-2); display: flex; align-items: center;">
                            <i class="fas fa-exclamation-circle" style="margin-right: var(--space-1);"></i>{{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Availability -->
                <div class="flex items-center" style="padding: var(--space-4); background: var(--background-light); border-radius: var(--radius-lg); border: 1px solid var(--border-light);">
                    <input type="checkbox" name="available" id="available" value="1" {{ old('available', true) ? 'checked' : '' }}
                           style="width: 20px; height: 20px; cursor: pointer; accent-color: var(--accent-color);">
                    <label for="available" class="form-label" style="margin: 0; margin-left: var(--space-3); cursor: pointer; display: flex; align-items: center;">
                        <i class="fas fa-toggle-on" style="margin-right: var(--space-2); color: #28a745;"></i>
                        Available for ordering
                    </label>
                </div>
                @error('available')
                    <p class="text-sm" style="color: #dc3545; margin-top: var(--space-2); display: flex; align-items: center;">
                        <i class="fas fa-exclamation-circle" style="margin-right: var(--space-1);"></i>{{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Form Actions -->
            <div class="flex items-center justify-end" style="gap: var(--space-4); padding-top: var(--space-6); margin-top: var(--space-6); border-top: 1px solid var(--border-light);">
                <a href="{{ route('supervisor.menu-items.index') }}" class="btn btn-outline">
                    <i class="fas fa-arrow-left" style="margin-right: var(--space-2);"></i>Cancel
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save" style="margin-right: var(--space-2);"></i>Create Menu Item
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
