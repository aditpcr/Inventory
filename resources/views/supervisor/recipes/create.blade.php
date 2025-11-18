@extends('layouts.app')

@section('title', 'Add New Recipe')
@section('subtitle', 'Create a new recipe for menu items')

@section('breadcrumbs')
<div class="flex items-center space-x-2 text-sm">
    <a href="{{ route('supervisor.recipes.index') }}" class="text-blue-600 hover:text-blue-700 font-medium flex items-center">
        <i class="fas fa-book mr-2"></i>Recipes
    </a>
    <i class="fas fa-chevron-right text-gray-400 text-xs"></i>
    <span class="text-gray-500 font-medium">Add New</span>
</div>
@endsection

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Header -->
    <div class="mb-6">
        <div class="flex items-center space-x-3 mb-2">
            <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-pink-500 rounded-xl flex items-center justify-center shadow-lg">
                <i class="fas fa-plus text-white text-lg"></i>
            </div>
            <h1 class="text-2xl font-black text-gray-900">Add New Recipe</h1>
        </div>
        <p class="text-gray-600">Create a new recipe for menu items</p>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-200/60 backdrop-blur-sm bg-white/90">
        <div class="px-6 py-5 border-b border-gray-200/60">
            <h2 class="text-lg font-bold text-gray-900">Recipe Information</h2>
        </div>
        
        <form action="{{ route('supervisor.recipes.store') }}" method="POST" class="p-6">
            @csrf
            
            <div class="space-y-6">
                <!-- Recipe Name -->
                <div>
                    <label for="name" class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
                        <i class="fas fa-tag mr-2 text-purple-500"></i>Recipe Name *
                    </label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 bg-white/80 backdrop-blur-sm"
                           placeholder="Enter recipe name" required>
                    @error('name')
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Associated Menu Item -->
                <div>
                    <label for="menu_item_id" class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
                        <i class="fas fa-utensils mr-2 text-orange-500"></i>Associated Menu Item *
                    </label>
                    <select name="menu_item_id" id="menu_item_id" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 bg-white/80 backdrop-blur-sm" required>
                        <option value="">Select Menu Item</option>
                        @foreach($menuItems as $menuItem)
                        <option value="{{ $menuItem->id }}" {{ old('menu_item_id') == $menuItem->id ? 'selected' : '' }}>
                            {{ $menuItem->name }}
                        </option>
                        @endforeach
                    </select>
                    @error('menu_item_id')
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
                        <i class="fas fa-align-left mr-2 text-blue-500"></i>Description
                    </label>
                    <textarea name="description" id="description" rows="4"
                              class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 bg-white/80 backdrop-blur-sm resize-none"
                              placeholder="Enter recipe description, instructions, or notes...">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Ingredients Section -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-4 flex items-center">
                        <i class="fas fa-boxes mr-2 text-green-500"></i>Ingredients *
                    </label>
                    <div id="ingredients-container" class="space-y-4">
                        <!-- Dynamic ingredients will be added here -->
                    </div>
                    
                    <button type="button" id="add-ingredient" 
                            class="mt-4 inline-flex items-center px-4 py-3 border-2 border-dashed border-gray-300 rounded-xl text-sm font-semibold text-gray-600 bg-gray-50 hover:bg-gray-100 hover:border-gray-400 transition-all duration-200">
                        <i class="fas fa-plus mr-2"></i>Add Ingredient
                    </button>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex items-center justify-end space-x-4 pt-6 mt-6 border-t border-gray-200">
                <a href="{{ route('supervisor.recipes.index') }}" 
                   class="flex items-center px-6 py-3 border border-gray-300 text-gray-700 rounded-xl font-semibold hover:bg-gray-50 transition-all duration-200">
                    <i class="fas fa-arrow-left mr-2"></i>Cancel
                </a>
                <button type="submit" 
                        class="flex items-center px-6 py-3 bg-gradient-to-r from-purple-500 to-pink-500 text-white rounded-xl font-bold hover:shadow-lg transition-all duration-200 hover:scale-105">
                    <i class="fas fa-save mr-2"></i>Create Recipe
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const container = document.getElementById('ingredients-container');
    const addButton = document.getElementById('add-ingredient');
    let ingredientCount = 0;

    function addIngredientField(ingredientId = '', quantity = '') {
        const index = ingredientCount++;
        const field = document.createElement('div');
        field.className = 'flex items-end space-x-4 p-4 bg-gradient-to-r from-gray-50 to-gray-100 rounded-xl border border-gray-200';
        field.innerHTML = `
            <div class="flex-1">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Ingredient</label>
                <select name="ingredients[${index}][id]" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 bg-white/80 backdrop-blur-sm">
                    <option value="">Select Ingredient</option>
                    @foreach($ingredients as $ingredient)
                    <option value="{{ $ingredient->id }}" ${ingredientId == '{{ $ingredient->id }}' ? 'selected' : ''}>{{ $ingredient->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="w-40">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Quantity</label>
                <input type="number" name="ingredients[${index}][quantity]" value="${quantity}" 
                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 bg-white/80 backdrop-blur-sm" 
                       min="0" step="0.01" placeholder="0.00" required>
            </div>
            <button type="button" class="remove-ingredient px-4 py-3 text-red-600 hover:text-red-800 hover:bg-red-50 rounded-xl transition-all duration-200">
                <i class="fas fa-trash"></i>
            </button>
        `;
        container.appendChild(field);

        field.querySelector('.remove-ingredient').addEventListener('click', function() {
            field.remove();
        });
    }

    addButton.addEventListener('click', function() {
        addIngredientField();
    });

    // Add initial ingredient field
    addIngredientField();
});
</script>
@endsection