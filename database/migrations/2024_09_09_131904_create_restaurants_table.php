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
        Schema::create('restaurants', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('name', 50);
            $table->string('address', 100);
            $table->string('city', 50);
            $table->string('phone_number', 20);
            $table->string('piva', 11);
            $table->string('slug', 255);
            $table->string('image_path', 255)->nullable();
            $table->timestamps();

            // Definisci la chiave esterna
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restaurants');
    }
};
