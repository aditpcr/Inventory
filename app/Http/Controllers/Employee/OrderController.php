<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\MenuItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['orderItems.menuItem', 'employee'])->latest()->get();
        return view('employee.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load(['orderItems.menuItem', 'employee']);
        return view('employee.orders.show', compact('order'));
    }
}