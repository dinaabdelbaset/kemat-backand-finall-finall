<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tour;

class TourSeeder extends Seeder
{
    public function run(): void
    {
        $tours = [
            [
                'title' => 'Giza Pyramids & Sphinx Half-Day Tour',
                'description' => 'Experience the majesty of the ancient world. Ride a camel around the pyramids and capture memories of a lifetime.',
                'type' => 'tour',
                'location' => 'Cairo, Egypt',
                'duration' => '4 hours',
                'price' => 45.00,
                'rating' => 4.9,
                'tag' => 'Historic',
                'image' => 'https://images.unsplash.com/photo-1503177119275-0aa32b3a9368?q=80&w=600',
            ],
            [
                'title' => 'Hot Air Balloon Ride Over Valley of the Kings',
                'description' => 'Float majestically over Luxor and watch the sunrise illuminate ancient temples and the mighty Nile River.',
                'type' => 'tour',
                'location' => 'Luxor, Egypt',
                'duration' => '3 hours',
                'price' => 120.00,
                'rating' => 5.0,
                'tag' => 'Adventure',
                'image' => 'https://images.unsplash.com/photo-1540979388789-6cee28a1cdc9?q=80&w=600',
            ],
            [
                'title' => 'Red Sea Scuba Diving Adventure',
                'description' => 'Dive into the crystal-clear waters of the Red Sea. Explore vibrant coral reefs and swim alongside exotic marine life.',
                'type' => 'tour',
                'location' => 'Hurghada, Egypt',
                'duration' => '8 hours',
                'price' => 85.00,
                'rating' => 4.8,
                'tag' => 'Water Sports',
                'image' => 'https://images.unsplash.com/photo-1544551763-46a013bb70d5?q=80&w=600',
            ],
            [
                'title' => 'Nile Dinner Cruise Experience',
                'description' => 'Enjoy a spectacular open-buffet dinner while cruising the Nile under the stars, accompanied by traditional folklore shows.',
                'type' => 'tour',
                'location' => 'Cairo, Egypt',
                'duration' => '3 hours',
                'price' => 35.00,
                'rating' => 4.7,
                'tag' => 'Entertainment',
                'image' => '/nile_dinner_cruise_elegant.png',
            ],
        ];

        foreach ($tours as $tour) {
            Tour::create($tour);
        }
    }
}
