<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use App\Models\Ingredient;
use Illuminate\Http\Request;

class SupervisorDashboardController extends Controller
{
    public function index()
    {
        $menuItems = MenuItem::count();
        $ingredients = Ingredient::count();
        $lowStockIngredients = Ingredient::where('stock_quantity', '<=', \DB::raw('low_stock_threshold'))->get();

        return view('supervisor.dashboard', compact('menuItems', 'ingredients', 'lowStockIngredients'));
    }
}