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
        // 1. Destinations Table
        Schema::create('destinations', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('type')->nullable();
            $table->string('location')->nullable();
            $table->integer('price')->default(0);
            $table->float('rating')->default(0.0);
            $table->string('category')->nullable();
            $table->string('image')->nullable();
            $table->string('src')->nullable();
            $table->string('alt')->nullable();
            $table->integer('tours')->default(0);
            $table->timestamps();
        });

        // 2. Travel Packages Table
        Schema::create('travel_packages', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('image');
            $table->string('alt')->nullable();
            $table->string('tag')->nullable();
            $table->string('date')->nullable();
            $table->string('author')->nullable();
            $table->integer('price')->default(0);
            $table->string('duration')->nullable();
            $table->json('activities')->nullable();
            $table->json('highlights')->nullable();
            $table->json('hotel')->nullable();
            $table->json('museum')->nullable();
            $table->json('excluded')->nullable();
            $table->timestamps();
        });

        // 3. Bazaars Table
        Schema::create('bazaars', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('location')->nullable();
            $table->string('image');
            $table->text('description')->nullable();
            $table->json('specialty')->nullable();
            $table->timestamps();
        });

        // 4. Deals Table
        Schema::create('deals', function (Blueprint $table) {
            $table->id();
            $table->string('category')->nullable();
            $table->string('icon')->nullable();
            $table->string('title');
            $table->string('locations')->nullable();
            $table->string('image');
            $table->string('price')->nullable();
            $table->float('rating')->default(0.0);
            $table->string('color')->nullable();
            $table->string('link')->nullable();
            $table->json('items')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deals');
        Schema::dropIfExists('bazaars');
        Schema::dropIfExists('travel_packages');
        Schema::dropIfExists('destinations');
    }
};
