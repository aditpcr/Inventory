@extends('layouts.app')

@section('title', 'Menu Items Management')
@section('subtitle', 'Manage restaurant menu items and availability')

@section('breadcrumbs')
<div class="flex items-center" style="gap: var(--space-2); font-size: var(--text-sm);">
    <span class="text-secondary font-medium">Menu Items</span>
</div>
@endsection

@section('actions')
<a href="{{ route('supervisor.menu-items.create') }}" class="btn btn-primary">
    <i class="fas fa-plus" style="margin-right: var(--space-2);"></i>Add Menu Item
</a>
@endsection

@section('content')
<div class="container">
    <!-- Header Stats -->
    <div class="grid" style="grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: var(--space-6); margin-bottom: var(--space-8);">
        <div class="card">
            <div class="card-body">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-secondary font-medium">Total Items</p>
                        <p class="text-3xl font-bold text-primary" style="margin-top: var(--space-2);">{{ $allMenuItems->count() }}</p>
                    </div>
                    <div style="width: 48px; height: 48px; background: var(--accent-color); border-radius: var(--radius-lg); display: flex; align-items: center; justify-content: center; box-shadow: var(--shadow-base);">
                        <i class="fas fa-utensils" style="color: var(--primary-dark); font-size: var(--text-xl);"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-secondary font-medium">Available</p>
                        <p class="text-3xl font-bold text-primary" style="margin-top: var(--space-2);">{{ $allMenuItems->where('available', true)->count() }}</p>
                    </div>
                    <div style="width: 48px; height: 48px; background: #28a745; border-radius: var(--radius-lg); display: flex; align-items: center; justify-content: center; box-shadow: var(--shadow-base);">
                        <i class="fas fa-check-circle" style="color: white; font-size: var(--text-xl);"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-secondary font-medium">Unavailable</p>
                        <p class="text-3xl font-bold text-primary" style="margin-top: var(--space-2);">{{ $allMenuItems->where('available', false)->count() }}</p>
                    </div>
                    <div style="width: 48px; height: 48px; background: #dc3545; border-radius: var(--radius-lg); display: flex; align-items: center; justify-content: center; box-shadow: var(--shadow-base);">
                        <i class="fas fa-times-circle" style="color: white; font-size: var(--text-xl);"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-secondary font-medium">Avg Price</p>
                        <p class="text-3xl font-bold text-primary" style="margin-top: var(--space-2);">Rp {{ number_format($allMenuItems->avg('price') ?? 0, 0, ',', '.') }}</p>
                    </div>
                    <div style="width: 48px; height: 48px; background: var(--accent-color); border-radius: var(--radius-lg); display: flex; align-items: center; justify-content: center; box-shadow: var(--shadow-base);">
                        <i class="fas fa-money-bill-wave" style="color: var(--primary-dark); font-size: var(--text-xl);"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="card" style="margin-bottom: var(--space-6);">
        <div class="card-body">
            <form method="GET" action="{{ route('supervisor.menu-items.index') }}" class="flex items-center" style="gap: var(--space-4); flex-wrap: wrap;">
                <div style="flex: 1; min-width: 200px;">
                    <label class="form-label">Search by Name</label>
                    <input type="text" name="name" value="{{ request('name') }}" placeholder="Menu item name..." class="form-input">
                </div>
                <div style="flex: 1; min-width: 150px;">
                    <label class="form-label">Min Price</label>
                    <input type="number" name="price_min" value="{{ request('price_min') }}" placeholder="0" step="0.01" class="form-input">
                </div>
                <div style="flex: 1; min-width: 150px;">
                    <label class="form-label">Max Price</label>
                    <input type="number" name="price_max" value="{{ request('price_max') }}" placeholder="999999" step="0.01" class="form-input">
                </div>
                <div style="flex: 1; min-width: 150px;">
                    <label class="form-label">Availability</label>
                    <select name="available" class="form-input">
                        <option value="">All</option>
                        <option value="1" {{ request('available') === '1' ? 'selected' : '' }}>Available</option>
                        <option value="0" {{ request('available') === '0' ? 'selected' : '' }}>Unavailable</option>
                    </select>
                </div>
                <div style="display: flex; gap: var(--space-2); align-items: flex-end;">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search" style="margin-right: var(--space-2);"></i>Filter
                    </button>
                    <a href="{{ route('supervisor.menu-items.index') }}" class="btn btn-outline">
                        <i class="fas fa-times" style="margin-right: var(--space-2);"></i>Clear
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Menu Items Table -->
    <div class="card">
        <div class="card-header">
            <div class="flex items-center justify-between">
                <div class="flex items-center" style="gap: var(--space-3);">
                    <div style="width: 40px; height: 40px; background: var(--accent-color); border-radius: var(--radius-lg); display: flex; align-items: center; justify-content: center; box-shadow: var(--shadow-base);">
                        <i class="fas fa-utensils" style="color: var(--primary-dark); font-size: var(--text-lg);"></i>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-primary">All Menu Items</h2>
                        <p class="text-sm text-secondary">Manage your restaurant menu</p>
                    </div>
                </div>
            </div>
        </div>

        <div style="overflow-x: auto;">
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($menuItems as $menuItem)
                    <tr>
                        <td>
                            <div class="flex items-center">
                                <div style="width: 40px; height: 40px; background: var(--accent-color); border-radius: var(--radius-lg); display: flex; align-items: center; justify-content: center; margin-right: var(--space-3); box-shadow: var(--shadow-base);">
                                    <i class="fas fa-utensils" style="color: var(--primary-dark); font-size: var(--text-sm);"></i>
                                </div>
                                <div>
                                    <span class="font-bold text-primary block">{{ $menuItem->name }}</span>
                                    <span class="text-xs text-secondary">ID: {{ $menuItem->id }}</span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="font-bold text-primary" style="font-size: var(--text-lg);">Rp {{ number_format($menuItem->price, 0, ',', '.') }}</span>
                        </td>
                        <td>
                            @if($menuItem->available)
                            <span class="badge badge-success">
                                <i class="fas fa-check-circle" style="margin-right: var(--space-1);"></i> Available
                            </span>
                            @else
                            <span class="badge badge-danger">
                                <i class="fas fa-times-circle" style="margin-right: var(--space-1);"></i> Unavailable
                            </span>
                            @endif
                        </td>
                        <td>
                            <div class="flex items-center" style="gap: var(--space-2);">
                                <a href="{{ route('supervisor.menu-items.edit', $menuItem) }}" class="btn btn-primary" style="padding: var(--space-2) var(--space-3);">
                                    <i class="fas fa-edit" style="font-size: var(--text-sm);"></i>
                                </a>
                                <a href="{{ route('supervisor.menu-items.show', $menuItem) }}" class="btn btn-outline" style="padding: var(--space-2) var(--space-3); background: #28a745; color: white; border-color: #28a745;">
                                    <i class="fas fa-eye" style="font-size: var(--text-sm);"></i>
                                </a>
                                <form action="{{ route('supervisor.menu-items.toggle-availability', $menuItem) }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" 
                                            class="btn" style="padding: var(--space-2) var(--space-3); background: {{ $menuItem->available ? 'var(--accent-color)' : '#28a745' }}; color: var(--primary-dark); border: none;">
                                        <i class="fas fa-toggle-{{ $menuItem->available ? 'on' : 'off' }}" style="font-size: var(--text-sm);"></i>
                                    </button>
                                </form>
                                <form action="{{ route('supervisor.menu-items.destroy', $menuItem) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            onclick="return confirm('Are you sure you want to delete {{ $menuItem->name }}?')"
                                            class="btn" style="padding: var(--space-2) var(--space-3); background: #dc3545; color: white; border: none;">
                                        <i class="fas fa-trash" style="font-size: var(--text-sm);"></i>
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
        <div class="card-body text-center" style="padding: var(--space-16);">
            <div style="width: 96px; height: 96px; background: var(--background-light); border-radius: var(--radius-xl); display: flex; align-items: center; justify-content: center; margin: 0 auto var(--space-4); box-shadow: var(--shadow-base);">
                <i class="fas fa-utensils" style="color: var(--text-light); font-size: var(--text-3xl);"></i>
            </div>
            <h3 class="text-xl font-bold text-primary" style="margin-bottom: var(--space-2);">No menu items found</h3>
            <p class="text-secondary" style="margin-bottom: var(--space-6); max-width: 400px; margin-left: auto; margin-right: auto;">Start building your menu by adding the first delicious item for your customers.</p>
            <a href="{{ route('supervisor.menu-items.create') }}" class="btn btn-primary">
                <i class="fas fa-plus" style="margin-right: var(--space-2);"></i>Add First Menu Item
            </a>
        </div>
        @endif

        <!-- Pagination -->
        @if($menuItems->hasPages())
        <div class="card-footer" style="padding: var(--space-4) var(--space-6); border-top: 1px solid var(--border-light);">
            <div class="pagination-wrapper">
                <div class="pagination-info">
                    <span class="pagination-text">
                        Showing {{ $menuItems->firstItem() }} to {{ $menuItems->lastItem() }} of {{ $menuItems->total() }} results
                    </span>
                </div>
                <nav aria-label="Page navigation">
                    {{ $menuItems->links() }}
                </nav>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
