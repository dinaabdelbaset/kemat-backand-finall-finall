<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Blogs / Travel Guides
        if (!Schema::hasTable('blogs')) {
            Schema::create('blogs', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->string('slug')->unique()->nullable();
                $table->text('excerpt')->nullable();
                $table->longText('content')->nullable();
                $table->string('image')->nullable();
                $table->string('author')->default('Kemet Team');
                $table->string('category')->nullable();
                $table->json('tags')->nullable();
                $table->integer('read_time')->default(5);
                $table->timestamps();
            });
        }

        // Transportation
        if (!Schema::hasTable('transportations')) {
            Schema::create('transportations', function (Blueprint $table) {
                $table->id();
                $table->string('type'); // Flight, Train, Bus, Car
                $table->string('route');
                $table->string('company')->nullable();
                $table->string('class')->nullable();
                $table->decimal('price', 10, 2);
                $table->string('duration')->nullable();
                $table->string('departure_time')->nullable();
                $table->string('image')->nullable();
                $table->float('rating', 2, 1)->default(0);
                $table->timestamps();
            });
        }

        // Wishlists
        if (!Schema::hasTable('wishlists')) {
            Schema::create('wishlists', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained()->onDelete('cascade');
                $table->string('item_type'); // hotel, tour, restaurant, etc.
                $table->unsignedBigInteger('item_id');
                $table->timestamps();
                $table->unique(['user_id', 'item_type', 'item_id']);
            });
        }

        // Contact Messages (Support)
        if (!Schema::hasTable('contact_messages')) {
            Schema::create('contact_messages', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('email');
                $table->text('message');
                $table->string('status')->default('new');
                $table->timestamps();
            });
        }

        // Newsletter Subscribers
        if (!Schema::hasTable('newsletter_subscribers')) {
            Schema::create('newsletter_subscribers', function (Blueprint $table) {
                $table->id();
                $table->string('email')->unique();
                $table->timestamps();
            });
        }

        // CMS Pages (Content Pages)
        if (!Schema::hasTable('pages')) {
            Schema::create('pages', function (Blueprint $table) {
                $table->id();
                $table->string('slug')->unique();
                $table->string('title');
                $table->longText('content')->nullable();
                $table->timestamps();
            });
        }

        // FAQs
        if (!Schema::hasTable('faqs')) {
            Schema::create('faqs', function (Blueprint $table) {
                $table->id();
                $table->string('question');
                $table->text('answer');
                $table->integer('sort_order')->default(0);
                $table->timestamps();
            });
        }

        // Notifications
        if (!Schema::hasTable('notifications_custom')) {
            Schema::create('notifications_custom', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained()->onDelete('cascade');
                $table->string('type')->default('system'); // booking, offer, system
                $table->string('title');
                $table->text('message');
                $table->boolean('is_read')->default(false);
                $table->timestamps();
            });
        }

        // Restaurants
        if (!Schema::hasTable('restaurants')) {
            Schema::create('restaurants', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('cuisine')->nullable();
                $table->string('location')->nullable();
                $table->string('address')->nullable();
                $table->text('description')->nullable();
                $table->string('image')->nullable();
                $table->json('gallery')->nullable();
                $table->decimal('price_range_min', 10, 2)->default(0);
                $table->decimal('price_range_max', 10, 2)->default(0);
                $table->float('rating', 2, 1)->default(0);
                $table->integer('reviews_count')->default(0);
                $table->string('opening_hours')->nullable();
                $table->json('features')->nullable();
                $table->timestamps();
            });
        }

        // Events
        if (!Schema::hasTable('events')) {
            Schema::create('events', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->text('description')->nullable();
                $table->string('location')->nullable();
                $table->string('venue')->nullable();
                $table->date('date')->nullable();
                $table->string('time')->nullable();
                $table->decimal('price', 10, 2)->default(0);
                $table->string('category')->nullable();
                $table->string('image')->nullable();
                $table->json('gallery')->nullable();
                $table->float('rating', 2, 1)->default(0);
                $table->timestamps();
            });
        }

        // Museums
        if (!Schema::hasTable('museums')) {
            Schema::create('museums', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('location')->nullable();
                $table->string('address')->nullable();
                $table->text('description')->nullable();
                $table->string('image')->nullable();
                $table->json('gallery')->nullable();
                $table->decimal('ticket_price', 10, 2)->default(0);
                $table->string('opening_hours')->nullable();
                $table->float('rating', 2, 1)->default(0);
                $table->integer('reviews_count')->default(0);
                $table->json('highlights')->nullable();
                $table->timestamps();
            });
        }

        // Safaris
        if (!Schema::hasTable('safaris')) {
            Schema::create('safaris', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->text('description')->nullable();
                $table->string('location')->nullable();
                $table->string('duration')->nullable();
                $table->decimal('price', 10, 2)->default(0);
                $table->string('image')->nullable();
                $table->json('gallery')->nullable();
                $table->float('rating', 2, 1)->default(0);
                $table->json('includes')->nullable();
                $table->string('difficulty')->default('Easy');
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('safaris');
        Schema::dropIfExists('museums');
        Schema::dropIfExists('events');
        Schema::dropIfExists('restaurants');
        Schema::dropIfExists('notifications_custom');
        Schema::dropIfExists('faqs');
        Schema::dropIfExists('pages');
        Schema::dropIfExists('newsletter_subscribers');
        Schema::dropIfExists('contact_messages');
        Schema::dropIfExists('wishlists');
        Schema::dropIfExists('transportations');
        Schema::dropIfExists('blogs');
    }
};
