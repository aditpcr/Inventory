<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Ingredient;
use App\Models\MenuItem;
use App\Models\MenuItemIngredient;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Create Users
        User::create([
            'name' => 'Admin',
            'email' => 'admin@restaurant.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Supervisor',
            'email' => 'supervisor@restaurant.com',
            'password' => Hash::make('password123'),
            'role' => 'supervisor',
        ]);

        User::create([
            'name' => 'Employee',
            'email' => 'employee@restaurant.com',
            'password' => Hash::make('password123'),
            'role' => 'employee',
        ]);


        $ingredients = [
            ['name' => 'Rice', 'unit' => 'g', 'stock_quantity' => 10000, 'low_stock_threshold' => 1000],
            ['name' => 'Egg', 'unit' => 'pcs', 'stock_quantity' => 100, 'low_stock_threshold' => 20],
            ['name' => 'Cooking Oil', 'unit' => 'ml', 'stock_quantity' => 5000, 'low_stock_threshold' => 500],
            ['name' => 'Chicken', 'unit' => 'g', 'stock_quantity' => 5000, 'low_stock_threshold' => 1000],
            ['name' => 'Noodles', 'unit' => 'g', 'stock_quantity' => 8000, 'low_stock_threshold' => 1000],
            ['name' => 'Vegetables', 'unit' => 'g', 'stock_quantity' => 3000, 'low_stock_threshold' => 500],
            ['name' => 'Soy Sauce', 'unit' => 'ml', 'stock_quantity' => 2000, 'low_stock_threshold' => 200],
        ];

        foreach ($ingredients as $ingredient) {
            Ingredient::create($ingredient);
        }

        // Create Menu Items
        $menuItems = [
            ['name' => 'Nasi Goreng', 'price' => 25000, 'available' => true],
            ['name' => 'Mie Goreng', 'price' => 22000, 'available' => true],
            ['name' => 'Chicken Fried Rice', 'price' => 28000, 'available' => true],
            ['name' => 'Vegetable Stir Fry', 'price' => 18000, 'available' => true],
        ];

        foreach ($menuItems as $menuItem) {
            MenuItem::create($menuItem);
        }

        // Create Menu Item Ingredients (Recipes)
        $recipes = [
            // Nasi Goreng
            ['menu_item_id' => 1, 'ingredient_id' => 1, 'quantity_needed' => 200], // Rice 200g
            ['menu_item_id' => 1, 'ingredient_id' => 2, 'quantity_needed' => 1],   // Egg 1 pcs
            ['menu_item_id' => 1, 'ingredient_id' => 3, 'quantity_needed' => 10],  // Oil 10ml
            ['menu_item_id' => 1, 'ingredient_id' => 4, 'quantity_needed' => 50],  // Chicken 50g
            
            // Mie Goreng
            ['menu_item_id' => 2, 'ingredient_id' => 5, 'quantity_needed' => 150], // Noodles 150g
            ['menu_item_id' => 2, 'ingredient_id' => 2, 'quantity_needed' => 1],   // Egg 1 pcs
            ['menu_item_id' => 2, 'ingredient_id' => 3, 'quantity_needed' => 15],  // Oil 15ml
            ['menu_item_id' => 2, 'ingredient_id' => 6, 'quantity_needed' => 100], // Vegetables 100g
            
            // Chicken Fried Rice
            ['menu_item_id' => 3, 'ingredient_id' => 1, 'quantity_needed' => 200], // Rice 200g
            ['menu_item_id' => 3, 'ingredient_id' => 2, 'quantity_needed' => 1],   // Egg 1 pcs
            ['menu_item_id' => 3, 'ingredient_id' => 3, 'quantity_needed' => 12],  // Oil 12ml
            ['menu_item_id' => 3, 'ingredient_id' => 4, 'quantity_needed' => 80],  // Chicken 80g
            
            // Vegetable Stir Fry
            ['menu_item_id' => 4, 'ingredient_id' => 6, 'quantity_needed' => 200], // Vegetables 200g
            ['menu_item_id' => 4, 'ingredient_id' => 3, 'quantity_needed' => 8],   // Oil 8ml
            ['menu_item_id' => 4, 'ingredient_id' => 7, 'quantity_needed' => 10],  // Soy Sauce 10ml
        ];

        foreach ($recipes as $recipe) {
            MenuItemIngredient::create($recipe);
        }
    }
}