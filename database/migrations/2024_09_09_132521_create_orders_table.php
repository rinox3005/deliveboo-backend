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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('restaurant_id');
            $table->string('user_name', 50);
            $table->string('user_email', 50);
            $table->string('user_address', 100);
            $table->string('user_phone', 20);
            $table->timestamp('order_date_time');
            $table->date('delivery_date');
            $table->time('delivery_time');
            $table->decimal('total_price', 5, 2);
            $table->string('slug', 255);
            $table->string('notes', 255)->nullable();
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
        Schema::dropIfExists('orders');
    }
};
