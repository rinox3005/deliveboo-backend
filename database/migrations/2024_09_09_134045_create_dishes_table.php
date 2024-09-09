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
        Schema::create('dishes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('restaurant_id');
            $table->string('image_path', 255)->nullable();
            $table->string('name', 100);
            $table->string('description', 255);
            $table->decimal('price', 5, 2);
            $table->boolean('vegan');
            $table->boolean('gluten_free');
            $table->boolean('spicy');
            $table->boolean('lactose_free');
            $table->boolean('visible');
            $table->string('slug', 255);
            $table->timestamps();

            // Definisci la chiave esterna
            $table->foreign('restaurant_id')->references('id')->on('restaurants')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dishes');
    }
};
