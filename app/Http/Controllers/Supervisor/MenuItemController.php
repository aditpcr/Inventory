<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\MenuItem;
use Illuminate\Http\Request;

class MenuItemController extends Controller
{
    public function index()
    {
        $menuItems = MenuItem::with('ingredients')->get();
        return view('supervisor.menu-items.index', compact('menuItems'));
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