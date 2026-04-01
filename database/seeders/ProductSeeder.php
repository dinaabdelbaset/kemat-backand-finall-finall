<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        Product::create([
            'name' => 'Authentic Egyptian Papyrus',
            'description' => 'Beautiful hand-painted papyrus depicting ancient Egyptian pharaohs and gods. A perfect souvenir to remember your trip to Egypt.',
            'price' => 25.00,
            'image' => '/images/shop/papyrus.jpg',
            'stock' => 50,
            'category' => 'Art',
        ]);

        Product::create([
            'name' => 'Premium Aswan Spices Box',
            'description' => 'A curated box of the finest spices sourced directly from the Nubian markets in Aswan. Includes cumin, coriander, and authentic saffron.',
            'price' => 15.00,
            'image' => '/images/shop/spices.jpg',
            'stock' => 100,
            'category' => 'Food',
        ]);

        Product::create([
            'name' => 'Alabaster Nefertiti Bust',
            'description' => 'Hand-carved alabaster statue of Queen Nefertiti made by local artisans in Luxor. Each piece is completely unique.',
            'price' => 45.00,
            'image' => '/images/shop/alabaster.jpg',
            'stock' => 30,
            'category' => 'Statues',
        ]);

        Product::create([
            'name' => 'Pure Egyptian Cotton Scarf',
            'description' => 'Incredibly soft and lightweight scarf made from 100% pure long-staple Egyptian cotton.',
            'price' => 20.00,
            'image' => '/images/shop/cotton.jpg',
            'stock' => 80,
            'category' => 'Clothing',
        ]);

        Product::create([
            'name' => 'Dried Hibiscus (Karkadeh)',
            'description' => 'Premium dried hibiscus flowers from Aswan. Perfect for making authentic Egyptian Karkadeh tea.',
            'price' => 12.00,
            'image' => '/images/shop/hibiscus.jpg',
            'stock' => 150,
            'category' => 'Food',
        ]);

        Product::create([
            'name' => 'Traditional Brass Lantern',
            'description' => 'Intricately designed brass lantern from Khan el-Khalili bazaar. Creates beautiful light patterns when lit.',
            'price' => 60.00,
            'image' => '/images/shop/lantern.jpg',
            'stock' => 20,
            'category' => 'Decor',
        ]);
    }
}
