<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('color_medida', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('color_id');
            $table->unsignedBigInteger('medida_id');
            $table->integer('stock');

            $table->foreign('color_id')->references('id')->on('colors')->onDelete('cascade');
            $table->foreign('medida_id')->references('id')->on('medidas')->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('color_medida');
    }
};
