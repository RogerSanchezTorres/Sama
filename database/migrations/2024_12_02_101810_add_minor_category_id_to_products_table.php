<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMinorCategoryIdToProductsTable extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->foreignId('minor_category_id')->nullable()->constrained('minor_categories')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['minor_category_id']);
            $table->dropColumn('minor_category_id');
        });
    }
}
