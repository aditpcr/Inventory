<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\MenuItem;
use App\Models\MenuItemIngredient;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    public function index()
    {
        // Paginate menu items - 2 per page
        $menuItems = MenuItem::with('menuItemIngredients.ingredient')
            ->orderBy('name')
            ->paginate(2);
        
        return view('supervisor.recipes.index', compact('menuItems'));
    }

    public function create()
    {
        $menuItems = MenuItem::all();
        $ingredients = \App\Models\Ingredient::all();
        return view('supervisor.recipes.create', compact('menuItems', 'ingredients'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'menu_item_id' => 'required|exists:menu_items,id',
            'ingredient_id' => 'required|exists:ingredients,id',
            'quantity_needed' => 'required|numeric|min:0',
        ]);

        MenuItemIngredient::create($request->all());

        return redirect()->route('supervisor.recipes.index')->with('success', 'Recipe ingredient added successfully.');
    }

    public function edit(MenuItemIngredient $recipe)
    {
        $menuItems = MenuItem::all();
        $ingredients = \App\Models\Ingredient::all();
        return view('supervisor.recipes.edit', compact('recipe', 'menuItems', 'ingredients'));
    }

    public function update(Request $request, MenuItemIngredient $recipe)
    {
        $request->validate([
            'quantity_needed' => 'required|numeric|min:0',
        ]);

        $recipe->update($request->only(['quantity_needed']));

        return redirect()->route('supervisor.recipes.index')->with('success', 'Recipe updated successfully.');
    }

    public function destroy(MenuItemIngredient $recipe)
    {
        $recipe->delete();
        return redirect()->route('supervisor.recipes.index')->with('success', 'Recipe ingredient removed successfully.');
    }
}