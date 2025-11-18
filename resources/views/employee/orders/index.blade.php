@extends('layouts.app')

@section('title', 'Order History')
@section('subtitle', 'View and manage order history')

@section('breadcrumbs')
<div class="flex items-center space-x-2 text-sm">
    <span class="text-gray-500 font-medium">Orders</span>
</div>
@endsection

@section('content')
<!-- Header Stats -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-2xl shadow-lg border border-gray-200/60 p-6 backdrop-blur-sm bg-white/90">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-medium">Total Orders</p>
                <p class="text-3xl font-black text-gray-900 mt-2">{{ $orders->count() }}</p>
            </div>
            <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-500 rounded-2xl flex items-center justify-center shadow-lg">
                <i class="fas fa-receipt text-white text-xl"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-lg border border-gray-200/60 p-6 backdrop-blur-sm bg-white/90">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-medium">Today's Orders</p>
                <p class="text-3xl font-black text-gray-900 mt-2">
                    {{ $orders->where('created_at', '>=', \Carbon\Carbon::today())->count() }}
                </p>
            </div>
            <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-emerald-500 rounded-2xl flex items-center justify-center shadow-lg">
                <i class="fas fa-calendar-day text-white text-xl"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-lg border border-gray-200/60 p-6 backdrop-blur-sm bg-white/90">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-medium">Total Revenue</p>
                <p class="text-3xl font-black text-gray-900 mt-2">
                    Rp {{ number_format($orders->sum('total_price'), 0, ',', '.') }}
                </p>
            </div>
            <div class="w-12 h-12 bg-gradient-to-br from-orange-500 to-red-500 rounded-2xl flex items-center justify-center shadow-lg">
                <i class="fas fa-money-bill-wave text-white text-xl"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-lg border border-gray-200/60 p-6 backdrop-blur-sm bg-white/90">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-medium">Avg Order Value</p>
                <p class="text-3xl font-black text-gray-900 mt-2">
                    @php
                        $avgOrder = $orders->count() > 0 ? $orders->avg('total_price') : 0;
                    @endphp
                    Rp {{ number_format($avgOrder, 0, ',', '.') }}
                </p>
            </div>
            <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-pink-500 rounded-2xl flex items-center justify-center shadow-lg">
                <i class="fas fa-chart-line text-white text-xl"></i>
            </div>
        </div>
    </div>
</div>

<!-- Orders Table -->
<div class="bg-white rounded-2xl shadow-lg border border-gray-200/60 backdrop-blur-sm bg-white/90">
    <div class="px-6 py-5 border-b border-gray-200/60">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-500 rounded-xl flex items-center justify-center shadow-lg">
                    <i class="fas fa-receipt text-white text-lg"></i>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-gray-900">Order History</h2>
                    <p class="text-sm text-gray-600">All processed orders</p>
                </div>
            </div>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-200">
                    <th class="px-6 py-4 text-left text-sm font-bold text-gray-900">Order ID</th>
                    <th class="px-6 py-4 text-left text-sm font-bold text-gray-900">Date</th>
                    <th class="px-6 py-4 text-left text-sm font-bold text-gray-900">Items</th>
                    <th class="px-6 py-4 text-left text-sm font-bold text-gray-900">Total Amount</th>
                    <th class="px-6 py-4 text-left text-sm font-bold text-gray-900">Processed By</th>
                    <th class="px-6 py-4 text-left text-sm font-bold text-gray-900">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($orders as $order)
                <tr class="hover:bg-gray-50 transition-colors duration-150">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-500 rounded-xl flex items-center justify-center mr-3 shadow-lg">
                                <i class="fas fa-receipt text-white text-sm"></i>
                            </div>
                            <div>
                                <span class="font-bold text-gray-900 block">#{{ $order->id }}</span>
                                <span class="text-xs text-gray-500">Order</span>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="text-sm font-medium text-gray-900">{{ $order->created_at->format('M j, Y') }}</span>
                        <br>
                        <span class="text-xs text-gray-500">{{ $order->created_at->format('g:i A') }}</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-bold bg-blue-100 text-blue-800">
                            <i class="fas fa-boxes mr-1"></i> {{ $order->orderItems->count() }} items
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="font-bold text-green-600 text-lg">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="text-sm font-medium text-gray-900">{{ $order->employee->name }}</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center space-x-2">
                            <a href="{{ route('employee.orders.show', $order) }}" 
                               class="flex items-center px-3 py-2 bg-green-500 text-white rounded-lg font-semibold hover:bg-green-600 transition-all duration-200">
                                <i class="fas fa-eye text-sm"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @if($orders->isEmpty())
    <div class="text-center py-16">
        <div class="w-24 h-24 bg-gradient-to-br from-gray-100 to-gray-200 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg">
            <i class="fas fa-receipt text-gray-400 text-3xl"></i>
        </div>
        <h3 class="text-xl font-bold text-gray-900 mb-2">No orders found</h3>
        <p class="text-gray-600 mb-6 max-w-md mx-auto">Start processing orders through the POS system.</p>
        <a href="{{ route('employee.pos') }}" 
           class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-green-500 to-emerald-500 text-white rounded-xl font-bold hover:shadow-lg transition-all duration-200 hover:scale-105">
            <i class="fas fa-plus mr-2"></i>Create First Order
        </a>
    </div>
    @endif
</div>
@endsection