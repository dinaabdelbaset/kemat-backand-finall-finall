<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('hotel_name');
            $table->string('room_number')->nullable();
            $table->string('phone');
            $table->decimal('total_amount', 10, 2);
            $table->string('payment_method')->default('Cash on Delivery');
            $table->string('status')->default('Pending');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('orders');
    }
};
