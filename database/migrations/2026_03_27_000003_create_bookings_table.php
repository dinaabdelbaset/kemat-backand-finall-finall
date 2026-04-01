<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('item_type'); // tour, package, hotel, destination
            $table->unsignedBigInteger('item_id');
            $table->string('status')->default('pending'); // pending, confirmed, cancelled
            $table->string('date_info')->nullable();
            $table->decimal('total_price', 10, 2);
            $table->integer('guests')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
