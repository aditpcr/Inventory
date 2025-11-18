@extends('layouts.app')

@section('title', 'Edit ' . $menuItem->name)
@section('subtitle', 'Update menu item details and pricing')

@section('breadcrumbs')
<div class="flex items-center space-x-2 text-sm">
    <a href="{{ route('supervisor.menu-items.index') }}" class="text-blue-600 hover:text-blue-700 font-medium flex items-center">
        <i class="fas fa-utensils mr-2"></i>Menu Items
    </a>
    <i class="fas fa-chevron-right text-gray-400 text-xs"></i>
    <a href="{{ route('supervisor.menu-items.show', $menuItem) }}" class="text-blue-600 hover:text-blue-700 font-medium">{{ $menuItem->name }}</a>
    <i class="fas fa-chevron-right text-gray-400 text-xs"></i>
    <span class="text-gray-500 font-medium">Edit</span>
</div>
@endsection

@section('content')
<div class="max-w-2xl mx-auto">
    <!-- Header -->
    <div class="mb-6">
        <div class="flex items-center space-x-3 mb-2">
            <div class="w-10 h-10 bg-gradient-to-br from-orange-500 to-red-500 rounded-xl flex items-center justify-center shadow-lg">
                <i class="fas fa-edit text-white text-lg"></i>
            </div>
            <h1 class="text-2xl font-black text-gray-900">Edit {{ $menuItem->name }}</h1>
        </div>
        <p class="text-gray-600">Update menu item details and pricing</p>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-200/60 backdrop-blur-sm bg-white/90">
        <div class="px-6 py-5 border-b border-gray-200/60">
            <h2 class="text-lg font-bold text-gray-900">Edit Menu Item Information</h2>
        </div>
        
        <form action="{{ route('supervisor.menu-items.update', $menuItem) }}" method="POST" class="p-6">
            @csrf
            @method('PUT')
            
            <div class="space-y-6">
                <!-- Menu Item Name -->
                <div>
                    <label for="name" class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
                        <i class="fas fa-tag mr-2 text-orange-500"></i>Menu Item Name *
                    </label>
                    <input type="text" name="name" id="name" value="{{ old('name', $menuItem->name) }}" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 bg-white/80 backdrop-blur-sm"
                           placeholder="Enter menu item name" required>
                    @error('name')
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Price -->
                <div>
                    <label for="price" class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
                        <i class="fas fa-money-bill-wave mr-2 text-green-500"></i>Price *
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="text-gray-500 font-medium">Rp</span>
                        </div>
                        <input type="number" name="price" id="price" value="{{ old('price', $menuItem->price) }}" 
                               class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 bg-white/80 backdrop-blur-sm"
                               min="0" step="0.01" placeholder="0.00" required>
                    </div>
                    @error('price')
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Availability -->
                <div class="flex items-center p-4 bg-gray-50 rounded-xl border border-gray-200">
                    <input type="checkbox" name="available" id="available" value="1" {{ old('available', $menuItem->available) ? 'checked' : '' }}
                           class="w-5 h-5 text-blue-600 border-gray-300 rounded focus:ring-blue-500 transition duration-200">
                    <label for="available" class="ml-3 block text-sm font-semibold text-gray-700 flex items-center">
                        <i class="fas fa-toggle-{{ $menuItem->available ? 'on' : 'off' }} mr-2 {{ $menuItem->available ? 'text-green-500' : 'text-red-500' }}"></i>
                        Available for ordering
                    </label>
                </div>
                @error('available')
                    <p class="mt-2 text-sm text-red-600 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Form Actions -->
            <div class="flex items-center justify-end space-x-4 pt-6 mt-6 border-t border-gray-200">
                <a href="{{ route('supervisor.menu-items.show', $menuItem) }}" 
                   class="flex items-center px-6 py-3 border border-gray-300 text-gray-700 rounded-xl font-semibold hover:bg-gray-50 transition-all duration-200">
                    <i class="fas fa-times mr-2"></i>Cancel
                </a>
                <button type="submit" 
                        class="flex items-center px-6 py-3 bg-gradient-to-r from-orange-500 to-red-500 text-white rounded-xl font-bold hover:shadow-lg transition-all duration-200 hover:scale-105">
                    <i class="fas fa-save mr-2"></i>Update Menu Item
                </button>
            </div>
        </form>
    </div>
</div>
@endsection