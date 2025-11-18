@extends('layouts.app')

@section('title', 'Supervisor Dashboard')
@section('subtitle', 'Monitor inventory and manage menu items efficiently')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-8">

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        <!-- Total Menu Items -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-200/60 p-6 backdrop-blur-sm bg-white/90 hover:shadow-xl transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Total Menu Items</p>
                    <p class="text-4xl font-black text-gray-900 mt-2">{{ $menuItems }}</p>
                </div>
                <!-- Icon -->
                <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-purple-500 rounded-2xl flex items-center justify-center shadow-lg">
                    <i class="fas fa-utensils text-white text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Total Ingredients -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-200/60 p-6 backdrop-blur-sm bg-white/90 hover:shadow-xl transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Total Ingredients</p>
                    <p class="text-4xl font-black text-gray-900 mt-2">{{ $ingredients }}</p>
                </div>
                <div class="w-14 h-14 bg-gradient-to-br from-green-500 to-emerald-500 rounded-2xl flex items-center justify-center shadow-lg">
                    <i class="fas fa-boxes text-white text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Low Stock -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-200/60 p-6 backdrop-blur-sm bg-white/90 hover:shadow-xl transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Low Stock Items</p>
                    <p class="text-4xl font-black text-gray-900 mt-2">{{ $lowStockIngredients->count() }}</p>
                </div>
                <div class="w-14 h-14 bg-gradient-to-br from-orange-500 to-red-500 rounded-2xl flex items-center justify-center shadow-lg">
                    <i class="fas fa-exclamation-triangle text-white text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Low Stock Alerts -->
    @if($lowStockIngredients->count() > 0)
    <div class="bg-white rounded-2xl shadow-lg border border-orange-200 mb-8 backdrop-blur-sm bg-white/90">
        <div class="px-6 py-5 border-b border-gray-200/60">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-gradient-to-br from-orange-500 to-red-500 rounded-xl flex items-center justify-center shadow-lg">
                    <i class="fas fa-exclamation-triangle text-white text-lg"></i>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-gray-900">Low Stock Alerts</h2>
                    <p class="text-sm text-gray-600">Immediate attention required</p>
                </div>
            </div>
        </div>

        <div class="p-6 space-y-4">
            @foreach($lowStockIngredients as $ingredient)
            <div class="flex items-center justify-between p-5 bg-gradient-to-r from-orange-50 to-red-50 rounded-xl border border-orange-200/60 hover:shadow-md transition-all duration-300">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-orange-500 to-red-500 rounded-xl flex items-center justify-center shadow-lg">
                        <i class="fas fa-exclamation text-white"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-900 text-lg">{{ $ingredient->name }}</h4>
                        <p class="text-sm text-gray-600">
                            <span class="font-semibold">Stock:</span> {{ $ingredient->stock_quantity }} {{ $ingredient->unit }} 
                            • <span class="font-semibold">Threshold:</span> {{ $ingredient->low_stock_threshold }}
                        </p>
                    </div>
                </div>

                <a 
                    href="{{ route('supervisor.ingredients.edit', $ingredient) }}"
                    class="inline-flex items-center px-5 py-3 bg-gradient-to-r from-blue-500 to-purple-500 text-white font-semibold rounded-xl hover:shadow-lg transition-all duration-300 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                >
                    <i class="fas fa-edit mr-2"></i>
                    Adjust Stock
                </a>
            </div>
            @endforeach
        </div>
    </div>
    @else
    <!-- No Alerts -->
    <div class="bg-white rounded-2xl shadow-lg border border-green-200 mb-8 backdrop-blur-sm bg-white/90">
        <div class="px-6 py-5 border-b border-gray-200/60">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-emerald-500 rounded-xl flex items-center justify-center shadow-lg">
                    <i class="fas fa-check-circle text-white text-lg"></i>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-gray-900">Inventory Status</h2>
                    <p class="text-sm text-gray-600">All systems operational</p>
                </div>
            </div>
        </div>

        <div class="p-8 text-center">
            <div class="w-20 h-20 bg-gradient-to-br from-green-500 to-emerald-500 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg">
                <i class="fas fa-check text-white text-2xl"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-2">All ingredients are well stocked!</h3>
            <p class="text-gray-600">No low stock alerts at this time.</p>
        </div>
    </div>
    @endif

    <!-- Quick Actions -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-200/60 backdrop-blur-sm bg-white/90">
        <div class="px-6 py-5 border-b border-gray-200/60">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-500 rounded-xl flex items-center justify-center shadow-lg">
                    <i class="fas fa-bolt text-white text-lg"></i>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-gray-900">Quick Actions</h2>
                    <p class="text-sm text-gray-600">Manage your inventory efficiently</p>
                </div>
            </div>
        </div>

        <div class="p-6 grid grid-cols-1 md:grid-cols-3 gap-5">
            <!-- Add Ingredient -->
            <a 
                href="{{ route('supervisor.ingredients.create') }}"
                class="group flex items-center justify-center px-6 py-5 bg-gradient-to-r from-blue-500 to-purple-500 text-white rounded-xl font-bold hover:shadow-xl transition-all duration-300 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
            >
                <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center mr-3 group-hover:bg-white/30 transition-colors">
                    <i class="fas fa-plus text-white"></i>
                </div>
                <span>Add Ingredient</span>
            </a>

            <!-- Create Menu -->
            <a 
                href="{{ route('supervisor.menu-items.create') }}"
                class="group flex items-center justify-center px-6 py-5 bg-gradient-to-r from-blue-500 to-purple-500 text-white rounded-xl font-bold hover:shadow-xl transition-all duration-300 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
            >
                <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center mr-3 group-hover:bg-white/30 transition-colors">
                    <i class="fas fa-utensils text-white"></i>
                </div>
                <span>Create Menu Item</span>
            </a>

            <!-- Add Recipe -->
            <a 
                href="{{ route('supervisor.recipes.create') }}"
                class="group flex items-center justify-center px-6 py-5 bg-gradient-to-r from-blue-500 to-purple-500 text-white rounded-xl font-bold hover:shadow-xl transition-all duration-300 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
            >
                <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center mr-3 group-hover:bg-white/30 transition-colors">
                    <i class="fas fa-book text-white"></i>
                </div>
                <span>Add Recipe</span>
            </a>
        </div>
    </div>

    <!-- Recent Activity Section -->
    <div class="mt-8 grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Recent Menu Items -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-200/60 backdrop-blur-sm bg-white/90">
            <div class="px-6 py-5 border-b border-gray-200/60">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-500 rounded-xl flex items-center justify-center shadow-lg">
                        <i class="fas fa-utensils text-white text-lg"></i>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-gray-900">Recent Menu Items</h2>
                        <p class="text-sm text-gray-600">Latest additions to the menu</p>
                    </div>
                </div>
            </div>
            <div class="p-6">
                <div class="text-center py-8 text-gray-500">
                    <i class="fas fa-clock text-3xl mb-3 opacity-50"></i>
                    <p>Recent activity will appear here</p>
                </div>
            </div>
        </div>

        <!-- Inventory Overview -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-200/60 backdrop-blur-sm bg-white/90">
            <div class="px-6 py-5 border-b border-gray-200/60">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-emerald-500 rounded-xl flex items-center justify-center shadow-lg">
                        <i class="fas fa-chart-bar text-white text-lg"></i>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-gray-900">Inventory Overview</h2>
                        <p class="text-sm text-gray-600">Stock levels and trends</p>
                    </div>
                </div>
            </div>
            <div class="p-6">
                <div class="text-center py-8 text-gray-500">
                    <i class="fas fa-chart-pie text-3xl mb-3 opacity-50"></i>
                    <p>Inventory analytics will appear here</p>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection