<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->decimal('precio_es', 10, 2)->nullable()->change();
            $table->decimal('precio_oferta_es', 10, 2)->nullable()->change();
            $table->decimal('precio_flash_es', 10, 2)->nullable()->change();
            $table->decimal('precio_coste', 10, 2)->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->double('precio_es')->nullable()->change();
            $table->double('precio_oferta_es')->nullable()->change();
            $table->double('precio_flash_es')->nullable()->change();
            $table->double('precio_coste')->nullable()->change();
        });
    }
};
