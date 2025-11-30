@extends('layouts.app')

@section('title', 'Edit ' . $ingredient->name)
@section('subtitle', 'Update ingredient details and stock information')

@section('breadcrumbs')
<div class="flex items-center" style="gap: var(--space-2); font-size: var(--text-sm);">
    <a href="{{ route('supervisor.ingredients.index') }}" class="text-accent font-medium flex items-center nav-link">
        <i class="fas fa-boxes" style="margin-right: var(--space-2);"></i>Ingredients
    </a>
    <i class="fas fa-chevron-right text-light" style="font-size: var(--text-xs);"></i>
    <a href="{{ route('supervisor.ingredients.show', $ingredient) }}" class="text-accent font-medium nav-link">{{ $ingredient->name }}</a>
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
                    <i class="fas fa-edit" style="color: var(--primary-dark); font-size: var(--text-lg);"></i>
                </div>
                <h2 class="text-lg font-bold text-primary">Edit Ingredient Information</h2>
            </div>
        </div>
        
        <form action="{{ route('supervisor.ingredients.update', $ingredient) }}" method="POST" class="card-body">
            @csrf
            @method('PUT')
            
            <div class="grid" style="grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: var(--space-6);">
                <!-- Ingredient Name -->
                <div style="grid-column: 1 / -1;">
                    <label for="name" class="form-label flex items-center">
                        <i class="fas fa-tag" style="margin-right: var(--space-2); color: var(--accent-color);"></i>Ingredient Name *
                    </label>
                    <input type="text" name="name" id="name" value="{{ old('name', $ingredient->name) }}" 
                           class="form-input"
                           placeholder="Enter ingredient name" required>
                    @error('name')
                        <p class="text-sm" style="color: #dc3545; margin-top: var(--space-2); display: flex; align-items: center;">
                            <i class="fas fa-exclamation-circle" style="margin-right: var(--space-1);"></i>{{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Current Stock -->
                <div>
                    <label for="stock_quantity" class="form-label flex items-center">
                        <i class="fas fa-boxes" style="margin-right: var(--space-2); color: #28a745;"></i>Current Stock *
                    </label>
                    <input type="number" name="stock_quantity" id="stock_quantity" value="{{ old('stock_quantity', $ingredient->stock_quantity) }}" 
                           class="form-input"
                           min="0" step="0.01" required>
                    @error('stock_quantity')
                        <p class="text-sm" style="color: #dc3545; margin-top: var(--space-2); display: flex; align-items: center;">
                            <i class="fas fa-exclamation-circle" style="margin-right: var(--space-1);"></i>{{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Unit -->
                <div>
                    <label for="unit" class="form-label flex items-center">
                        <i class="fas fa-balance-scale" style="margin-right: var(--space-2); color: #8b5cf6;"></i>Unit *
                    </label>
                    <select name="unit" id="unit" class="form-input" required>
                        <option value="">Select Unit</option>
                        <option value="kg" {{ old('unit', $ingredient->unit) == 'kg' ? 'selected' : '' }}>Kilogram (kg)</option>
                        <option value="g" {{ old('unit', $ingredient->unit) == 'g' ? 'selected' : '' }}>Gram (g)</option>
                        <option value="l" {{ old('unit', $ingredient->unit) == 'l' ? 'selected' : '' }}>Liter (l)</option>
                        <option value="ml" {{ old('unit', $ingredient->unit) == 'ml' ? 'selected' : '' }}>Milliliter (ml)</option>
                        <option value="pcs" {{ old('unit', $ingredient->unit) == 'pcs' ? 'selected' : '' }}>Pieces (pcs)</option>
                    </select>
                    @error('unit')
                        <p class="text-sm" style="color: #dc3545; margin-top: var(--space-2); display: flex; align-items: center;">
                            <i class="fas fa-exclamation-circle" style="margin-right: var(--space-1);"></i>{{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Low Stock Threshold -->
                <div style="grid-column: 1 / -1;">
                    <label for="low_stock_threshold" class="form-label flex items-center">
                        <i class="fas fa-exclamation-triangle" style="margin-right: var(--space-2); color: #f59e0b;"></i>Low Stock Threshold *
                    </label>
                    <input type="number" name="low_stock_threshold" id="low_stock_threshold" value="{{ old('low_stock_threshold', $ingredient->low_stock_threshold) }}" 
                           class="form-input"
                           min="0" step="0.01" required>
                    <p class="text-sm text-secondary" style="margin-top: var(--space-2); display: flex; align-items: center;">
                        <i class="fas fa-info-circle" style="margin-right: var(--space-2); color: var(--accent-color);"></i>Alert will trigger when stock falls below this level
                    </p>
                    @error('low_stock_threshold')
                        <p class="text-sm" style="color: #dc3545; margin-top: var(--space-2); display: flex; align-items: center;">
                            <i class="fas fa-exclamation-circle" style="margin-right: var(--space-1);"></i>{{ $message }}
                        </p>
                    @enderror
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex items-center justify-end" style="gap: var(--space-4); padding-top: var(--space-6); margin-top: var(--space-6); border-top: 1px solid var(--border-light);">
                <a href="{{ route('supervisor.ingredients.show', $ingredient) }}" class="btn btn-outline">
                    <i class="fas fa-times" style="margin-right: var(--space-2);"></i>Cancel
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save" style="margin-right: var(--space-2);"></i>Update Ingredient
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
