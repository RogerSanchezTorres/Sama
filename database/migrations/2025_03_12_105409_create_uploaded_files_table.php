<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('uploaded_files', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Usuario al que se le asigna el archivo
            $table->string('file_name'); // Nombre del archivo
            $table->string('file_path'); // Ruta del archivo en el almacenamiento
            $table->timestamps();

            // Clave foránea para enlazar con la tabla de usuarios
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('uploaded_files');
    }
};

