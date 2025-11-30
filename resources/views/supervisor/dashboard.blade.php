@extends('layouts.app')

@section('title', 'Supervisor Dashboard')
@section('subtitle', 'Monitor inventory and manage menu items efficiently with real-time insights')

@section('content')
<div class="container">
    <!-- Stats Cards -->
    <div class="grid" style="grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: var(--space-6); margin-bottom: var(--space-8);">
        <!-- Total Menu Items -->
        <div class="card">
            <div class="card-body">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-sm font-medium text-secondary" style="margin-bottom: var(--space-2); text-transform: uppercase; letter-spacing: 0.5px;">Total Menu Items</h3>
                        <div class="text-3xl font-bold text-primary">{{ $menuItems }}</div>
                    </div>
                    <div style="width: 70px; height: 70px; border-radius: var(--radius-lg); display: flex; align-items: center; justify-content: center; font-size: var(--text-2xl); color: var(--primary-dark); background: var(--accent-color); box-shadow: var(--shadow-md);">
                        <i class="fas fa-utensils"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Ingredients -->
        <div class="card">
            <div class="card-body">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-sm font-medium text-secondary" style="margin-bottom: var(--space-2); text-transform: uppercase; letter-spacing: 0.5px;">Total Ingredients</h3>
                        <div class="text-3xl font-bold text-primary">{{ $ingredients }}</div>
                    </div>
                    <div style="width: 70px; height: 70px; border-radius: var(--radius-lg); display: flex; align-items: center; justify-content: center; font-size: var(--text-2xl); color: white; background: #28a745; box-shadow: var(--shadow-md);">
                        <i class="fas fa-boxes"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Low Stock -->
        <div class="card">
            <div class="card-body">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-sm font-medium text-secondary" style="margin-bottom: var(--space-2); text-transform: uppercase; letter-spacing: 0.5px;">Low Stock Items</h3>
                        <div class="text-3xl font-bold text-primary">{{ $lowStockIngredients->count() }}</div>
                    </div>
                    <div style="width: 70px; height: 70px; border-radius: var(--radius-lg); display: flex; align-items: center; justify-content: center; font-size: var(--text-2xl); color: white; background: #f59e0b; box-shadow: var(--shadow-md);">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Low Stock Alerts -->
    @if($lowStockIngredients->count() > 0)
    <div class="card" style="margin-bottom: var(--space-8);">
        <div class="card-header">
            <div class="flex items-center" style="gap: var(--space-4);">
                <div style="width: 50px; height: 50px; border-radius: var(--radius-lg); display: flex; align-items: center; justify-content: center; font-size: var(--text-xl); color: white; background: #dc3545; box-shadow: var(--shadow-md);">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-primary">Low Stock Alerts</h2>
                    <p class="text-sm text-secondary">Immediate attention required</p>
                </div>
            </div>
        </div>

        <div class="card-body">
            @foreach($lowStockIngredients as $ingredient)
            <div class="card" style="margin-bottom: var(--space-4); background: rgba(220, 53, 69, 0.1); border: 1px solid rgba(220, 53, 69, 0.3);">
                <div class="card-body">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center" style="gap: var(--space-4);">
                            <div style="width: 50px; height: 50px; border-radius: var(--radius-lg); display: flex; align-items: center; justify-content: center; font-size: var(--text-xl); color: white; background: #dc3545;">
                                <i class="fas fa-exclamation"></i>
                            </div>
                            <div>
                                <h4 class="text-lg font-medium text-primary" style="margin-bottom: var(--space-1);">{{ $ingredient->name }}</h4>
                                <p class="text-sm text-secondary">
                                    <span class="font-medium">Stock:</span> {{ $ingredient->stock_quantity }} {{ $ingredient->unit }} 
                                    • <span class="font-medium">Threshold:</span> {{ $ingredient->low_stock_threshold }}
                                </p>
                            </div>
                        </div>

                        <a href="{{ route('supervisor.ingredients.edit', $ingredient) }}" class="btn btn-primary">
                            <i class="fas fa-edit" style="margin-right: var(--space-2);"></i>
                            Adjust Stock
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @else
    <!-- No Alerts -->
    <div class="card" style="margin-bottom: var(--space-8);">
        <div class="card-header">
            <div class="flex items-center" style="gap: var(--space-4);">
                <div style="width: 50px; height: 50px; border-radius: var(--radius-lg); display: flex; align-items: center; justify-content: center; font-size: var(--text-xl); color: white; background: #28a745; box-shadow: var(--shadow-md);">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-primary">Inventory Status</h2>
                    <p class="text-sm text-secondary">All systems operational</p>
                </div>
            </div>
        </div>

        <div class="card-body text-center" style="padding: var(--space-12);">
            <div style="width: 80px; height: 80px; border-radius: var(--radius-xl); display: flex; align-items: center; justify-content: center; font-size: var(--text-3xl); color: white; background: #28a745; margin: 0 auto var(--space-6); box-shadow: var(--shadow-lg);">
                <i class="fas fa-check"></i>
            </div>
            <h3 class="text-2xl font-bold text-primary" style="margin-bottom: var(--space-2);">All ingredients are well stocked!</h3>
            <p class="text-secondary" style="max-width: 400px; margin: 0 auto;">No low stock alerts at this time. Your inventory is in excellent condition.</p>
        </div>
    </div>
    @endif

    <!-- Quick Actions -->
    <div class="card" style="margin-bottom: var(--space-8);">
        <div class="card-header">
            <div class="flex items-center" style="gap: var(--space-4);">
                <div style="width: 50px; height: 50px; border-radius: var(--radius-lg); display: flex; align-items: center; justify-content: center; font-size: var(--text-xl); color: white; background: var(--accent-color); box-shadow: var(--shadow-md);">
                    <i class="fas fa-bolt"></i>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-primary">Quick Actions</h2>
                    <p class="text-sm text-secondary">Manage your inventory efficiently</p>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="grid" style="grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: var(--space-4);">
                <!-- Add Ingredient -->
                <a href="{{ route('supervisor.ingredients.create') }}" class="card" style="text-decoration: none; text-align: center; transition: all var(--transition-base);">
                    <div class="card-body">
                        <div style="width: 60px; height: 60px; border-radius: var(--radius-lg); display: flex; align-items: center; justify-content: center; font-size: var(--text-2xl); color: var(--accent-color); background: rgba(58, 134, 255, 0.1); margin: 0 auto var(--space-4); transition: all var(--transition-base);">
                            <i class="fas fa-plus"></i>
                        </div>
                        <h3 class="text-lg font-medium text-primary" style="margin-bottom: var(--space-2);">Add Ingredient</h3>
                        <p class="text-sm text-secondary">Add new ingredients to your inventory</p>
                    </div>
                </a>

                <!-- Create Menu -->
                <a href="{{ route('supervisor.menu-items.create') }}" class="card" style="text-decoration: none; text-align: center; transition: all var(--transition-base);">
                    <div class="card-body">
                        <div style="width: 60px; height: 60px; border-radius: var(--radius-lg); display: flex; align-items: center; justify-content: center; font-size: var(--text-2xl); color: var(--accent-color); background: rgba(58, 134, 255, 0.1); margin: 0 auto var(--space-4); transition: all var(--transition-base);">
                            <i class="fas fa-utensils"></i>
                        </div>
                        <h3 class="text-lg font-medium text-primary" style="margin-bottom: var(--space-2);">Create Menu Item</h3>
                        <p class="text-sm text-secondary">Create new dishes for your menu</p>
                    </div>
                </a>

                <!-- Add Recipe -->
                <a href="{{ route('supervisor.recipes.create') }}" class="card" style="text-decoration: none; text-align: center; transition: all var(--transition-base);">
                    <div class="card-body">
                        <div style="width: 60px; height: 60px; border-radius: var(--radius-lg); display: flex; align-items: center; justify-content: center; font-size: var(--text-2xl); color: var(--accent-color); background: rgba(58, 134, 255, 0.1); margin: 0 auto var(--space-4); transition: all var(--transition-base);">
                            <i class="fas fa-book"></i>
                        </div>
                        <h3 class="text-lg font-medium text-primary" style="margin-bottom: var(--space-2);">Add Recipe</h3>
                        <p class="text-sm text-secondary">Define recipes for your menu items</p>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <!-- Recent Activity Section -->
    <div class="grid" style="grid-template-columns: repeat(auto-fit, minmax(400px, 1fr)); gap: var(--space-6);">
        <!-- Recent Menu Items -->
        <div class="card">
            <div class="card-header">
                <div class="flex items-center" style="gap: var(--space-4);">
                    <div style="width: 50px; height: 50px; border-radius: var(--radius-lg); display: flex; align-items: center; justify-content: center; font-size: var(--text-xl); color: var(--primary-dark); background: var(--accent-color); box-shadow: var(--shadow-md);">
                        <i class="fas fa-utensils"></i>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-primary">Recent Menu Items</h2>
                        <p class="text-sm text-secondary">Latest additions to the menu</p>
                    </div>
                </div>
            </div>
            <div class="card-body text-center" style="padding: var(--space-8);">
                <div class="text-secondary">
                    <i class="fas fa-clock" style="font-size: var(--text-4xl); margin-bottom: var(--space-4); opacity: 0.5;"></i>
                    <p>Recent activity will appear here</p>
                </div>
            </div>
        </div>

        <!-- Inventory Overview -->
        <div class="card">
            <div class="card-header">
                <div class="flex items-center" style="gap: var(--space-4);">
                    <div style="width: 50px; height: 50px; border-radius: var(--radius-lg); display: flex; align-items: center; justify-content: center; font-size: var(--text-xl); color: white; background: #28a745; box-shadow: var(--shadow-md);">
                        <i class="fas fa-chart-bar"></i>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-primary">Inventory Overview</h2>
                        <p class="text-sm text-secondary">Stock levels and trends</p>
                    </div>
                </div>
            </div>
            <div class="card-body text-center" style="padding: var(--space-8);">
                <div class="text-secondary">
                    <i class="fas fa-chart-pie" style="font-size: var(--text-4xl); margin-bottom: var(--space-4); opacity: 0.5;"></i>
                    <p>Inventory analytics will appear here</p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .card:hover {
        transform: translateY(-2px);
    }
    
    .card a:hover {
        background: var(--accent-color);
        color: white;
    }
    
    .card a:hover .text-primary,
    .card a:hover .text-secondary {
        color: white;
    }
    
    .card a:hover div[style*="background: rgba(58, 134, 255, 0.1)"] {
        background: rgba(255, 255, 255, 0.2) !important;
        color: white;
    }
</style>
@endsection
