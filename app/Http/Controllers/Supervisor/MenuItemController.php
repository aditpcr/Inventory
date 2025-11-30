<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\MenuItem;
use Illuminate\Http\Request;

class MenuItemController extends Controller
{
    public function index(Request $request)
    {
        $query = MenuItem::with('ingredients');

        // Filter by name
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        // Filter by price range
        if ($request->filled('price_min')) {
            $query->where('price', '>=', $request->price_min);
        }
        if ($request->filled('price_max')) {
            $query->where('price', '<=', $request->price_max);
        }

        // Filter by availability
        if ($request->filled('available')) {
            $query->where('available', $request->available === '1');
        }

        // Get all menu items for stats (before pagination)
        $allMenuItems = MenuItem::with('ingredients')->get();

        // Paginate results
        $menuItems = $query->orderBy('name')->paginate(10)->withQueryString();

        return view('supervisor.menu-items.index', compact('menuItems', 'allMenuItems'));
    }

    public function create()
    {
        $ingredients = \App\Models\Ingredient::all();
        return view('supervisor.menu-items.create', compact('ingredients'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
        ]);

        $menuItem = MenuItem::create($request->only(['name', 'price']));

        return redirect()->route('supervisor.menu-items.index')->with('success', 'Menu item created successfully.');
    }

    public function edit(MenuItem $menuItem)
    {
        return view('supervisor.menu-items.edit', compact('menuItem'));
    }

    public function update(Request $request, MenuItem $menuItem)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
        ]);

        $menuItem->update($request->only(['name', 'price']));

        return redirect()->route('supervisor.menu-items.index')->with('success', 'Menu item updated successfully.');
    }

    public function destroy(MenuItem $menuItem)
    {
        $menuItem->delete();
        return redirect()->route('supervisor.menu-items.index')->with('success', 'Menu item deleted successfully.');
    }

    public function toggleAvailability(MenuItem $menuItem)
    {
        $menuItem->update(['available' => !$menuItem->available]);
        return redirect()->back()->with('success', 'Availability updated successfully.');
    }
}