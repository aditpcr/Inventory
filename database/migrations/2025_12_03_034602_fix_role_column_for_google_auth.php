<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Fix role column to be nullable for Google OAuth users
     */
    public function up(): void
    {
        // Check if role column exists and is not nullable
        try {
            $column = DB::select("SHOW COLUMNS FROM users WHERE Field = 'role'");
            
            if (!empty($column)) {
                $columnType = $column[0]->Type;
                $isNull = $column[0]->Null;
                
                // If it's an enum or not nullable, we need to change it
                if (str_contains(strtolower($columnType), 'enum') || $isNull === 'NO') {
                    // For MySQL, we need to modify the column properly
                    DB::statement("ALTER TABLE users MODIFY COLUMN role VARCHAR(255) NULL");
                }
            }
        } catch (\Exception $e) {
            // Column might already be nullable, ignore error
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Set role back to not nullable (but keep as string, not enum)
        try {
            DB::statement("ALTER TABLE users MODIFY COLUMN role VARCHAR(255) NOT NULL");
        } catch (\Exception $e) {
            // Ignore if column doesn't exist or already not nullable
        }
    }
};
