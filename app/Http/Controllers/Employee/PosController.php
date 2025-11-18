<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\MenuItem;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PosController extends Controller
{
    public function index()
    {
        $menuItems = MenuItem::where('available', true)->get();
        return view('employee.pos.index', compact('menuItems'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'items' => 'required|array|min:1',
            'items.*.menu_item_id' => 'required|exists:menu_items,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        $preparedItems = [];

        // Check stock availability first and prepare order details
        foreach ($request->items as $item) {
            $menuItem = MenuItem::with('menuItemIngredients.ingredient')->findOrFail($item['menu_item_id']);

            if (!$menuItem->canBeMade($item['quantity'])) {
                return back()->with('error', "Insufficient stock for {$menuItem->name}");
            }

            $quantity = (int) $item['quantity'];
            $priceEach = (float) $menuItem->price;

            $preparedItems[] = [
                'menu_item' => $menuItem,
                'quantity' => $quantity,
                'price_each' => $priceEach,
                'subtotal' => $priceEach * $quantity,
            ];
        }

        $total = array_sum(array_column($preparedItems, 'subtotal'));

        $order = null;

        try {
            DB::transaction(function () use (&$order, $preparedItems, $total) {
                $order = Order::create([
                    'employee_id' => auth()->id(),
                    'total_price' => $total,
                ]);

                foreach ($preparedItems as $preparedItem) {
                    /** @var \App\Models\MenuItem $menuItem */
                    $menuItem = $preparedItem['menu_item'];

                    OrderItem::create([
                        'order_id' => $order->id,
                        'menu_item_id' => $menuItem->id,
                        'quantity' => $preparedItem['quantity'],
                        'price_each' => $preparedItem['price_each'],
                    ]);

                    $menuItem->deductIngredients($preparedItem['quantity']);
                }
            });
        } catch (\RuntimeException $exception) {
            return back()->with('error', $exception->getMessage());
        } catch (\Throwable $throwable) {
            report($throwable);
            return back()->with('error', 'Failed to place order. Please try again.');
        }

        return redirect()->route('employee.orders.show', $order)->with('success', 'Order placed successfully! Stock has been deducted.');
    }
}