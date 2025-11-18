<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'available',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'available' => 'boolean',
    ];

    // Relationships
    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class, 'menu_item_ingredients')
                    ->withPivot('quantity_needed')
                    ->withTimestamps();
    }

    public function menuItemIngredients()
    {
        return $this->hasMany(MenuItemIngredient::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Check if menu item can be made with current stock
    public function canBeMade($quantity = 1)
    {
        foreach ($this->menuItemIngredients as $recipe) {
            $required = $recipe->quantity_needed * $quantity;
            if ($recipe->ingredient->stock_quantity < $required) {
                return false;
            }
        }
        return true;
    }

    /**
     * Deduct the required ingredients from stock based on the quantity ordered.
     *
     * @throws \RuntimeException
     */
    public function deductIngredients(int $quantity = 1): void
    {
        if ($quantity < 1) {
            return;
        }

        $this->loadMissing('menuItemIngredients.ingredient');

        foreach ($this->menuItemIngredients as $recipe) {
            $ingredient = $recipe->ingredient()->lockForUpdate()->first();

            if (!$ingredient) {
                throw new \RuntimeException("Ingredient not found for {$this->name}.");
            }

            $required = (float) $recipe->quantity_needed * $quantity;
            $currentStock = (float) $ingredient->stock_quantity;

            if ($currentStock < $required) {
                throw new \RuntimeException("Insufficient stock for {$ingredient->name}.");
            }

            $ingredient->stock_quantity = round($currentStock - $required, 2);
            $ingredient->save();
        }
    }
}