@extends('layouts.app')

@section('title', $ingredient->name)
@section('subtitle', 'Ingredient details and stock information')

@section('breadcrumbs')
<div class="flex items-center space-x-2 text-sm">
    <a href="{{ route('supervisor.ingredients.index') }}" class="text-blue-600 hover:text-blue-700 font-medium flex items-center">
        <i class="fas fa-boxes mr-2"></i>Ingredients
    </a>
    <i class="fas fa-chevron-right text-gray-400 text-xs"></i>
    <span class="text-gray-500 font-medium">{{ $ingredient->name }}</span>
</div>
@endsection

@section('actions')
<a href="{{ route('supervisor.ingredients.edit', $ingredient) }}" 
   class="flex items-center px-6 py-3 bg-gradient-to-r from-blue-500 to-purple-500 text-white rounded-xl font-bold hover:shadow-lg transition-all duration-200 hover:scale-105">
    <i class="fas fa-edit mr-2"></i>Edit
</a>
@endsection

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Main Info -->
    <div class="lg:col-span-2">
        <div class="bg-white rounded-2xl shadow-lg border border-gray-200/60 backdrop-blur-sm bg-white/90">
            <div class="px-6 py-5 border-b border-gray-200/60">
                <h2 class="text-xl font-bold text-gray-900">Ingredient Details</h2>
            </div>
            
            <div class="p-6 space-y-6">
                <!-- Header -->
                <div class="flex items-center space-x-4">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-purple-500 rounded-2xl flex items-center justify-center shadow-lg">
                        <i class="fas fa-box text-white text-2xl"></i>
                    </div>
                    <div>
                        <h2 class="text-2xl font-black text-gray-900">{{ $ingredient->name }}</h2>
                        <p class="text-gray-600">Inventory Item • ID: {{ $ingredient->id }}</p>
                    </div>
                </div>

                <!-- Stock Stats -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl p-5 border border-blue-200">
                        <p class="text-sm font-semibold text-blue-700 mb-2">Current Stock</p>
                        <p class="text-3xl font-black text-blue-900">{{ $ingredient->stock_quantity }} {{ $ingredient->unit }}</p>
                    </div>
                    
                    <div class="bg-gradient-to-br from-orange-50 to-orange-100 rounded-2xl p-5 border border-orange-200">
                        <p class="text-sm font-semibold text-orange-700 mb-2">Low Stock Threshold</p>
                        <p class="text-3xl font-black text-orange-900">{{ $ingredient->low_stock_threshold }} {{ $ingredient->unit }}</p>
                    </div>
                </div>

                <!-- Stock Status Alert -->
                <div class="bg-gradient-to-r {{ $ingredient->stock_quantity <= $ingredient->low_stock_threshold ? 'from-red-50 to-orange-50 border-red-200' : 'from-green-50 to-emerald-50 border-green-200' }} border-2 rounded-2xl p-6">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 {{ $ingredient->stock_quantity <= $ingredient->low_stock_threshold ? 'bg-red-500' : 'bg-green-500' }} rounded-2xl flex items-center justify-center shadow-lg">
                                <i class="fas {{ $ingredient->stock_quantity <= $ingredient->low_stock_threshold ? 'fa-exclamation-triangle' : 'fa-check-circle' }} text-white text-xl"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900 text-lg">
                                    {{ $ingredient->stock_quantity <= $ingredient->low_stock_threshold ? 'Low Stock Alert' : 'Stock Level Good' }}
                                </h3>
                                <p class="text-gray-600">
                                    {{ $ingredient->stock_quantity <= $ingredient->low_stock_threshold ? 'Time to restock this ingredient' : 'Adequate stock available' }}
                                </p>
                            </div>
                        </div>
                        @if($ingredient->stock_quantity <= $ingredient->low_stock_threshold)
                        <div class="animate-pulse">
                            <i class="fas fa-bell text-red-500 text-2xl"></i>
                        </div>
                        @endif
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
                <a href="{{ route('supervisor.ingredients.edit', $ingredient) }}" 
                   class="flex items-center justify-center w-full px-4 py-3 bg-gradient-to-r from-blue-500 to-purple-500 text-white rounded-xl font-bold hover:shadow-lg transition-all duration-200 hover:scale-105">
                    <i class="fas fa-edit mr-2"></i>Edit Details
                </a>
                
                <form action="{{ route('supervisor.ingredients.destroy', $ingredient) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            onclick="return confirm('Are you sure you want to delete {{ $ingredient->name }}?')"
                            class="flex items-center justify-center w-full px-4 py-3 bg-gradient-to-r from-red-500 to-pink-500 text-white rounded-xl font-bold hover:shadow-lg transition-all duration-200 hover:scale-105">
                        <i class="fas fa-trash mr-2"></i>Delete Ingredient
                    </button>
                </form>
            </div>
        </div>

        <!-- Additional Information -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-200/60 backdrop-blur-sm bg-white/90">
            <div class="px-6 py-5 border-b border-gray-200/60">
                <h2 class="text-lg font-bold text-gray-900">Additional Information</h2>
            </div>
            <div class="p-6 space-y-4">
                <div class="flex justify-between items-center">
                    <span class="text-gray-600 font-medium">Unit Type:</span>
                    <span class="font-bold text-gray-900">{{ $ingredient->unit }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-gray-600 font-medium">Created:</span>
                    <span class="font-bold text-gray-900">{{ $ingredient->created_at->format('M j, Y') }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-gray-600 font-medium">Last Updated:</span>
                    <span class="font-bold text-gray-900">{{ $ingredient->updated_at->format('M j, Y') }}</span>
                </div>
            </div>
        </div>

        <!-- Stock Progress -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-200/60 backdrop-blur-sm bg-white/90">
            <div class="px-6 py-5 border-b border-gray-200/60">
                <h2 class="text-lg font-bold text-gray-900">Stock Level</h2>
            </div>
            <div class="p-6">
                @php
                    $percentage = min(100, ($ingredient->stock_quantity / max($ingredient->low_stock_threshold * 2, 1)) * 100);
                    $color = $ingredient->stock_quantity <= $ingredient->low_stock_threshold ? 'bg-red-500' : 'bg-green-500';
                @endphp
                <div class="w-full bg-gray-200 rounded-full h-3 mb-2">
                    <div class="h-3 rounded-full {{ $color }} transition-all duration-500" 
                         style="width: {{ $percentage }}%"></div>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Current: {{ $ingredient->stock_quantity }}</span>
                    <span class="text-gray-600">Threshold: {{ $ingredient->low_stock_threshold }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection