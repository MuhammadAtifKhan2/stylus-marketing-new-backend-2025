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
            $table->string('name');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('sub_category_id');
            $table->integer('price');
            $table->string('width')->nullable();
            $table->string('height')->nullable();
            $table->integer('premium')->nullable();
            $table->integer('lamination')->nullable();
            $table->string('hanging_options')->nullable();
            $table->integer('wind_flaps')->nullable();
            $table->string('description',500)->nullable();
            $table->foreign('category_id')->on('categories')->references('id');
            $table->foreign('sub_category_id')->on('sub_categories')->references('id');
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
