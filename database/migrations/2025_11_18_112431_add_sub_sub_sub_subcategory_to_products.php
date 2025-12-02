<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->foreignId('sub_sub_sub_subcategory_id')
                ->nullable()
                ->constrained('sub_sub_sub_subcategories')
                ->nullOnDelete();
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['sub_sub_sub_subcategory_id']);
            $table->dropColumn('sub_sub_sub_subcategory_id');
        });
    }
};
