@extends('layouts.app')

@section('title', 'Menu Items Management')
@section('subtitle', 'Manage restaurant menu items and availability')

@section('breadcrumbs')
<div class="flex items-center space-x-2 text-sm">
    <span class="text-gray-500 font-medium">Menu Items</span>
</div>
@endsection

@section('actions')
<a href="{{ route('supervisor.menu-items.create') }}" 
   class="flex items-center px-6 py-3 bg-gradient-to-r from-orange-500 to-red-500 text-white rounded-xl font-bold hover:shadow-lg transition-all duration-200 hover:scale-105">
    <i class="fas fa-plus mr-2"></i>Add Menu Item
</a>
@endsection

@section('content')
<!-- Header Stats -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-2xl shadow-lg border border-gray-200/60 p-6 backdrop-blur-sm bg-white/90">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-medium">Total Items</p>
                <p class="text-3xl font-black text-gray-900 mt-2">{{ $menuItems->count() }}</p>
            </div>
            <div class="w-12 h-12 bg-gradient-to-br from-orange-500 to-red-500 rounded-2xl flex items-center justify-center shadow-lg">
                <i class="fas fa-utensils text-white text-xl"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-lg border border-gray-200/60 p-6 backdrop-blur-sm bg-white/90">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-medium">Available</p>
                <p class="text-3xl font-black text-gray-900 mt-2">{{ $menuItems->where('available', true)->count() }}</p>
            </div>
            <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-emerald-500 rounded-2xl flex items-center justify-center shadow-lg">
                <i class="fas fa-check-circle text-white text-xl"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-lg border border-gray-200/60 p-6 backdrop-blur-sm bg-white/90">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-medium">Unavailable</p>
                <p class="text-3xl font-black text-gray-900 mt-2">{{ $menuItems->where('available', false)->count() }}</p>
            </div>
            <div class="w-12 h-12 bg-gradient-to-br from-red-500 to-pink-500 rounded-2xl flex items-center justify-center shadow-lg">
                <i class="fas fa-times-circle text-white text-xl"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-lg border border-gray-200/60 p-6 backdrop-blur-sm bg-white/90">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-medium">Avg Price</p>
                <p class="text-3xl font-black text-gray-900 mt-2">Rp {{ number_format($menuItems->avg('price') ?? 0, 0, ',', '.') }}</p>
            </div>
            <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-500 rounded-2xl flex items-center justify-center shadow-lg">
                <i class="fas fa-money-bill-wave text-white text-xl"></i>
            </div>
        </div>
    </div>
</div>

<!-- Menu Items Table -->
<div class="bg-white rounded-2xl shadow-lg border border-gray-200/60 backdrop-blur-sm bg-white/90">
    <div class="px-6 py-5 border-b border-gray-200/60">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-gradient-to-br from-orange-500 to-red-500 rounded-xl flex items-center justify-center shadow-lg">
                    <i class="fas fa-utensils text-white text-lg"></i>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-gray-900">All Menu Items</h2>
                    <p class="text-sm text-gray-600">Manage your restaurant menu</p>
                </div>
            </div>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-200">
                    <th class="px-6 py-4 text-left text-sm font-bold text-gray-900">Name</th>
                    <th class="px-6 py-4 text-left text-sm font-bold text-gray-900">Price</th>
                    <th class="px-6 py-4 text-left text-sm font-bold text-gray-900">Status</th>
                    <th class="px-6 py-4 text-left text-sm font-bold text-gray-900">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($menuItems as $menuItem)
                <tr class="hover:bg-gray-50 transition-colors duration-150">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-gradient-to-br from-orange-500 to-red-500 rounded-xl flex items-center justify-center mr-3 shadow-lg">
                                <i class="fas fa-utensils text-white text-sm"></i>
                            </div>
                            <div>
                                <span class="font-bold text-gray-900 block">{{ $menuItem->name }}</span>
                                <span class="text-xs text-gray-500">ID: {{ $menuItem->id }}</span>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="font-bold text-gray-900 text-lg">Rp {{ number_format($menuItem->price, 0, ',', '.') }}</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($menuItem->available)
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-bold bg-green-100 text-green-800">
                            <i class="fas fa-check-circle mr-1"></i> Available
                        </span>
                        @else
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-bold bg-red-100 text-red-800">
                            <i class="fas fa-times-circle mr-1"></i> Unavailable
                        </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center space-x-2">
                            <a href="{{ route('supervisor.menu-items.edit', $menuItem) }}" 
                               class="flex items-center px-3 py-2 bg-blue-500 text-white rounded-lg font-semibold hover:bg-blue-600 transition-all duration-200">
                                <i class="fas fa-edit text-sm"></i>
                            </a>
                            <a href="{{ route('supervisor.menu-items.show', $menuItem) }}" 
                               class="flex items-center px-3 py-2 bg-green-500 text-white rounded-lg font-semibold hover:bg-green-600 transition-all duration-200">
                                <i class="fas fa-eye text-sm"></i>
                            </a>
                            <form action="{{ route('supervisor.menu-items.toggle-availability', $menuItem) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" 
                                        class="flex items-center px-3 py-2 {{ $menuItem->available ? 'bg-yellow-500 hover:bg-yellow-600' : 'bg-green-500 hover:bg-green-600' }} text-white rounded-lg font-semibold transition-all duration-200">
                                    <i class="fas fa-toggle-{{ $menuItem->available ? 'on' : 'off' }} text-sm"></i>
                                </button>
                            </form>
                            <form action="{{ route('supervisor.menu-items.destroy', $menuItem) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        onclick="return confirm('Are you sure you want to delete {{ $menuItem->name }}?')"
                                        class="flex items-center px-3 py-2 bg-red-500 text-white rounded-lg font-semibold hover:bg-red-600 transition-all duration-200">
                                    <i class="fas fa-trash text-sm"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @if($menuItems->isEmpty())
    <div class="text-center py-16">
        <div class="w-24 h-24 bg-gradient-to-br from-gray-100 to-gray-200 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg">
            <i class="fas fa-utensils text-gray-400 text-3xl"></i>
        </div>
        <h3 class="text-xl font-bold text-gray-900 mb-2">No menu items found</h3>
        <p class="text-gray-600 mb-6 max-w-md mx-auto">Start building your menu by adding the first delicious item for your customers.</p>
        <a href="{{ route('supervisor.menu-items.create') }}" 
           class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-orange-500 to-red-500 text-white rounded-xl font-bold hover:shadow-lg transition-all duration-200 hover:scale-105">
            <i class="fas fa-plus mr-2"></i>Add First Menu Item
        </a>
    </div>
    @endif
</div>
@endsection