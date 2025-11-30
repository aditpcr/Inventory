@extends('layouts.app')

@section('title', 'Edit Recipe')
@section('subtitle', 'Update recipe details and ingredients')

@section('breadcrumbs')
<div class="flex items-center" style="gap: var(--space-2); font-size: var(--text-sm);">
    <a href="{{ route('supervisor.recipes.index') }}" class="text-accent font-medium flex items-center nav-link">
        <i class="fas fa-book" style="margin-right: var(--space-2);"></i>Recipes
    </a>
    <i class="fas fa-chevron-right text-light" style="font-size: var(--text-xs);"></i>
    <span class="text-secondary font-medium">Edit</span>
</div>
@endsection

@section('content')
<div class="container" style="max-width: 1000px;">
    <!-- Form Card -->
    <div class="card">
        <div class="card-header">
            <div class="flex items-center" style="gap: var(--space-3);">
                <div style="width: 40px; height: 40px; background: var(--accent-color); border-radius: var(--radius-lg); display: flex; align-items: center; justify-content: center; box-shadow: var(--shadow-base);">
                    <i class="fas fa-edit" style="color: var(--primary-dark); font-size: var(--text-lg);"></i>
                </div>
                <h2 class="text-lg font-bold text-primary">Edit Recipe Information</h2>
            </div>
        </div>
        
        <form action="{{ route('supervisor.recipes.update', $menuItemIngredient) }}" method="POST" class="card-body">
            @csrf
            @method('PUT')
            
            <div style="display: flex; flex-direction: column; gap: var(--space-6);">
                <!-- Menu Item (Read-only) -->
                <div>
                    <label class="form-label flex items-center">
                        <i class="fas fa-utensils" style="margin-right: var(--space-2); color: var(--accent-color);"></i>Menu Item
                    </label>
                    <input type="text" value="{{ $menuItemIngredient->menuItem->name }}" 
                           class="form-input" disabled style="background: var(--background-light); opacity: 0.7;">
                </div>

                <!-- Ingredient -->
                <div>
                    <label for="ingredient_id" class="form-label flex items-center">
                        <i class="fas fa-box" style="margin-right: var(--space-2); color: #28a745;"></i>Ingredient *
                    </label>
                    <select name="ingredient_id" id="ingredient_id" class="form-input" required>
                        <option value="">Select Ingredient</option>
                        @foreach($ingredients as $ingredient)
                        <option value="{{ $ingredient->id }}" {{ old('ingredient_id', $menuItemIngredient->ingredient_id) == $ingredient->id ? 'selected' : '' }}>
                            {{ $ingredient->name }} ({{ $ingredient->stock_quantity }} {{ $ingredient->unit }})
                        </option>
                        @endforeach
                    </select>
                    @error('ingredient_id')
                        <p class="text-sm" style="color: #dc3545; margin-top: var(--space-2); display: flex; align-items: center;">
                            <i class="fas fa-exclamation-circle" style="margin-right: var(--space-1);"></i>{{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Quantity Needed -->
                <div>
                    <label for="quantity_needed" class="form-label flex items-center">
                        <i class="fas fa-balance-scale" style="margin-right: var(--space-2); color: #8b5cf6;"></i>Quantity Needed *
                    </label>
                    <input type="number" name="quantity_needed" id="quantity_needed" value="{{ old('quantity_needed', $menuItemIngredient->quantity_needed) }}" 
                           class="form-input"
                           min="0" step="0.01" placeholder="0.00" required>
                    @error('quantity_needed')
                        <p class="text-sm" style="color: #dc3545; margin-top: var(--space-2); display: flex; align-items: center;">
                            <i class="fas fa-exclamation-circle" style="margin-right: var(--space-1);"></i>{{ $message }}
                        </p>
                    @enderror
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex items-center justify-end" style="gap: var(--space-4); padding-top: var(--space-6); margin-top: var(--space-6); border-top: 1px solid var(--border-light);">
                <a href="{{ route('supervisor.recipes.index') }}" class="btn btn-outline">
                    <i class="fas fa-times" style="margin-right: var(--space-2);"></i>Cancel
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save" style="margin-right: var(--space-2);"></i>Update Recipe
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
