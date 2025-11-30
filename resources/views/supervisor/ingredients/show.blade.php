@extends('layouts.app')

@section('title', $ingredient->name)
@section('subtitle', 'Ingredient details and stock information')

@section('breadcrumbs')
<div class="flex items-center" style="gap: var(--space-2); font-size: var(--text-sm);">
    <a href="{{ route('supervisor.ingredients.index') }}" class="text-accent font-medium flex items-center nav-link">
        <i class="fas fa-boxes" style="margin-right: var(--space-2);"></i>Ingredients
    </a>
    <i class="fas fa-chevron-right text-light" style="font-size: var(--text-xs);"></i>
    <span class="text-secondary font-medium">{{ $ingredient->name }}</span>
</div>
@endsection

@section('actions')
<a href="{{ route('supervisor.ingredients.edit', $ingredient) }}" class="btn btn-primary">
    <i class="fas fa-edit" style="margin-right: var(--space-2);"></i>Edit
</a>
@endsection

@section('content')
<div class="container">
    <div class="grid" style="grid-template-columns: 1fr; gap: var(--space-6);">
        <div style="grid-column: 1 / -1;">
            <div class="card">
                <div class="card-header">
                    <h2 class="text-xl font-bold text-primary">Ingredient Details</h2>
                </div>
                
                <div class="card-body" style="display: flex; flex-direction: column; gap: var(--space-6);">
                    <!-- Header -->
                    <div class="flex items-center" style="gap: var(--space-4);">
                        <div style="width: 64px; height: 64px; background: var(--accent-color); border-radius: var(--radius-xl); display: flex; align-items: center; justify-content: center; box-shadow: var(--shadow-base);">
                            <i class="fas fa-box" style="color: var(--primary-dark); font-size: var(--text-2xl);"></i>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-primary">{{ $ingredient->name }}</h2>
                            <p class="text-secondary">Inventory Item • ID: {{ $ingredient->id }}</p>
                        </div>
                    </div>

                    <!-- Stock Stats -->
                    <div class="grid" style="grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: var(--space-6);">
                        <div class="card" style="background: rgba(58, 134, 255, 0.1); border-color: rgba(58, 134, 255, 0.3);">
                            <div class="card-body">
                                <p class="text-sm font-medium text-secondary" style="margin-bottom: var(--space-2);">Current Stock</p>
                                <p class="text-3xl font-bold text-primary">{{ $ingredient->stock_quantity }} {{ $ingredient->unit }}</p>
                            </div>
                        </div>
                        
                        <div class="card" style="background: rgba(255, 215, 0, 0.1); border-color: rgba(255, 215, 0, 0.3);">
                            <div class="card-body">
                                <p class="text-sm font-medium text-secondary" style="margin-bottom: var(--space-2);">Low Stock Threshold</p>
                                <p class="text-3xl font-bold text-primary">{{ $ingredient->low_stock_threshold }} {{ $ingredient->unit }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Stock Status Alert -->
                    <div class="card" style="background: {{ $ingredient->stock_quantity <= $ingredient->low_stock_threshold ? 'rgba(220, 53, 69, 0.1)' : 'rgba(40, 167, 69, 0.1)' }}; border: 2px solid {{ $ingredient->stock_quantity <= $ingredient->low_stock_threshold ? 'rgba(220, 53, 69, 0.3)' : 'rgba(40, 167, 69, 0.3)' }};">
                        <div class="card-body">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center" style="gap: var(--space-4);">
                                    <div style="width: 48px; height: 48px; background: {{ $ingredient->stock_quantity <= $ingredient->low_stock_threshold ? '#dc3545' : '#28a745' }}; border-radius: var(--radius-lg); display: flex; align-items: center; justify-content: center; box-shadow: var(--shadow-base);">
                                        <i class="fas {{ $ingredient->stock_quantity <= $ingredient->low_stock_threshold ? 'fa-exclamation-triangle' : 'fa-check-circle' }}" style="color: white; font-size: var(--text-xl);"></i>
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-primary" style="font-size: var(--text-lg);">
                                            {{ $ingredient->stock_quantity <= $ingredient->low_stock_threshold ? 'Low Stock Alert' : 'Stock Level Good' }}
                                        </h3>
                                        <p class="text-secondary">
                                            {{ $ingredient->stock_quantity <= $ingredient->low_stock_threshold ? 'Time to restock this ingredient' : 'Adequate stock available' }}
                                        </p>
                                    </div>
                                </div>
                                @if($ingredient->stock_quantity <= $ingredient->low_stock_threshold)
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

        <!-- Quick Actions & Info -->
        <div style="display: flex; flex-direction: column; gap: var(--space-6);">
            <!-- Quick Actions -->
            <div class="card">
                <div class="card-header">
                    <h2 class="text-lg font-bold text-primary">Quick Actions</h2>
                </div>
                <div class="card-body" style="display: flex; flex-direction: column; gap: var(--space-3);">
                    <a href="{{ route('supervisor.ingredients.edit', $ingredient) }}" class="btn btn-primary w-full">
                        <i class="fas fa-edit" style="margin-right: var(--space-2);"></i>Edit Details
                    </a>
                    
                    <form action="{{ route('supervisor.ingredients.destroy', $ingredient) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                onclick="return confirm('Are you sure you want to delete {{ $ingredient->name }}?')"
                                class="btn w-full" style="background: #dc3545; color: white; border: none;">
                            <i class="fas fa-trash" style="margin-right: var(--space-2);"></i>Delete Ingredient
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
                        <span class="text-secondary font-medium">Unit Type:</span>
                        <span class="font-bold text-primary">{{ $ingredient->unit }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-secondary font-medium">Created:</span>
                        <span class="font-bold text-primary">{{ $ingredient->created_at->format('M j, Y') }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-secondary font-medium">Last Updated:</span>
                        <span class="font-bold text-primary">{{ $ingredient->updated_at->format('M j, Y') }}</span>
                    </div>
                </div>
            </div>

            <!-- Stock Progress -->
            <div class="card">
                <div class="card-header">
                    <h2 class="text-lg font-bold text-primary">Stock Level</h2>
                </div>
                <div class="card-body">
                    @php
                        $percentage = min(100, ($ingredient->stock_quantity / max($ingredient->low_stock_threshold * 2, 1)) * 100);
                        $color = $ingredient->stock_quantity <= $ingredient->low_stock_threshold ? '#dc3545' : '#28a745';
                    @endphp
                    <div style="width: 100%; background: var(--background-light); border-radius: 9999px; height: 12px; margin-bottom: var(--space-2);">
                        <div style="height: 12px; border-radius: 9999px; background: {{ $color }}; transition: all 0.5s; width: {{ $percentage }}%;"></div>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-secondary">Current: {{ $ingredient->stock_quantity }}</span>
                        <span class="text-secondary">Threshold: {{ $ingredient->low_stock_threshold }}</span>
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
