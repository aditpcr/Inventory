@extends('layouts.app')

@section('title', 'Ingredients Management')
@section('subtitle', 'Manage inventory ingredients and stock levels')

@section('breadcrumbs')
<div class="flex items-center" style="gap: var(--space-2); font-size: var(--text-sm);">
    <span class="text-secondary font-medium">Ingredients</span>
</div>
@endsection

@section('actions')
<a href="{{ route('supervisor.ingredients.create') }}" class="btn btn-primary">
    <i class="fas fa-plus" style="margin-right: var(--space-2);"></i>Add Ingredient
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
                        <p class="text-sm text-secondary font-medium">Total Ingredients</p>
                        <p class="text-3xl font-bold text-primary" style="margin-top: var(--space-2);">{{ $allIngredients->count() }}</p>
                    </div>
                    <div style="width: 48px; height: 48px; background: var(--accent-color); border-radius: var(--radius-lg); display: flex; align-items: center; justify-content: center; box-shadow: var(--shadow-base);">
                        <i class="fas fa-boxes" style="color: white; font-size: var(--text-xl);"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-secondary font-medium">In Stock</p>
                        <p class="text-3xl font-bold text-primary" style="margin-top: var(--space-2);">{{ $allIngredients->where('stock_quantity', '>', 0)->count() }}</p>
                    </div>
                    <div style="width: 48px; height: 48px; background: #28a745; border-radius: var(--radius-lg); display: flex; align-items: center; justify-content: center; box-shadow: var(--shadow-base);">
                        <i class="fas fa-check-circle" style="color: white; font-size: var(--text-xl);"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-secondary font-medium">Low Stock</p>
                        <p class="text-3xl font-bold text-primary" style="margin-top: var(--space-2);">{{ $allIngredients->filter(function($ing) { return $ing->stock_quantity > 0 && $ing->stock_quantity <= $ing->low_stock_threshold; })->count() }}</p>
                    </div>
                    <div style="width: 48px; height: 48px; background: #f59e0b; border-radius: var(--radius-lg); display: flex; align-items: center; justify-content: center; box-shadow: var(--shadow-base);">
                        <i class="fas fa-exclamation-triangle" style="color: white; font-size: var(--text-xl);"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-secondary font-medium">Out of Stock</p>
                        <p class="text-3xl font-bold text-primary" style="margin-top: var(--space-2);">{{ $allIngredients->where('stock_quantity', '<=', 0)->count() }}</p>
                    </div>
                    <div style="width: 48px; height: 48px; background: #dc3545; border-radius: var(--radius-lg); display: flex; align-items: center; justify-content: center; box-shadow: var(--shadow-base);">
                        <i class="fas fa-times-circle" style="color: white; font-size: var(--text-xl);"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="card" style="margin-bottom: var(--space-6);">
        <div class="card-body">
            <form method="GET" action="{{ route('supervisor.ingredients.index') }}" class="flex items-center" style="gap: var(--space-4); flex-wrap: wrap;">
                <div style="flex: 1; min-width: 200px;">
                    <label class="form-label">Search by Name</label>
                    <input type="text" name="name" value="{{ request('name') }}" placeholder="Ingredient name..." class="form-input">
                </div>
                <div style="flex: 1; min-width: 200px;">
                    <label class="form-label">Unit</label>
                    <input type="text" name="unit" value="{{ request('unit') }}" placeholder="e.g., kg, g, L" class="form-input">
                </div>
                <div style="flex: 1; min-width: 200px;">
                    <label class="form-label">Stock Status</label>
                    <select name="stock_status" class="form-input">
                        <option value="">All</option>
                        <option value="in_stock" {{ request('stock_status') === 'in_stock' ? 'selected' : '' }}>In Stock</option>
                        <option value="low_stock" {{ request('stock_status') === 'low_stock' ? 'selected' : '' }}>Low Stock</option>
                        <option value="out_of_stock" {{ request('stock_status') === 'out_of_stock' ? 'selected' : '' }}>Out of Stock</option>
                    </select>
                </div>
                <div style="display: flex; gap: var(--space-2); align-items: flex-end;">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search" style="margin-right: var(--space-2);"></i>Filter
                    </button>
                    <a href="{{ route('supervisor.ingredients.index') }}" class="btn btn-outline">
                        <i class="fas fa-times" style="margin-right: var(--space-2);"></i>Clear
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Ingredients Table -->
    <div class="card">
        <div class="card-header">
            <div class="flex items-center justify-between">
                <div class="flex items-center" style="gap: var(--space-3);">
                    <div style="width: 40px; height: 40px; background: var(--accent-color); border-radius: var(--radius-lg); display: flex; align-items: center; justify-content: center; box-shadow: var(--shadow-base);">
                        <i class="fas fa-boxes" style="color: white; font-size: var(--text-lg);"></i>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-primary">All Ingredients</h2>
                        <p class="text-sm text-secondary">Manage your inventory ingredients</p>
                    </div>
                </div>
            </div>
        </div>

        <div style="overflow-x: auto;">
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Stock</th>
                        <th>Unit</th>
                        <th>Low Stock Threshold</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ingredients as $ingredient)
                    <tr>
                        <td>
                            <div class="flex items-center">
                                <div style="width: 40px; height: 40px; background: var(--accent-color); border-radius: var(--radius-lg); display: flex; align-items: center; justify-content: center; margin-right: var(--space-3); box-shadow: var(--shadow-base);">
                                    <i class="fas fa-box" style="color: white; font-size: var(--text-sm);"></i>
                                </div>
                                <div>
                                    <span class="font-bold text-primary block">{{ $ingredient->name }}</span>
                                    <span class="text-xs text-secondary">ID: {{ $ingredient->id }}</span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="font-bold text-primary" style="font-size: var(--text-lg);">{{ $ingredient->stock_quantity }}</span>
                        </td>
                        <td>
                            <span class="badge badge-info">{{ $ingredient->unit }}</span>
                        </td>
                        <td>
                            <span class="font-medium text-primary">{{ $ingredient->low_stock_threshold }}</span>
                        </td>
                        <td>
                            @if($ingredient->stock_quantity <= 0)
                            <span class="badge badge-danger">
                                <i class="fas fa-times-circle" style="margin-right: var(--space-1);"></i> Out of Stock
                            </span>
                            @elseif($ingredient->stock_quantity <= $ingredient->low_stock_threshold)
                            <span class="badge badge-warning">
                                <i class="fas fa-exclamation-triangle" style="margin-right: var(--space-1);"></i> Low Stock
                            </span>
                            @else
                            <span class="badge badge-success">
                                <i class="fas fa-check-circle" style="margin-right: var(--space-1);"></i> In Stock
                            </span>
                            @endif
                        </td>
                        <td>
                            <div class="flex items-center" style="gap: var(--space-2);">
                                <a href="{{ route('supervisor.ingredients.edit', $ingredient) }}" class="btn btn-primary" style="padding: var(--space-2) var(--space-3);">
                                    <i class="fas fa-edit" style="font-size: var(--text-sm);"></i>
                                </a>
                                <a href="{{ route('supervisor.ingredients.show', $ingredient) }}" class="btn btn-outline" style="padding: var(--space-2) var(--space-3); background: #28a745; color: white; border-color: #28a745;">
                                    <i class="fas fa-eye" style="font-size: var(--text-sm);"></i>
                                </a>
                                <form action="{{ route('supervisor.ingredients.destroy', $ingredient) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            onclick="return confirm('Are you sure you want to delete {{ $ingredient->name }}?')"
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

        @if($ingredients->isEmpty())
        <div class="card-body text-center" style="padding: var(--space-16);">
            <div style="width: 96px; height: 96px; background: var(--background-light); border-radius: var(--radius-xl); display: flex; align-items: center; justify-content: center; margin: 0 auto var(--space-4); box-shadow: var(--shadow-base);">
                <i class="fas fa-boxes" style="color: var(--text-light); font-size: var(--text-3xl);"></i>
            </div>
            <h3 class="text-xl font-bold text-primary" style="margin-bottom: var(--space-2);">No ingredients found</h3>
            <p class="text-secondary" style="margin-bottom: var(--space-6); max-width: 400px; margin-left: auto; margin-right: auto;">Get started by adding your first ingredient to the inventory management system.</p>
            <a href="{{ route('supervisor.ingredients.create') }}" class="btn btn-primary">
                <i class="fas fa-plus" style="margin-right: var(--space-2);"></i>Add First Ingredient
            </a>
        </div>
        @endif

        <!-- Pagination with Query String Preservation -->
        @if($ingredients->hasPages())
        <div class="card-footer" style="padding: var(--space-4) var(--space-6); border-top: 1px solid var(--border-light);">
            <div class="pagination-wrapper" style="display: flex; flex-direction: column; gap: var(--space-4); align-items: center; justify-content: space-between;">
                <div class="pagination-info" style="width: 100%;">
                    <span class="pagination-text" style="font-size: var(--text-sm); color: var(--text-secondary);">
                        Showing <strong>{{ $ingredients->firstItem() }}</strong> to <strong>{{ $ingredients->lastItem() }}</strong> of <strong>{{ $ingredients->total() }}</strong> ingredients
                    </span>
                </div>
                <nav aria-label="Page navigation" style="width: 100%;">
                    {{ $ingredients->appends(request()->query())->links('vendor.pagination.custom') }}
                </nav>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
