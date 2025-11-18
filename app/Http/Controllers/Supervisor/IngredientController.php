<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\Ingredient;
use Illuminate\Http\Request;

class IngredientController extends Controller
{
    public function index()
    {
        $ingredients = Ingredient::all();
        return view('supervisor.ingredients.index', compact('ingredients'));
    }

    public function create()
    {
        return view('supervisor.ingredients.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'unit' => 'required|string|max:50',
            'stock_quantity' => 'required|numeric|min:0',
            'low_stock_threshold' => 'required|numeric|min:0',
        ]);

        Ingredient::create($request->all());

        return redirect()->route('supervisor.ingredients.index')->with('success', 'Ingredient created successfully.');
    }

    // Add this missing method
    public function show(Ingredient $ingredient)
    {
        return view('supervisor.ingredients.show', compact('ingredient'));
    }

    public function edit(Ingredient $ingredient)
    {
        return view('supervisor.ingredients.edit', compact('ingredient'));
    }

    public function update(Request $request, Ingredient $ingredient)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'unit' => 'required|string|max:50',
            'stock_quantity' => 'required|numeric|min:0',
            'low_stock_threshold' => 'required|numeric|min:0',
        ]);

        $ingredient->update($request->all());

        return redirect()->route('supervisor.ingredients.index')->with('success', 'Ingredient updated successfully.');
    }

    public function destroy(Ingredient $ingredient)
    {
        $ingredient->delete();
        return redirect()->route('supervisor.ingredients.index')->with('success', 'Ingredient deleted successfully.');
    }

    public function adjustStock(Request $request, Ingredient $ingredient)
    {
        $request->validate([
            'adjustment' => 'required|numeric',
            'reason' => 'required|string|max:255',
        ]);

        $ingredient->update([
            'stock_quantity' => $ingredient->stock_quantity + $request->adjustment
        ]);

        return redirect()->route('supervisor.ingredients.index')->with('success', 'Stock adjusted successfully.');
    }
}