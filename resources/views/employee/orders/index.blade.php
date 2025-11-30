@extends('layouts.app')

@section('title', 'Order History')
@section('subtitle', 'View and manage order history')

@section('breadcrumbs')
<div class="flex items-center" style="gap: var(--space-2); font-size: var(--text-sm);">
    <span class="text-secondary font-medium">Orders</span>
</div>
@endsection

@section('content')
<div class="container">
    <!-- Header Stats -->
    <div class="grid" style="grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: var(--space-6); margin-bottom: var(--space-8);">
        <div class="card">
            <div class="card-body">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-secondary font-medium">Total Orders</p>
                        <p class="text-3xl font-bold text-primary" style="margin-top: var(--space-2);">{{ $orders->count() }}</p>
                    </div>
                    <div style="width: 48px; height: 48px; background: var(--accent-color); border-radius: var(--radius-lg); display: flex; align-items: center; justify-content: center; box-shadow: var(--shadow-base);">
                        <i class="fas fa-receipt" style="color: var(--primary-dark); font-size: var(--text-xl);"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-secondary font-medium">Today's Orders</p>
                        <p class="text-3xl font-bold text-primary" style="margin-top: var(--space-2);">
                            {{ $orders->where('created_at', '>=', \Carbon\Carbon::today())->count() }}
                        </p>
                    </div>
                    <div style="width: 48px; height: 48px; background: #28a745; border-radius: var(--radius-lg); display: flex; align-items: center; justify-content: center; box-shadow: var(--shadow-base);">
                        <i class="fas fa-calendar-day" style="color: white; font-size: var(--text-xl);"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-secondary font-medium">Total Revenue</p>
                        <p class="text-3xl font-bold text-primary" style="margin-top: var(--space-2);">
                            Rp {{ number_format($orders->sum('total_price'), 0, ',', '.') }}
                        </p>
                    </div>
                    <div style="width: 48px; height: 48px; background: #f59e0b; border-radius: var(--radius-lg); display: flex; align-items: center; justify-content: center; box-shadow: var(--shadow-base);">
                        <i class="fas fa-money-bill-wave" style="color: white; font-size: var(--text-xl);"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-secondary font-medium">Avg Order Value</p>
                        <p class="text-3xl font-bold text-primary" style="margin-top: var(--space-2);">
                            @php
                                $avgOrder = $orders->count() > 0 ? $orders->avg('total_price') : 0;
                            @endphp
                            Rp {{ number_format($avgOrder, 0, ',', '.') }}
                        </p>
                    </div>
                    <div style="width: 48px; height: 48px; background: var(--accent-color); border-radius: var(--radius-lg); display: flex; align-items: center; justify-content: center; box-shadow: var(--shadow-base);">
                        <i class="fas fa-chart-line" style="color: var(--primary-dark); font-size: var(--text-xl);"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Orders Table -->
    <div class="card">
        <div class="card-header">
            <div class="flex items-center justify-between">
                <div class="flex items-center" style="gap: var(--space-3);">
                    <div style="width: 40px; height: 40px; background: var(--accent-color); border-radius: var(--radius-lg); display: flex; align-items: center; justify-content: center; box-shadow: var(--shadow-base);">
                        <i class="fas fa-receipt" style="color: var(--primary-dark); font-size: var(--text-lg);"></i>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-primary">Order History</h2>
                        <p class="text-sm text-secondary">All processed orders</p>
                    </div>
                </div>
            </div>
        </div>

        <div style="overflow-x: auto;">
            <table class="table">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Date</th>
                        <th>Items</th>
                        <th>Total Amount</th>
                        <th>Processed By</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td>
                            <div class="flex items-center">
                                <div style="width: 40px; height: 40px; background: var(--accent-color); border-radius: var(--radius-lg); display: flex; align-items: center; justify-content: center; margin-right: var(--space-3); box-shadow: var(--shadow-base);">
                                    <i class="fas fa-receipt" style="color: var(--primary-dark); font-size: var(--text-sm);"></i>
                                </div>
                                <div>
                                    <span class="font-bold text-primary block">#{{ $order->id }}</span>
                                    <span class="text-xs text-secondary">Order</span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="text-sm font-medium text-primary">{{ $order->created_at->format('M j, Y') }}</span>
                            <br>
                            <span class="text-xs text-secondary">{{ $order->created_at->format('g:i A') }}</span>
                        </td>
                        <td>
                            <span class="badge badge-info">
                                <i class="fas fa-boxes" style="margin-right: var(--space-1);"></i> {{ $order->orderItems->count() }} items
                            </span>
                        </td>
                        <td>
                            <span class="font-bold text-accent" style="font-size: var(--text-lg);">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                        </td>
                        <td>
                            <span class="text-sm font-medium text-primary">{{ $order->employee->name }}</span>
                        </td>
                        <td>
                            <div class="flex items-center" style="gap: var(--space-2);">
                                <a href="{{ route('employee.orders.show', $order) }}" class="btn btn-outline" style="padding: var(--space-2) var(--space-3); background: #28a745; color: white; border-color: #28a745;">
                                    <i class="fas fa-eye" style="font-size: var(--text-sm);"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if($orders->isEmpty())
        <div class="card-body text-center" style="padding: var(--space-16);">
            <div style="width: 96px; height: 96px; background: var(--background-light); border-radius: var(--radius-xl); display: flex; align-items: center; justify-content: center; margin: 0 auto var(--space-4); box-shadow: var(--shadow-base);">
                <i class="fas fa-receipt" style="color: var(--text-light); font-size: var(--text-3xl);"></i>
            </div>
            <h3 class="text-xl font-bold text-primary" style="margin-bottom: var(--space-2);">No orders found</h3>
            <p class="text-secondary" style="margin-bottom: var(--space-6); max-width: 400px; margin-left: auto; margin-right: auto;">Start processing orders through the POS system.</p>
            <a href="{{ route('employee.pos') }}" class="btn btn-primary">
                <i class="fas fa-plus" style="margin-right: var(--space-2);"></i>Create First Order
            </a>
        </div>
        @endif
    </div>
</div>
@endsection
