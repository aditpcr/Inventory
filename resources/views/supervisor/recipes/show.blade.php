@extends('layouts.app')

@section('title', 'Recipe Details')
@section('subtitle', 'Recipe details and ingredients')

@section('breadcrumbs')
<div class="flex items-center" style="gap: var(--space-2); font-size: var(--text-sm);">
    <a href="{{ route('supervisor.recipes.index') }}" class="text-accent font-medium flex items-center nav-link">
        <i class="fas fa-book" style="margin-right: var(--space-2);"></i>Recipes
    </a>
    <i class="fas fa-chevron-right text-light" style="font-size: var(--text-xs);"></i>
    <span class="text-secondary font-medium">Details</span>
</div>
@endsection

@section('actions')
<a href="{{ route('supervisor.recipes.edit', $menuItemIngredient) }}" class="btn btn-primary">
    <i class="fas fa-edit" style="margin-right: var(--space-2);"></i>Edit
</a>
@endsection

@section('content')
<div class="container">
    <div class="grid" style="grid-template-columns: 1fr; gap: var(--space-6);">
        <div style="grid-column: 1 / -1;">
            <div class="card">
                <div class="card-header">
                    <h2 class="text-xl font-bold text-primary">Recipe Details</h2>
                </div>
                
                <div class="card-body" style="display: flex; flex-direction: column; gap: var(--space-6);">
                    <!-- Header -->
                    <div class="flex items-center" style="gap: var(--space-4);">
                        <div style="width: 64px; height: 64px; background: var(--accent-color); border-radius: var(--radius-xl); display: flex; align-items: center; justify-content: center; box-shadow: var(--shadow-base);">
                            <i class="fas fa-book" style="color: var(--primary-dark); font-size: var(--text-2xl);"></i>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-primary">{{ $menuItemIngredient->menuItem->name }}</h2>
                            <p class="text-secondary">Recipe for Menu Item • ID: {{ $menuItemIngredient->id }}</p>
                        </div>
                    </div>

                    <!-- Ingredient Info -->
                    <div class="card" style="background: var(--background-light); border-color: var(--border-light);">
                        <div class="card-body">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center" style="gap: var(--space-4);">
                                    <div style="width: 48px; height: 48px; background: var(--accent-color); border-radius: var(--radius-lg); display: flex; align-items: center; justify-content: center; box-shadow: var(--shadow-base);">
                                        <i class="fas fa-box" style="color: var(--primary-dark);"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-primary" style="font-size: var(--text-lg);">{{ $menuItemIngredient->ingredient->name }}</h4>
                                        <p class="text-sm text-secondary">
                                            Required: <span class="font-medium">{{ $menuItemIngredient->quantity_needed }} {{ $menuItemIngredient->ingredient->unit }}</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm font-medium" style="color: {{ $menuItemIngredient->ingredient->stock_quantity >= $menuItemIngredient->quantity_needed ? '#28a745' : '#dc3545' }};">
                                        Stock: {{ $menuItemIngredient->ingredient->stock_quantity }} {{ $menuItemIngredient->ingredient->unit }}
                                    </p>
                                    @if($menuItemIngredient->ingredient->stock_quantity < $menuItemIngredient->quantity_needed)
                                    <span class="badge badge-danger" style="margin-top: var(--space-1);">
                                        <i class="fas fa-exclamation-circle" style="margin-right: var(--space-1);"></i> Low Stock
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions & Info -->
        <div style="display: flex; flex-direction: column; gap: var(--space-6);">
            <!-- Quick Actions -->
            <div class="card">
                <div class="card-header">
                    <h2 class="text-lg font-bold text-primary">Quick Actions</h2>
                </div>
                <div class="card-body" style="display: flex; flex-direction: column; gap: var(--space-3);">
                    <a href="{{ route('supervisor.recipes.edit', $menuItemIngredient) }}" class="btn btn-primary w-full">
                        <i class="fas fa-edit" style="margin-right: var(--space-2);"></i>Edit Recipe
                    </a>
                    
                    <form action="{{ route('supervisor.recipes.destroy', $menuItemIngredient) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                onclick="return confirm('Are you sure you want to delete this recipe?')"
                                class="btn w-full" style="background: #dc3545; color: white; border: none;">
                            <i class="fas fa-trash" style="margin-right: var(--space-2);"></i>Delete Recipe
                        </button>
                    </form>
                </div>
            </div>

            <!-- Recipe Information -->
            <div class="card">
                <div class="card-header">
                    <h2 class="text-lg font-bold text-primary">Recipe Information</h2>
                </div>
                <div class="card-body" style="display: flex; flex-direction: column; gap: var(--space-4);">
                    <div class="flex justify-between items-center">
                        <span class="text-secondary font-medium">Menu Item:</span>
                        <span class="font-bold text-primary">{{ $menuItemIngredient->menuItem->name }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-secondary font-medium">Ingredient:</span>
                        <span class="font-bold text-primary">{{ $menuItemIngredient->ingredient->name }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-secondary font-medium">Quantity:</span>
                        <span class="font-bold text-primary">{{ $menuItemIngredient->quantity_needed }} {{ $menuItemIngredient->ingredient->unit }}</span>
                    </div>
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
