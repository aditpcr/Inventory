@extends('layouts.app')

@section('title', $recipe->name)
@section('subtitle', 'Recipe details and ingredients')

@section('breadcrumbs')
<div class="flex items-center space-x-2 text-sm">
    <a href="{{ route('supervisor.recipes.index') }}" class="text-blue-600 hover:text-blue-700 font-medium flex items-center">
        <i class="fas fa-book mr-2"></i>Recipes
    </a>
    <i class="fas fa-chevron-right text-gray-400 text-xs"></i>
    <span class="text-gray-500 font-medium">{{ $recipe->name }}</span>
</div>
@endsection

@section('actions')
<a href="{{ route('supervisor.recipes.edit', $recipe) }}" 
   class="flex items-center px-6 py-3 bg-gradient-to-r from-purple-500 to-pink-500 text-white rounded-xl font-bold hover:shadow-lg transition-all duration-200 hover:scale-105">
    <i class="fas fa-edit mr-2"></i>Edit
</a>
@endsection

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Main Info -->
    <div class="lg:col-span-2">
        <div class="bg-white rounded-2xl shadow-lg border border-gray-200/60 backdrop-blur-sm bg-white/90">
            <div class="px-6 py-5 border-b border-gray-200/60">
                <h2 class="text-xl font-bold text-gray-900">Recipe Details</h2>
            </div>
            
            <div class="p-6 space-y-6">
                <!-- Header -->
                <div class="flex items-center space-x-4">
                    <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-pink-500 rounded-2xl flex items-center justify-center shadow-lg">
                        <i class="fas fa-book text-white text-2xl"></i>
                    </div>
                    <div>
                        <h2 class="text-2xl font-black text-gray-900">{{ $recipe->name }}</h2>
                        <p class="text-gray-600">Recipe for {{ $recipe->menuItem->name ?? 'N/A' }} • ID: {{ $recipe->id }}</p>
                    </div>
                </div>

                <!-- Description -->
                @if($recipe->description)
                <div class="bg-gradient-to-r from-blue-50 to-cyan-50 rounded-2xl p-5 border border-blue-200">
                    <h3 class="text-lg font-bold text-gray-900 mb-3 flex items-center">
                        <i class="fas fa-align-left mr-2 text-blue-500"></i>Description
                    </h3>
                    <p class="text-gray-700 leading-relaxed">{{ $recipe->description }}</p>
                </div>
                @endif

                <!-- Ingredients -->
                <div>
                    <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-boxes mr-2 text-green-500"></i>Ingredients ({{ $recipe->ingredients->count() }})
                    </h3>
                    <div class="space-y-3">
                        @foreach($recipe->ingredients as $ingredient)
                        <div class="flex items-center justify-between p-4 bg-gradient-to-r from-gray-50 to-gray-100 rounded-xl border border-gray-200 hover:shadow-md transition-all duration-200">
                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-xl flex items-center justify-center shadow-lg">
                                    <i class="fas fa-box text-white"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-900 text-lg">{{ $ingredient->name }}</h4>
                                    <p class="text-sm text-gray-600">
                                        Required: <span class="font-semibold">{{ $ingredient->pivot->quantity }} {{ $ingredient->unit }}</span>
                                    </p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-semibold {{ $ingredient->stock_quantity >= $ingredient->pivot->quantity ? 'text-green-600' : 'text-red-600' }}">
                                    Stock: {{ $ingredient->stock_quantity }} {{ $ingredient->unit }}
                                </p>
                                @if($ingredient->stock_quantity < $ingredient->pivot->quantity)
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-bold bg-red-100 text-red-800 mt-1">
                                    <i class="fas fa-exclamation-circle mr-1"></i> Low Stock
                                </span>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions & Info -->
    <div class="space-y-6">
        <!-- Quick Actions -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-200/60 backdrop-blur-sm bg-white/90">
            <div class="px-6 py-5 border-b border-gray-200/60">
                <h2 class="text-lg font-bold text-gray-900">Quick Actions</h2>
            </div>
            <div class="p-6 space-y-3">
                <a href="{{ route('supervisor.recipes.edit', $recipe) }}" 
                   class="flex items-center justify-center w-full px-4 py-3 bg-gradient-to-r from-blue-500 to-purple-500 text-white rounded-xl font-bold hover:shadow-lg transition-all duration-200 hover:scale-105">
                    <i class="fas fa-edit mr-2"></i>Edit Recipe
                </a>
                
                <form action="{{ route('supervisor.recipes.destroy', $recipe) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            onclick="return confirm('Are you sure you want to delete {{ $recipe->name }}?')"
                            class="flex items-center justify-center w-full px-4 py-3 bg-gradient-to-r from-red-500 to-pink-500 text-white rounded-xl font-bold hover:shadow-lg transition-all duration-200 hover:scale-105">
                        <i class="fas fa-trash mr-2"></i>Delete Recipe
                    </button>
                </form>
            </div>
        </div>

        <!-- Recipe Information -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-200/60 backdrop-blur-sm bg-white/90">
            <div class="px-6 py-5 border-b border-gray-200/60">
                <h2 class="text-lg font-bold text-gray-900">Recipe Information</h2>
            </div>
            <div class="p-6 space-y-4">
                <div class="flex justify-between items-center">
                    <span class="text-gray-600 font-medium">Menu Item:</span>
                    <span class="font-bold text-gray-900">{{ $recipe->menuItem->name ?? 'N/A' }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-gray-600 font-medium">Ingredients:</span>
                    <span class="font-bold text-gray-900">{{ $recipe->ingredients->count() }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-gray-600 font-medium">Created:</span>
                    <span class="font-bold text-gray-900">{{ $recipe->created_at->format('M j, Y') }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-gray-600 font-medium">Last Updated:</span>
                    <span class="font-bold text-gray-900">{{ $recipe->updated_at->format('M j, Y') }}</span>
                </div>
            </div>
        </div>

        <!-- Stock Status -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-200/60 backdrop-blur-sm bg-white/90">
            <div class="px-6 py-5 border-b border-gray-200/60">
                <h2 class="text-lg font-bold text-gray-900">Stock Status</h2>
            </div>
            <div class="p-6">
                @php
                    $lowStockCount = 0;
                    foreach($recipe->ingredients as $ingredient) {
                        if($ingredient->stock_quantity < $ingredient->pivot->quantity) {
                            $lowStockCount++;
                        }
                    }
                @endphp
                
                @if($lowStockCount > 0)
                <div class="flex items-center space-x-3 p-4 bg-gradient-to-r from-red-50 to-orange-50 rounded-xl border border-red-200">
                    <div class="w-10 h-10 bg-red-500 rounded-xl flex items-center justify-center">
                        <i class="fas fa-exclamation-triangle text-white"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-red-800">{{ $lowStockCount }} ingredients low in stock</h3>
                        <p class="text-sm text-red-600 mt-1">Some ingredients may need restocking</p>
                    </div>
                </div>
                @else
                <div class="flex items-center space-x-3 p-4 bg-gradient-to-r from-green-50 to-emerald-50 rounded-xl border border-green-200">
                    <div class="w-10 h-10 bg-green-500 rounded-xl flex items-center justify-center">
                        <i class="fas fa-check-circle text-white"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-green-800">All ingredients in stock</h3>
                        <p class="text-sm text-green-600 mt-1">Ready to prepare this recipe</p>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection