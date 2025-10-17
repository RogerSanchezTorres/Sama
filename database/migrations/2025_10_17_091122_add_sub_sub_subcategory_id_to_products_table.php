<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Añadimos la nueva columna (puede ser nullable si no todos los productos la usan)
            $table->foreignId('sub_sub_subcategory_id')
                ->nullable()
                ->constrained('sub_sub_subcategories')
                ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['sub_sub_subcategory_id']);
            $table->dropColumn('sub_sub_subcategory_id');
        });
    }
};
