@extends('layouts.app')

@section('title', 'Order #' . $order->id)
@section('subtitle', 'Order details and information')

@section('breadcrumbs')
<div class="flex items-center space-x-2 text-sm">
    <a href="{{ route('employee.orders.index') }}" class="text-blue-600 hover:text-blue-700 font-medium flex items-center">
        <i class="fas fa-list-alt mr-2"></i>Orders
    </a>
    <i class="fas fa-chevron-right text-gray-400 text-xs"></i>
    <span class="text-gray-500 font-medium">Order #{{ $order->id }}</span>
</div>
@endsection

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Order Details -->
    <div class="lg:col-span-2">
        <div class="bg-white rounded-2xl shadow-lg border border-gray-200/60 backdrop-blur-sm bg-white/90">
            <div class="px-6 py-5 border-b border-gray-200/60">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-500 rounded-xl flex items-center justify-center shadow-lg">
                            <i class="fas fa-receipt text-white text-lg"></i>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold text-gray-900">Order #{{ $order->id }}</h2>
                            <p class="text-sm text-gray-600">Order details and items</p>
                        </div>
                    </div>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-bold bg-green-100 text-green-800">
                        <i class="fas fa-check-circle mr-1"></i> Completed
                    </span>
                </div>
            </div>
            
            <div class="p-6 space-y-6">
                <!-- Order Items -->
                <div>
                    <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-utensils mr-2 text-orange-500"></i>Order Items
                    </h3>
                    <div class="space-y-3">
                        @foreach($order->orderItems as $orderItem)
                        <div class="flex items-center justify-between p-4 bg-gradient-to-r from-gray-50 to-gray-100 rounded-xl border border-gray-200">
                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 bg-gradient-to-br from-orange-500 to-red-500 rounded-xl flex items-center justify-center shadow-lg">
                                    <i class="fas fa-utensils text-white"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-900 text-lg">{{ $orderItem->menuItem->name }}</h4>
                                    <p class="text-sm text-gray-600">Quantity: {{ $orderItem->quantity }}</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-lg font-bold text-green-600">
                                    Rp {{ number_format($orderItem->menuItem->price * $orderItem->quantity, 0, ',', '.') }}
                                </p>
                                <p class="text-sm text-gray-600">
                                    Rp {{ number_format($orderItem->menuItem->price, 0, ',', '.') }} each
                                </p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="border-t border-gray-200 pt-6">
                    <div class="space-y-2">
                        <div class="flex justify-between items-center">
                            <span class="text-lg font-semibold text-gray-700">Subtotal:</span>
                            <span class="text-lg font-bold text-gray-900">
                                Rp {{ number_format($order->total_price / 1.1, 0, ',', '.') }}
                            </span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-lg font-semibold text-gray-700">Tax (10%):</span>
                            <span class="text-lg font-bold text-gray-900">
                                Rp {{ number_format($order->total_price * 0.1, 0, ',', '.') }}
                            </span>
                        </div>
                        <div class="flex justify-between items-center border-t border-gray-200 pt-2">
                            <span class="text-xl font-bold text-gray-900">Total:</span>
                            <span class="text-2xl font-black text-green-600">
                                Rp {{ number_format($order->total_price, 0, ',', '.') }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Order Information & Actions -->
    <div class="space-y-6">
        <!-- Order Information -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-200/60 backdrop-blur-sm bg-white/90">
            <div class="px-6 py-5 border-b border-gray-200/60">
                <h3 class="text-lg font-bold text-gray-900">Order Information</h3>
            </div>
            <div class="p-6 space-y-4">
                <div class="flex justify-between items-center">
                    <span class="text-gray-600 font-medium">Order ID:</span>
                    <span class="font-bold text-gray-900">#{{ $order->id }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-gray-600 font-medium">Processed by:</span>
                    <span class="font-bold text-gray-900">{{ $order->employee->name }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-gray-600 font-medium">Order Date:</span>
                    <span class="font-bold text-gray-900">{{ $order->created_at->format('M j, Y g:i A') }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-gray-600 font-medium">Total Items:</span>
                    <span class="font-bold text-gray-900">{{ $order->orderItems->count() }}</span>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-200/60 backdrop-blur-sm bg-white/90">
            <div class="px-6 py-5 border-b border-gray-200/60">
                <h3 class="text-lg font-bold text-gray-900">Quick Actions</h3>
            </div>
            <div class="p-6 space-y-3">
                <a href="{{ route('employee.orders.index') }}" 
                   class="flex items-center justify-center w-full px-4 py-3 bg-gradient-to-r from-blue-500 to-purple-500 text-white rounded-xl font-bold hover:shadow-lg transition-all duration-200 hover:scale-105">
                    <i class="fas fa-arrow-left mr-2"></i>Back to Orders
                </a>
                <a href="{{ route('employee.pos') }}" 
                   class="flex items-center justify-center w-full px-4 py-3 bg-gradient-to-r from-green-500 to-emerald-500 text-white rounded-xl font-bold hover:shadow-lg transition-all duration-200 hover:scale-105">
                    <i class="fas fa-plus mr-2"></i>New Order
                </a>
                <button onclick="window.print()" 
                        class="flex items-center justify-center w-full px-4 py-3 bg-gradient-to-r from-gray-500 to-gray-700 text-white rounded-xl font-bold hover:shadow-lg transition-all duration-200 hover:scale-105">
                    <i class="fas fa-print mr-2"></i>Print Receipt
                </button>
            </div>
        </div>

        <!-- Order Timeline -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-200/60 backdrop-blur-sm bg-white/90">
            <div class="px-6 py-5 border-b border-gray-200/60">
                <h3 class="text-lg font-bold text-gray-900">Order Timeline</h3>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    <div class="flex items-start space-x-3">
                        <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                            <i class="fas fa-check text-white text-xs"></i>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-900">Order Placed</p>
                            <p class="text-sm text-gray-600">{{ $order->created_at->format('M j, Y g:i A') }}</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                            <i class="fas fa-check text-white text-xs"></i>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-900">Order Completed</p>
                            <p class="text-sm text-gray-600">{{ $order->created_at->format('M j, Y g:i A') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Print Styles -->
<style>
@media print {
    .bg-white {
        background: white !important;
    }
    .shadow-lg {
        box-shadow: none !important;
    }
    .border {
        border: 1px solid #000 !important;
    }
    .no-print {
        display: none !important;
    }
}
</style>
@endsection