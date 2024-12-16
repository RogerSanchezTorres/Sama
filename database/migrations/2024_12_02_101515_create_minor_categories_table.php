<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMinorCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('minor_categories', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('slug');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('main_category_id')->nullable();
            $table->unsignedBigInteger('subcategory_id')->nullable();
            $table->unsignedBigInteger('sub_subcategory_id')->nullable();

            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('main_category_id')->references('id')->on('main_categories')->onDelete('cascade');
            $table->foreign('subcategory_id')->references('id')->on('subcategories')->onDelete('cascade');
            $table->foreign('sub_subcategory_id')->references('id')->on('sub_subcategories')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('minor_categories');
    }
}
