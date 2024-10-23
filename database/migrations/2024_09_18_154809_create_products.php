<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('category'); // Предполагая "category" таблица существует
            $table->string('name');
            $table->text('description');
            $table->integer('calories');
            $table->integer('squirrels');
            $table->integer('fats');
            $table->integer('carbohydrates');
            $table->integer('weight');
            $table->decimal('price', 10, 2);
//            $table->unsignedBigInteger('image_id');
//            $table->foreign('image_id')->references('id')->on('images'); // Предполагая "images" таблица существует
            $table->integer('quantity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
