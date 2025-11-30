@extends('layouts.app')

@section('title', 'Recipes Management')
@section('subtitle', 'Manage recipes and their ingredients')

@section('breadcrumbs')
<div class="flex items-center" style="gap: var(--space-2); font-size: var(--text-sm);">
    <span class="text-secondary font-medium">Recipes</span>
</div>
@endsection

@section('actions')
<a href="{{ route('supervisor.recipes.create') }}" class="btn btn-primary">
    <i class="fas fa-plus" style="margin-right: var(--space-2);"></i>Add Recipe Ingredient
</a>
@endsection

@section('content')
<div class="container">
    <!-- Header Stats -->
    <div class="grid" style="grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: var(--space-6); margin-bottom: var(--space-8);">
        <div class="card">
            <div class="card-body">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-secondary font-medium">Total Menu Items</p>
                        <p class="text-3xl font-bold text-primary" style="margin-top: var(--space-2);">{{ $menuItems->total() }}</p>
                    </div>
                    <div style="width: 48px; height: 48px; background: var(--accent-color); border-radius: var(--radius-lg); display: flex; align-items: center; justify-content: center; box-shadow: var(--shadow-base);">
                        <i class="fas fa-utensils" style="color: var(--primary-dark); font-size: var(--text-xl);"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-secondary font-medium">Total Ingredients</p>
                        <p class="text-3xl font-bold text-primary" style="margin-top: var(--space-2);">
                            @php
                                $totalIngredients = 0;
                                foreach($menuItems as $menuItem) {
                                    $totalIngredients += $menuItem->menuItemIngredients->count();
                                }
                            @endphp
                            {{ $totalIngredients }}
                        </p>
                    </div>
                    <div style="width: 48px; height: 48px; background: #28a745; border-radius: var(--radius-lg); display: flex; align-items: center; justify-content: center; box-shadow: var(--shadow-base);">
                        <i class="fas fa-boxes" style="color: white; font-size: var(--text-xl);"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-secondary font-medium">Avg Ingredients</p>
                        <p class="text-3xl font-bold text-primary" style="margin-top: var(--space-2);">
                            @php
                                $avgIngredients = $menuItems->count() > 0 ? $totalIngredients / $menuItems->count() : 0;
                            @endphp
                            {{ round($avgIngredients, 1) }}
                        </p>
                    </div>
                    <div style="width: 48px; height: 48px; background: var(--accent-color); border-radius: var(--radius-lg); display: flex; align-items: center; justify-content: center; box-shadow: var(--shadow-base);">
                        <i class="fas fa-calculator" style="color: var(--primary-dark); font-size: var(--text-xl);"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-secondary font-medium">Low Stock</p>
                        <p class="text-3xl font-bold text-primary" style="margin-top: var(--space-2);">
                            @php
                                $lowStockCount = 0;
                                foreach($menuItems as $menuItem) {
                                    foreach($menuItem->menuItemIngredients as $menuItemIngredient) {
                                        if($menuItemIngredient->ingredient->stock_quantity < $menuItemIngredient->quantity_needed) {
                                            $lowStockCount++;
                                        }
                                    }
                                }
                            @endphp
                            {{ $lowStockCount }}
                        </p>
                    </div>
                    <div style="width: 48px; height: 48px; background: #f59e0b; border-radius: var(--radius-lg); display: flex; align-items: center; justify-content: center; box-shadow: var(--shadow-base);">
                        <i class="fas fa-exclamation-triangle" style="color: white; font-size: var(--text-xl);"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Menu Items with Recipes -->
    <div class="card">
        <div class="card-header">
            <div class="flex items-center justify-between">
                <div class="flex items-center" style="gap: var(--space-3);">
                    <div style="width: 40px; height: 40px; background: var(--accent-color); border-radius: var(--radius-lg); display: flex; align-items: center; justify-content: center; box-shadow: var(--shadow-base);">
                        <i class="fas fa-book" style="color: var(--primary-dark); font-size: var(--text-lg);"></i>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-primary">Menu Items & Recipes</h2>
                        <p class="text-sm text-secondary">Manage ingredients for each menu item</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body" style="display: flex; flex-direction: column; gap: var(--space-6);">
            @foreach($menuItems as $menuItem)
            <div class="card" style="border-color: var(--border-light);">
                <!-- Menu Item Header -->
                <div class="card-header" style="background: var(--background-light);">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center" style="gap: var(--space-3);">
                            <div style="width: 40px; height: 40px; background: var(--accent-color); border-radius: var(--radius-lg); display: flex; align-items: center; justify-content: center; box-shadow: var(--shadow-base);">
                                <i class="fas fa-utensils" style="color: var(--primary-dark);"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-primary" style="font-size: var(--text-lg);">{{ $menuItem->name }}</h3>
                                <p class="text-sm text-secondary">Rp {{ number_format($menuItem->price, 0, ',', '.') }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <span class="badge badge-info">
                                <i class="fas fa-boxes" style="margin-right: var(--space-1);"></i> {{ $menuItem->menuItemIngredients->count() }} ingredients
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Ingredients List -->
                <div class="card-body">
                    @if($menuItem->menuItemIngredients->count() > 0)
                    <div style="display: flex; flex-direction: column; gap: var(--space-3);">
                        @foreach($menuItem->menuItemIngredients as $menuItemIngredient)
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
                                    <div class="flex items-center" style="gap: var(--space-3);">
                                        <div class="text-right" style="margin-right: var(--space-4);">
                                            <p class="text-sm font-medium {{ $menuItemIngredient->ingredient->stock_quantity >= $menuItemIngredient->quantity_needed ? 'text-primary' : 'text-secondary' }}" style="color: {{ $menuItemIngredient->ingredient->stock_quantity >= $menuItemIngredient->quantity_needed ? '#28a745' : '#dc3545' }};">
                                                Stock: {{ $menuItemIngredient->ingredient->stock_quantity }} {{ $menuItemIngredient->ingredient->unit }}
                                            </p>
                                            @if($menuItemIngredient->ingredient->stock_quantity < $menuItemIngredient->quantity_needed)
                                            <span class="badge badge-danger" style="margin-top: var(--space-1);">
                                                <i class="fas fa-exclamation-circle" style="margin-right: var(--space-1);"></i> Low Stock
                                            </span>
                                            @endif
                                        </div>
                                        <div class="flex items-center" style="gap: var(--space-2);">
                                            <a href="{{ route('supervisor.recipes.edit', $menuItemIngredient) }}" class="btn btn-primary" style="padding: var(--space-2) var(--space-3);">
                                                <i class="fas fa-edit" style="font-size: var(--text-sm);"></i>
                                            </a>
                                            <form action="{{ route('supervisor.recipes.destroy', $menuItemIngredient) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        onclick="return confirm('Are you sure you want to remove this ingredient from {{ $menuItem->name }}?')"
                                                        class="btn" style="padding: var(--space-2) var(--space-3); background: #dc3545; color: white; border: none;">
                                                    <i class="fas fa-trash" style="font-size: var(--text-sm);"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="text-center" style="padding: var(--space-8);">
                        <div style="width: 64px; height: 64px; background: var(--background-light); border-radius: var(--radius-xl); display: flex; align-items: center; justify-content: center; margin: 0 auto var(--space-4); box-shadow: var(--shadow-base);">
                            <i class="fas fa-boxes" style="color: var(--text-light); font-size: var(--text-2xl);"></i>
                        </div>
                        <h4 class="text-lg font-medium text-primary" style="margin-bottom: var(--space-2);">No ingredients added</h4>
                        <p class="text-secondary" style="margin-bottom: var(--space-4);">This menu item doesn't have any ingredients yet.</p>
                        <a href="{{ route('supervisor.recipes.create') }}?menu_item_id={{ $menuItem->id }}" class="btn btn-primary">
                            <i class="fas fa-plus" style="margin-right: var(--space-2);"></i>Add Ingredients
                        </a>
                    </div>
                    @endif
                </div>
            </div>
            @endforeach
        </div>

        @if($menuItems->isEmpty())
        <div class="card-body text-center" style="padding: var(--space-16);">
            <div style="width: 96px; height: 96px; background: var(--background-light); border-radius: var(--radius-xl); display: flex; align-items: center; justify-content: center; margin: 0 auto var(--space-4); box-shadow: var(--shadow-base);">
                <i class="fas fa-utensils" style="color: var(--text-light); font-size: var(--text-3xl);"></i>
            </div>
            <h3 class="text-xl font-bold text-primary" style="margin-bottom: var(--space-2);">No menu items found</h3>
            <p class="text-secondary" style="margin-bottom: var(--space-6); max-width: 400px; margin-left: auto; margin-right: auto;">Create menu items first to add recipes and ingredients.</p>
            <a href="{{ route('supervisor.menu-items.create') }}" class="btn btn-primary">
                <i class="fas fa-plus" style="margin-right: var(--space-2);"></i>Create Menu Item
            </a>
        </div>
        @endif

        <!-- Pagination -->
        @if($menuItems->hasPages())
        <div class="card-footer" style="padding: var(--space-4) var(--space-6); border-top: 1px solid var(--border-light);">
            <div class="pagination-wrapper">
                <div class="pagination-info">
                    <span class="pagination-text">
                        Showing {{ $menuItems->firstItem() }} to {{ $menuItems->lastItem() }} of {{ $menuItems->total() }} menu items
                    </span>
                </div>
                <nav aria-label="Page navigation">
                    {{ $menuItems->links() }}
                </nav>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
