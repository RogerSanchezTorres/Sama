<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddParentIdToSubcategoriesTable extends Migration
{
    public function up()
    {
        Schema::table('subcategories', function (Blueprint $table) {
            $table->foreignId('parent_id')->nullable()->constrained('subcategories')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('subcategories', function (Blueprint $table) {
            $table->dropForeign(['parent_id']);
            $table->dropColumn('parent_id');
        });
    }
}