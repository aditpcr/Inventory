<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'total_price',
    ];

    protected $casts = [
        'total_price' => 'decimal:2',
    ];

    // Relationships
    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Automatically deduct stock when order is created
    protected static function booted()
    {
        static::created(function ($order) {
            foreach ($order->orderItems as $orderItem) {
                $menuItem = $orderItem->menuItem;
                foreach ($menuItem->menuItemIngredients as $recipe) {
                    $deduction = $recipe->quantity_needed * $orderItem->quantity;
                    $recipe->ingredient->decrement('stock_quantity', $deduction);
                }
            }
        });
    }
}