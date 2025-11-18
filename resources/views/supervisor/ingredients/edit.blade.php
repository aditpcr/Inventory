@extends('layouts.app')

@section('title', 'Edit ' . $ingredient->name)
@section('subtitle', 'Update ingredient details and stock information')

@section('breadcrumbs')
<div class="flex items-center space-x-2 text-sm">
    <a href="{{ route('supervisor.ingredients.index') }}" class="text-blue-600 hover:text-blue-700 font-medium flex items-center">
        <i class="fas fa-boxes mr-2"></i>Ingredients
    </a>
    <i class="fas fa-chevron-right text-gray-400 text-xs"></i>
    <a href="{{ route('supervisor.ingredients.show', $ingredient) }}" class="text-blue-600 hover:text-blue-700 font-medium">{{ $ingredient->name }}</a>
    <i class="fas fa-chevron-right text-gray-400 text-xs"></i>
    <span class="text-gray-500 font-medium">Edit</span>
</div>
@endsection

@section('content')
<div class="max-w-2xl mx-auto">
    <!-- Header -->
    <div class="mb-6">
        <div class="flex items-center space-x-3 mb-2">
            <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-500 rounded-xl flex items-center justify-center shadow-lg">
                <i class="fas fa-edit text-white text-lg"></i>
            </div>
            <h1 class="text-2xl font-black text-gray-900">Edit {{ $ingredient->name }}</h1>
        </div>
        <p class="text-gray-600">Update ingredient details and stock information</p>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-200/60 backdrop-blur-sm bg-white/90">
        <div class="px-6 py-5 border-b border-gray-200/60">
            <h2 class="text-lg font-bold text-gray-900">Edit Ingredient Information</h2>
        </div>
        
        <form action="{{ route('supervisor.ingredients.update', $ingredient) }}" method="POST" class="p-6">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Ingredient Name -->
                <div class="md:col-span-2">
                    <label for="name" class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
                        <i class="fas fa-tag mr-2 text-blue-500"></i>Ingredient Name *
                    </label>
                    <input type="text" name="name" id="name" value="{{ old('name', $ingredient->name) }}" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 bg-white/80 backdrop-blur-sm"
                           placeholder="Enter ingredient name" required>
                    @error('name')
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Current Stock -->
                <div>
                    <label for="stock_quantity" class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
                        <i class="fas fa-boxes mr-2 text-green-500"></i>Current Stock *
                    </label>
                    <input type="number" name="stock_quantity" id="stock_quantity" value="{{ old('stock_quantity', $ingredient->stock_quantity) }}" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 bg-white/80 backdrop-blur-sm"
                           min="0" step="0.01" required>
                    @error('stock_quantity')
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Unit -->
                <div>
                    <label for="unit" class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
                        <i class="fas fa-balance-scale mr-2 text-purple-500"></i>Unit *
                    </label>
                    <select name="unit" id="unit" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 bg-white/80 backdrop-blur-sm" required>
                        <option value="">Select Unit</option>
                        <option value="kg" {{ old('unit', $ingredient->unit) == 'kg' ? 'selected' : '' }}>Kilogram (kg)</option>
                        <option value="g" {{ old('unit', $ingredient->unit) == 'g' ? 'selected' : '' }}>Gram (g)</option>
                        <option value="l" {{ old('unit', $ingredient->unit) == 'l' ? 'selected' : '' }}>Liter (l)</option>
                        <option value="ml" {{ old('unit', $ingredient->unit) == 'ml' ? 'selected' : '' }}>Milliliter (ml)</option>
                        <option value="pcs" {{ old('unit', $ingredient->unit) == 'pcs' ? 'selected' : '' }}>Pieces (pcs)</option>
                    </select>
                    @error('unit')
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Low Stock Threshold -->
                <div class="md:col-span-2">
                    <label for="low_stock_threshold" class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
                        <i class="fas fa-exclamation-triangle mr-2 text-orange-500"></i>Low Stock Threshold *
                    </label>
                    <input type="number" name="low_stock_threshold" id="low_stock_threshold" value="{{ old('low_stock_threshold', $ingredient->low_stock_threshold) }}" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 bg-white/80 backdrop-blur-sm"
                           min="0" step="0.01" required>
                    <p class="mt-2 text-sm text-gray-500 flex items-center">
                        <i class="fas fa-info-circle mr-2 text-blue-500"></i>Alert will trigger when stock falls below this level
                    </p>
                    @error('low_stock_threshold')
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                        </p>
                    @enderror
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex items-center justify-end space-x-4 pt-6 mt-6 border-t border-gray-200">
                <a href="{{ route('supervisor.ingredients.show', $ingredient) }}" 
                   class="flex items-center px-6 py-3 border border-gray-300 text-gray-700 rounded-xl font-semibold hover:bg-gray-50 transition-all duration-200">
                    <i class="fas fa-times mr-2"></i>Cancel
                </a>
                <button type="submit" 
                        class="flex items-center px-6 py-3 bg-gradient-to-r from-blue-500 to-purple-500 text-white rounded-xl font-bold hover:shadow-lg transition-all duration-200 hover:scale-105">
                    <i class="fas fa-save mr-2"></i>Update Ingredient
                </button>
            </div>
        </form>
    </div>
</div>
@endsection