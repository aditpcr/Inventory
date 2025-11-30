@extends('layouts.app')

@section('title', 'Order #' . $order->id)
@section('subtitle', 'Order details and information')

@section('breadcrumbs')
<div class="flex items-center" style="gap: var(--space-2); font-size: var(--text-sm);">
    <a href="{{ route('employee.orders.index') }}" class="text-accent font-medium flex items-center nav-link">
        <i class="fas fa-list-alt" style="margin-right: var(--space-2);"></i>Orders
    </a>
    <i class="fas fa-chevron-right text-light" style="font-size: var(--text-xs);"></i>
    <span class="text-secondary font-medium">Order #{{ $order->id }}</span>
</div>
@endsection

@section('content')
<div class="container">
    <div class="grid" style="grid-template-columns: 1fr; gap: var(--space-6);">
        <!-- Order Details -->
        <div style="grid-column: 1 / -1;">
            <div class="card">
                <div class="card-header">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center" style="gap: var(--space-3);">
                            <div style="width: 40px; height: 40px; background: var(--accent-color); border-radius: var(--radius-lg); display: flex; align-items: center; justify-content: center; box-shadow: var(--shadow-base);">
                                <i class="fas fa-receipt" style="color: var(--primary-dark); font-size: var(--text-lg);"></i>
                            </div>
                            <div>
                                <h2 class="text-xl font-bold text-primary">Order #{{ $order->id }}</h2>
                                <p class="text-sm text-secondary">Order details and items</p>
                            </div>
                        </div>
                        <span class="badge badge-success">
                            <i class="fas fa-check-circle" style="margin-right: var(--space-1);"></i> Completed
                        </span>
                    </div>
                </div>
                
                <div class="card-body" style="display: flex; flex-direction: column; gap: var(--space-6);">
                    <!-- Order Items -->
                    <div>
                        <h3 class="text-lg font-bold text-primary" style="margin-bottom: var(--space-4); display: flex; align-items: center;">
                            <i class="fas fa-utensils" style="margin-right: var(--space-2); color: var(--accent-color);"></i>Order Items
                        </h3>
                        <div style="display: flex; flex-direction: column; gap: var(--space-3);">
                            @foreach($order->orderItems as $orderItem)
                            <div class="card" style="background: var(--background-light); border-color: var(--border-light);">
                                <div class="card-body">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center" style="gap: var(--space-4);">
                                            <div style="width: 48px; height: 48px; background: var(--accent-color); border-radius: var(--radius-lg); display: flex; align-items: center; justify-content: center; box-shadow: var(--shadow-base);">
                                                <i class="fas fa-utensils" style="color: var(--primary-dark);"></i>
                                            </div>
                                            <div>
                                                <h4 class="font-bold text-primary" style="font-size: var(--text-lg);">{{ $orderItem->menuItem->name }}</h4>
                                                <p class="text-sm text-secondary">Quantity: {{ $orderItem->quantity }}</p>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-lg font-bold text-accent">
                                                Rp {{ number_format($orderItem->menuItem->price * $orderItem->quantity, 0, ',', '.') }}
                                            </p>
                                            <p class="text-sm text-secondary">
                                                Rp {{ number_format($orderItem->menuItem->price, 0, ',', '.') }} each
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Order Summary -->
                    <div style="border-top: 1px solid var(--border-light); padding-top: var(--space-6);">
                        <div style="display: flex; flex-direction: column; gap: var(--space-2);">
                            <div class="flex justify-between items-center">
                                <span class="text-lg font-medium text-secondary">Subtotal:</span>
                                <span class="text-lg font-bold text-primary">
                                    Rp {{ number_format($order->total_price / 1.1, 0, ',', '.') }}
                                </span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-lg font-medium text-secondary">Tax (10%):</span>
                                <span class="text-lg font-bold text-primary">
                                    Rp {{ number_format($order->total_price * 0.1, 0, ',', '.') }}
                                </span>
                            </div>
                            <div class="flex justify-between items-center" style="border-top: 1px solid var(--border-light); padding-top: var(--space-2);">
                                <span class="text-xl font-bold text-primary">Total:</span>
                                <span class="text-2xl font-bold text-accent">
                                    Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Order Information & Actions -->
        <div style="display: flex; flex-direction: column; gap: var(--space-6);">
            <!-- Order Information -->
            <div class="card">
                <div class="card-header">
                    <h3 class="text-lg font-bold text-primary">Order Information</h3>
                </div>
                <div class="card-body" style="display: flex; flex-direction: column; gap: var(--space-4);">
                    <div class="flex justify-between items-center">
                        <span class="text-secondary font-medium">Order ID:</span>
                        <span class="font-bold text-primary">#{{ $order->id }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-secondary font-medium">Processed by:</span>
                        <span class="font-bold text-primary">{{ $order->employee->name }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-secondary font-medium">Order Date:</span>
                        <span class="font-bold text-primary">{{ $order->created_at->format('M j, Y g:i A') }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-secondary font-medium">Total Items:</span>
                        <span class="font-bold text-primary">{{ $order->orderItems->count() }}</span>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="card">
                <div class="card-header">
                    <h3 class="text-lg font-bold text-primary">Quick Actions</h3>
                </div>
                <div class="card-body" style="display: flex; flex-direction: column; gap: var(--space-3);">
                    <a href="{{ route('employee.orders.index') }}" class="btn btn-primary w-full">
                        <i class="fas fa-arrow-left" style="margin-right: var(--space-2);"></i>Back to Orders
                    </a>
                    <a href="{{ route('employee.pos') }}" class="btn w-full" style="background: #28a745; color: white; border: none;">
                        <i class="fas fa-plus" style="margin-right: var(--space-2);"></i>New Order
                    </a>
                    <button onclick="window.print()" class="btn btn-outline w-full">
                        <i class="fas fa-print" style="margin-right: var(--space-2);"></i>Print Receipt
                    </button>
                </div>
            </div>

            <!-- Order Timeline -->
            <div class="card">
                <div class="card-header">
                    <h3 class="text-lg font-bold text-primary">Order Timeline</h3>
                </div>
                <div class="card-body">
                    <div style="display: flex; flex-direction: column; gap: var(--space-4);">
                        <div class="flex items-start" style="gap: var(--space-3);">
                            <div style="width: 32px; height: 32px; background: #28a745; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0; margin-top: var(--space-1);">
                                <i class="fas fa-check" style="color: white; font-size: var(--text-xs);"></i>
                            </div>
                            <div>
                                <p class="font-medium text-primary">Order Placed</p>
                                <p class="text-sm text-secondary">{{ $order->created_at->format('M j, Y g:i A') }}</p>
                            </div>
                        </div>
                        <div class="flex items-start" style="gap: var(--space-3);">
                            <div style="width: 32px; height: 32px; background: #28a745; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0; margin-top: var(--space-1);">
                                <i class="fas fa-check" style="color: white; font-size: var(--text-xs);"></i>
                            </div>
                            <div>
                                <p class="font-medium text-primary">Order Completed</p>
                                <p class="text-sm text-secondary">{{ $order->created_at->format('M j, Y g:i A') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    @media (min-width: 1024px) {
        .container > .grid {
            grid-template-columns: 2fr 1fr;
        }
    }
    
    @media print {
        body {
            background: white !important;
        }
        .card {
            background: white !important;
            box-shadow: none !important;
            border: 1px solid #000 !important;
        }
        .no-print {
            display: none !important;
        }
    }
</style>
@endsection
