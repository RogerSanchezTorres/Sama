<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSubSubcategoryIdToProductsTable extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->foreignId('sub_subcategory_id')
                ->nullable()
                ->constrained('sub_subcategories')
                ->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['sub_subcategory_id']);
            $table->dropColumn('sub_subcategory_id');
        });
    }
}
