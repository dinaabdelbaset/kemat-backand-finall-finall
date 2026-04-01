<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tours', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('type')->default('tour'); // tour, package
            $table->string('location');
            $table->string('duration')->nullable(); // e.g. "3 Days, 2 Nights"
            $table->decimal('price', 10, 2);
            $table->decimal('rating', 3, 1)->nullable();
            $table->string('tag')->nullable(); // e.g. "Adventure", "Honeymoon"
            $table->string('label')->nullable(); // e.g. "Best Seller", "New"
            $table->string('start_time')->nullable(); // e.g. "08:00 AM"
            $table->string('includes')->nullable(); // e.g. "Guide, Transport"
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tours');
    }
};
