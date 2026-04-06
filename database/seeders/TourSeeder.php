<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tour;

class TourSeeder extends Seeder
{
    public function run(): void
    {
        Tour::truncate();
        
        $tours = [
            [
                'title' => 'Pyramids & Cairo City Tour',
                'location' => 'Cairo, Giza',
                'image' => '/images/tour-pyramids.png',
                'rating' => 4.8,
                'reviews_count' => 376,
                'duration' => 'Full Day',
                'price' => 59.00,
                'tag' => 'Historic',
                'description' => 'Explore the iconic Pyramids of Giza, the Sphinx, and the Egyptian Museum in one unforgettable day.',
            ],
            [
                'title' => 'Nile Dinner Cruise Experience',
                'location' => 'Cairo',
                'image' => '/images/tour-nile-cruise.png',
                'rating' => 4.7,
                'reviews_count' => 382,
                'duration' => '2-3 Hours',
                'price' => 35.00,
                'tag' => 'Cruise',
                'description' => 'Enjoy a magical evening on the Nile with delicious dinner, live music, and traditional dance show.',
            ],
            [
                'title' => 'Red Sea Snorkeling Adventure',
                'location' => 'Hurghada / Sharm',
                'image' => '/images/tour-red-sea.png',
                'rating' => 4.9,
                'reviews_count' => 470,
                'duration' => 'Full Day',
                'price' => 45.00,
                'tag' => 'Adventure',
                'description' => 'Discover the breathtaking coral reefs of the Red Sea on this unforgettable snorkeling tour.',
            ],
            [
                'title' => 'Desert Safari & ATV Experience',
                'location' => 'Hurghada',
                'image' => '/images/tour-desert-safari.png',
                'rating' => 4.7,
                'reviews_count' => 298,
                'duration' => '4 Hours',
                'price' => 40.00,
                'tag' => 'Adventure',
                'description' => 'Race through golden sand dunes on ATVs, watch a stunning sunset, and enjoy a Bedouin BBQ dinner.',
            ],
            [
                'title' => 'Cairo Food Tour Experience',
                'location' => 'Cairo',
                'image' => '/images/tour-cairo-food.png',
                'rating' => 4.8,
                'reviews_count' => 213,
                'duration' => '3 Hours',
                'price' => 30.00,
                'tag' => 'Culture',
                'description' => 'Taste authentic Egyptian street food — koshary, ful medames, falafel, and fresh juices in Cairo\'s market.',
            ],
            [
                'title' => 'Egyptian Museum Guided Tour',
                'location' => 'Cairo',
                'image' => '/images/tour-museum.png',
                'rating' => 4.6,
                'reviews_count' => 445,
                'duration' => '3 Hours',
                'price' => 25.00,
                'tag' => 'History',
                'description' => 'Explore 5,000 years of Egyptian history including Tutankhamun\'s treasures and royal mummies.',
            ],
            [
                'title' => 'Luxor Valley of the Kings Day Trip',
                'location' => 'Luxor',
                'image' => '/images/tour-pyramids.png',
                'rating' => 4.9,
                'reviews_count' => 634,
                'duration' => 'Full Day',
                'price' => 75.00,
                'tag' => 'Historic',
                'description' => 'Fly to Luxor and explore the legendary Valley of the Kings, Karnak Temple, and Queen Hatshepsut\'s Temple.',
            ],
            [
                'title' => 'Aswan Nubian Village & Nile Felucca',
                'location' => 'Aswan',
                'image' => '/images/tour-nile-cruise.png',
                'rating' => 4.8,
                'reviews_count' => 189,
                'duration' => 'Half Day',
                'price' => 35.00,
                'tag' => 'Culture',
                'description' => 'Sail on an ancient felucca, visit a colorful Nubian village, and enjoy a home-cooked Nubian lunch.',
            ],
        ];

        foreach ($tours as $tour) {
            Tour::create($tour);
        }
    }
}
