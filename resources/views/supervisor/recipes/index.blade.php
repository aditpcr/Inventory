@extends('layouts.app')

@section('title', 'Recipes Management')
@section('subtitle', 'Manage recipes and their ingredients')

@section('breadcrumbs')
<div class="flex items-center space-x-2 text-sm">
    <span class="text-gray-500 font-medium">Recipes</span>
</div>
@endsection

@section('actions')
<a href="{{ route('supervisor.recipes.create') }}" 
   class="flex items-center px-6 py-3 bg-gradient-to-r from-purple-500 to-pink-500 text-white rounded-xl font-bold hover:shadow-lg transition-all duration-200 hover:scale-105">
    <i class="fas fa-plus mr-2"></i>Add Recipe Ingredient
</a>
@endsection

@section('content')
<!-- Header Stats -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-2xl shadow-lg border border-gray-200/60 p-6 backdrop-blur-sm bg-white/90">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-medium">Total Menu Items</p>
                <p class="text-3xl font-black text-gray-900 mt-2">{{ $menuItems->count() }}</p>
            </div>
            <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-pink-500 rounded-2xl flex items-center justify-center shadow-lg">
                <i class="fas fa-utensils text-white text-xl"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-lg border border-gray-200/60 p-6 backdrop-blur-sm bg-white/90">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-medium">Total Ingredients</p>
                <p class="text-3xl font-black text-gray-900 mt-2">
                    @php
                        $totalIngredients = 0;
                        foreach($menuItems as $menuItem) {
                            $totalIngredients += $menuItem->menuItemIngredients->count();
                        }
                    @endphp
                    {{ $totalIngredients }}
                </p>
            </div>
            <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-emerald-500 rounded-2xl flex items-center justify-center shadow-lg">
                <i class="fas fa-boxes text-white text-xl"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-lg border border-gray-200/60 p-6 backdrop-blur-sm bg-white/90">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-medium">Avg Ingredients</p>
                <p class="text-3xl font-black text-gray-900 mt-2">
                    @php
                        $avgIngredients = $menuItems->count() > 0 ? $totalIngredients / $menuItems->count() : 0;
                    @endphp
                    {{ round($avgIngredients, 1) }}
                </p>
            </div>
            <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-2xl flex items-center justify-center shadow-lg">
                <i class="fas fa-calculator text-white text-xl"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-lg border border-gray-200/60 p-6 backdrop-blur-sm bg-white/90">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-medium">Low Stock</p>
                <p class="text-3xl font-black text-gray-900 mt-2">
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
            <div class="w-12 h-12 bg-gradient-to-br from-orange-500 to-red-500 rounded-2xl flex items-center justify-center shadow-lg">
                <i class="fas fa-exclamation-triangle text-white text-xl"></i>
            </div>
        </div>
    </div>
</div>

<!-- Menu Items with Recipes -->
<div class="bg-white rounded-2xl shadow-lg border border-gray-200/60 backdrop-blur-sm bg-white/90">
    <div class="px-6 py-5 border-b border-gray-200/60">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-pink-500 rounded-xl flex items-center justify-center shadow-lg">
                    <i class="fas fa-book text-white text-lg"></i>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-gray-900">Menu Items & Recipes</h2>
                    <p class="text-sm text-gray-600">Manage ingredients for each menu item</p>
                </div>
            </div>
        </div>
    </div>

    <div class="p-6 space-y-6">
        @foreach($menuItems as $menuItem)
        <div class="border border-gray-200 rounded-2xl overflow-hidden">
            <!-- Menu Item Header -->
            <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-gradient-to-br from-orange-500 to-red-500 rounded-xl flex items-center justify-center shadow-lg">
                            <i class="fas fa-utensils text-white"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-900 text-lg">{{ $menuItem->name }}</h3>
                            <p class="text-sm text-gray-600">Rp {{ number_format($menuItem->price, 0, ',', '.') }}</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-bold bg-purple-100 text-purple-800">
                            <i class="fas fa-boxes mr-1"></i> {{ $menuItem->menuItemIngredients->count() }} ingredients
                        </span>
                    </div>
                </div>
            </div>

            <!-- Ingredients List -->
            <div class="p-6">
                @if($menuItem->menuItemIngredients->count() > 0)
                <div class="space-y-3">
                    @foreach($menuItem->menuItemIngredients as $menuItemIngredient)
                    <div class="flex items-center justify-between p-4 bg-gradient-to-r from-gray-50 to-gray-100 rounded-xl border border-gray-200 hover:shadow-md transition-all duration-200">
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-xl flex items-center justify-center shadow-lg">
                                <i class="fas fa-box text-white"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900 text-lg">{{ $menuItemIngredient->ingredient->name }}</h4>
                                <p class="text-sm text-gray-600">
                                    Required: <span class="font-semibold">{{ $menuItemIngredient->quantity_needed }} {{ $menuItemIngredient->ingredient->unit }}</span>
                                </p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="text-right mr-4">
                                <p class="text-sm font-semibold {{ $menuItemIngredient->ingredient->stock_quantity >= $menuItemIngredient->quantity_needed ? 'text-green-600' : 'text-red-600' }}">
                                    Stock: {{ $menuItemIngredient->ingredient->stock_quantity }} {{ $menuItemIngredient->ingredient->unit }}
                                </p>
                                @if($menuItemIngredient->ingredient->stock_quantity < $menuItemIngredient->quantity_needed)
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-bold bg-red-100 text-red-800 mt-1">
                                    <i class="fas fa-exclamation-circle mr-1"></i> Low Stock
                                </span>
                                @endif
                            </div>
                            <div class="flex items-center space-x-2">
                                <a href="{{ route('supervisor.recipes.edit', $menuItemIngredient) }}" 
                                   class="flex items-center px-3 py-2 bg-blue-500 text-white rounded-lg font-semibold hover:bg-blue-600 transition-all duration-200">
                                    <i class="fas fa-edit text-sm"></i>
                                </a>
                                <form action="{{ route('supervisor.recipes.destroy', $menuItemIngredient) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            onclick="return confirm('Are you sure you want to remove this ingredient from {{ $menuItem->name }}?')"
                                            class="flex items-center px-3 py-2 bg-red-500 text-white rounded-lg font-semibold hover:bg-red-600 transition-all duration-200">
                                        <i class="fas fa-trash text-sm"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="text-center py-8">
                    <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-boxes text-gray-400 text-2xl"></i>
                    </div>
                    <h4 class="text-lg font-semibold text-gray-900 mb-2">No ingredients added</h4>
                    <p class="text-gray-600 mb-4">This menu item doesn't have any ingredients yet.</p>
                    <a href="{{ route('supervisor.recipes.create') }}?menu_item_id={{ $menuItem->id }}" 
                       class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-purple-500 to-pink-500 text-white rounded-xl font-semibold hover:shadow-lg transition-all duration-200">
                        <i class="fas fa-plus mr-2"></i>Add Ingredients
                    </a>
                </div>
                @endif
            </div>
        </div>
        @endforeach
    </div>

    @if($menuItems->isEmpty())
    <div class="text-center py-16">
        <div class="w-24 h-24 bg-gradient-to-br from-gray-100 to-gray-200 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg">
            <i class="fas fa-utensils text-gray-400 text-3xl"></i>
        </div>
        <h3 class="text-xl font-bold text-gray-900 mb-2">No menu items found</h3>
        <p class="text-gray-600 mb-6 max-w-md mx-auto">Create menu items first to add recipes and ingredients.</p>
        <a href="{{ route('supervisor.menu-items.create') }}" 
           class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-orange-500 to-red-500 text-white rounded-xl font-bold hover:shadow-lg transition-all duration-200 hover:scale-105">
            <i class="fas fa-plus mr-2"></i>Create Menu Item
        </a>
    </div>
    @endif
</div>
@endsection