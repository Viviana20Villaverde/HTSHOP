<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Producto;

return new class extends Migration
{
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('subcategoria_id');
            $table->unsignedBigInteger('marca_id');
            $table->string('nombre');
            $table->string('slug')->unique();
            $table->string('sku')->unique()->nullable();
            $table->float('precio');
            $table->integer('stock_total')->nullable();
            $table->text('descripcion');
            $table->text('informacion');
            $table->integer('puntos_ganar')->nullable();
            $table->integer('puntos_tope')->nullable();
            $table->string('link_video')->nullable();
            $table->boolean('tiene_detalle')->default(false);
            $table->enum('estado', [Producto::BORRADOR, Producto::PUBLICADO])->default(Producto::BORRADOR);

            $table->foreign('subcategoria_id')->references('id')->on('subcategorias')->onDelete('cascade');
            $table->foreign('marca_id')->references('id')->on('marcas')->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('productos');
    }
};
