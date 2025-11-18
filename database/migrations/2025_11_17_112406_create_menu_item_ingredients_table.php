<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('menu_item_ingredients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('menu_item_id')->constrained()->onDelete('cascade');
            $table->foreignId('ingredient_id')->constrained()->onDelete('cascade');
            $table->decimal('quantity_needed', 10, 2);
            $table->timestamps();
            
            // Unique constraint to prevent duplicate ingredient entries for same menu item
            $table->unique(['menu_item_id', 'ingredient_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('menu_item_ingredients');
    }
};