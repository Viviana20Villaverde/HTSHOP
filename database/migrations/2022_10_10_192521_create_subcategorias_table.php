<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('subcategorias', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('categoria_id');
            $table->string('nombre');
            $table->string('slug');
            $table->string('imagen_ruta')->nullable();
            $table->boolean('tiene_color')->default(false);
            $table->boolean('tiene_medida')->default(false);

            $table->foreign('categoria_id')->references('id')->on('categorias')->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('subcategorias');
    }
};
