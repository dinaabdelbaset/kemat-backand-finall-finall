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
        Schema::create('hotels', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('location'); // City or Governorate
            $table->string('address')->nullable();
            $table->decimal('rating', 3, 2)->default(0);
            $table->integer('reviews_count')->default(0);
            $table->decimal('price_starts_from', 8, 2)->default(0);
            $table->string('image')->nullable();
            $table->json('gallery')->nullable();
            $table->string('ar_url')->nullable(); // URL for Hotel AR/VR Tour
            $table->timestamps();
        });

        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hotel_id')->constrained()->onDelete('cascade');
            $table->string('room_type'); // e.g., "Deluxe Room", "Suite"
            $table->integer('capacity_adults')->default(2);
            $table->integer('capacity_children')->default(0);
            $table->decimal('price_per_night', 8, 2);
            $table->integer('available_count')->default(1);
            $table->json('features')->nullable(); // e.g., ["Free Wi-Fi", "Sea View"]
            $table->string('image')->nullable();
            $table->string('ar_url')->nullable(); // Room specific AR/VR view
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
        Schema::dropIfExists('hotels');
    }
};
