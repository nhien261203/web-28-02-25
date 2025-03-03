<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement('UPDATE products SET price = price * 100');

        Schema::table('products', function (Blueprint $table) {
            $table->unsignedBigInteger('price')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->float('price', 10, 2)->change();
        });

        // Chia lại tất cả giá trị về số thập phân
        DB::statement('UPDATE products SET price = price / 100');
    }
};
