<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->string('tipo')->nullable();
            $table->id()->nullable();
            $table->integer('category_id')->nullable();
            $table->integer('main_category_id')->nullable();
            $table->integer('subsubcategory_id')->nullable();
            $table->string('id_interno')->nullable();
            $table->string('proveedor')->nullable();
            $table->string('proveedor_logo_path')->nullable(); // Eliminado ->after('proveedor')
            $table->string('referencia')->nullable();
            $table->string('marca')->nullable();
            $table->bigInteger('codigo_barras')->nullable();
            $table->integer('stock')->nullable();
            $table->string('nombre_es')->nullable();
            $table->double('precio_es')->nullable();
            $table->string('descripcion', 3000)->nullable();
            $table->string('detalles', 1000)->nullable();
            $table->json('detalles_lista')->nullable();
            $table->double('precio_oferta_es')->nullable();
            $table->double('precio_flash_es')->nullable();
            $table->double('precio_flash_fecha_fin_es')->nullable();
            $table->double('precio_coste')->nullable();
            $table->integer('publicado')->nullable();
            $table->string('padre')->nullable();
            $table->string('ubicacion')->nullable();
            $table->integer('unidades_compra_proveedor')->nullable();
            $table->date('fecha_proxima_entrada_stock')->nullable();
            $table->string('nombre_completo')->nullable();
            $table->text('img')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}
