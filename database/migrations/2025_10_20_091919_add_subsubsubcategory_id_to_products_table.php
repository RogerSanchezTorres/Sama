<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->unsignedBigInteger('subsubsubcategory_id')->nullable()->after('subsubcategory_id');
            $table->foreign('subsubsubcategory_id')
                ->references('id')
                ->on('sub_sub_subcategories')
                ->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['subsubsubcategory_id']);
            $table->dropColumn('subsubsubcategory_id');
        });
    }
};
