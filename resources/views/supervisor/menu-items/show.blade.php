@extends('layouts.app')

@section('title', $menuItem->name)
@section('subtitle', 'Menu item details and information')

@section('breadcrumbs')
<div class="flex items-center space-x-2 text-sm">
    <a href="{{ route('supervisor.menu-items.index') }}" class="text-blue-600 hover:text-blue-700 font-medium flex items-center">
        <i class="fas fa-utensils mr-2"></i>Menu Items
    </a>
    <i class="fas fa-chevron-right text-gray-400 text-xs"></i>
    <span class="text-gray-500 font-medium">{{ $menuItem->name }}</span>
</div>
@endsection

@section('actions')
<a href="{{ route('supervisor.menu-items.edit', $menuItem) }}" 
   class="flex items-center px-6 py-3 bg-gradient-to-r from-orange-500 to-red-500 text-white rounded-xl font-bold hover:shadow-lg transition-all duration-200 hover:scale-105">
    <i class="fas fa-edit mr-2"></i>Edit
</a>
@endsection

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Main Info -->
    <div class="lg:col-span-2">
        <div class="bg-white rounded-2xl shadow-lg border border-gray-200/60 backdrop-blur-sm bg-white/90">
            <div class="px-6 py-5 border-b border-gray-200/60">
                <h2 class="text-xl font-bold text-gray-900">Menu Item Details</h2>
            </div>
            
            <div class="p-6 space-y-6">
                <!-- Header -->
                <div class="flex items-center space-x-4">
                    <div class="w-16 h-16 bg-gradient-to-br from-orange-500 to-red-500 rounded-2xl flex items-center justify-center shadow-lg">
                        <i class="fas fa-utensils text-white text-2xl"></i>
                    </div>
                    <div>
                        <h2 class="text-2xl font-black text-gray-900">{{ $menuItem->name }}</h2>
                        <p class="text-gray-600">Menu Item • ID: {{ $menuItem->id }}</p>
                    </div>
                </div>

                <!-- Stats -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl p-5 border border-blue-200">
                        <p class="text-sm font-semibold text-blue-700 mb-2">Price</p>
                        <p class="text-3xl font-black text-blue-900">Rp {{ number_format($menuItem->price, 0, ',', '.') }}</p>
                    </div>
                    
                    <div class="bg-gradient-to-br {{ $menuItem->available ? 'from-green-50 to-emerald-100 border-green-200' : 'from-red-50 to-red-100 border-red-200' }} rounded-2xl p-5 border">
                        <p class="text-sm font-semibold {{ $menuItem->available ? 'text-green-700' : 'text-red-700' }} mb-2">Status</p>
                        <p class="text-3xl font-black {{ $menuItem->available ? 'text-green-900' : 'text-red-900' }}">
                            {{ $menuItem->available ? 'Available' : 'Unavailable' }}
                        </p>
                    </div>
                </div>

                <!-- Status Alert -->
                <div class="bg-gradient-to-r {{ $menuItem->available ? 'from-green-50 to-emerald-50 border-green-200' : 'from-red-50 to-orange-50 border-red-200' }} border-2 rounded-2xl p-6">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 {{ $menuItem->available ? 'bg-green-500' : 'bg-red-500' }} rounded-2xl flex items-center justify-center shadow-lg">
                                <i class="fas {{ $menuItem->available ? 'fa-check-circle' : 'fa-times-circle' }} text-white text-xl"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900 text-lg">
                                    {{ $menuItem->available ? 'Available for Ordering' : 'Currently Unavailable' }}
                                </h3>
                                <p class="text-gray-600">
                                    {{ $menuItem->available ? 'This item can be ordered by customers' : 'This item is temporarily unavailable for ordering' }}
                                </p>
                            </div>
                        </div>
                        @if(!$menuItem->available)
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
                <form action="{{ route('supervisor.menu-items.toggle-availability', $menuItem) }}" method="POST">
                    @csrf
                    <button type="submit" 
                            class="flex items-center justify-center w-full px-4 py-3 {{ $menuItem->available ? 'bg-gradient-to-r from-yellow-500 to-orange-500 hover:shadow-lg' : 'bg-gradient-to-r from-green-500 to-emerald-500 hover:shadow-lg' }} text-white rounded-xl font-bold transition-all duration-200 hover:scale-105">
                        <i class="fas fa-toggle-{{ $menuItem->available ? 'on' : 'off' }} mr-2"></i>
                        {{ $menuItem->available ? 'Disable Item' : 'Enable Item' }}
                    </button>
                </form>
                
                <a href="{{ route('supervisor.menu-items.edit', $menuItem) }}" 
                   class="flex items-center justify-center w-full px-4 py-3 bg-gradient-to-r from-blue-500 to-purple-500 text-white rounded-xl font-bold hover:shadow-lg transition-all duration-200 hover:scale-105">
                    <i class="fas fa-edit mr-2"></i>Edit Details
                </a>
                
                <form action="{{ route('supervisor.menu-items.destroy', $menuItem) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            onclick="return confirm('Are you sure you want to delete {{ $menuItem->name }}?')"
                            class="flex items-center justify-center w-full px-4 py-3 bg-gradient-to-r from-red-500 to-pink-500 text-white rounded-xl font-bold hover:shadow-lg transition-all duration-200 hover:scale-105">
                        <i class="fas fa-trash mr-2"></i>Delete Menu Item
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
                    <span class="text-gray-600 font-medium">Item ID:</span>
                    <span class="font-bold text-gray-900">{{ $menuItem->id }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-gray-600 font-medium">Created:</span>
                    <span class="font-bold text-gray-900">{{ $menuItem->created_at->format('M j, Y') }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-gray-600 font-medium">Last Updated:</span>
                    <span class="font-bold text-gray-900">{{ $menuItem->updated_at->format('M j, Y') }}</span>
                </div>
            </div>
        </div>

        <!-- Price History -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-200/60 backdrop-blur-sm bg-white/90">
            <div class="px-6 py-5 border-b border-gray-200/60">
                <h2 class="text-lg font-bold text-gray-900">Pricing</h2>
            </div>
            <div class="p-6">
                <div class="text-center">
                    <p class="text-3xl font-black text-gray-900 mb-2">Rp {{ number_format($menuItem->price, 0, ',', '.') }}</p>
                    <p class="text-sm text-gray-600">Current price</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection