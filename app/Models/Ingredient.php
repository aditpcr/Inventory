<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'unit',
        'stock_quantity',
        'low_stock_threshold',
    ];

    protected $casts = [
        'stock_quantity' => 'decimal:2',
        'low_stock_threshold' => 'decimal:2',
    ];

    // Relationships
    public function menuItems()
    {
        return $this->belongsToMany(MenuItem::class, 'menu_item_ingredients')
                    ->withPivot('quantity_needed')
                    ->withTimestamps();
    }

    public function menuItemIngredients()
    {
        return $this->hasMany(MenuItemIngredient::class);
    }

    // Check if stock is low
    public function isLowStock()
    {
        return $this->stock_quantity <= $this->low_stock_threshold;
    }
}