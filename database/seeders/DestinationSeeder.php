<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Destination;

class DestinationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // احذف كل السجلات القديمة
        Destination::truncate();

        // أضف الوجهات مع روابط صور صحيحة (تستخدم APP_URL)
        $baseUrl = env('APP_URL'); // يجب أن يكون http://localhost:8000

        $destinations = [
            [
                'title' => 'Cairo',
                'description' => 'The vibrant capital of Egypt, home to the Great Pyramids and the Sphinx.',
                'type' => 'city',
                'location' => 'Cairo, Egypt',
                'price' => 1500,
                'rating' => 4.9,
                'category' => 'Historic',
                'image' => $baseUrl . '/images/home/trending-destinations/download%20(1)c.ario.png',
            ],
            [
                'title' => 'Luxor',
                'description' => "The world's greatest open-air museum, featuring the Valley of the Kings.",
                'type' => 'city',
                'location' => 'Luxor, Egypt',
                'price' => 1200,
                'rating' => 4.8,
                'category' => 'Culture',
                'image' => $baseUrl . '/images/home/trending-destinations/luxor.png',
            ],
            [
                'title' => 'Aswan',
                'description' => 'A relaxed riverside town famous for its picturesque Nile Valley and Nubian culture.',
                'type' => 'city',
                'location' => 'Aswan, Egypt',
                'price' => 1100,
                'rating' => 4.7,
                'category' => 'Culture',
                'image' => $baseUrl . '/images/home/trending-destinations/aswan.png',
            ],
            [
                'title' => 'Sharm El‑Sheikh',
                'description' => 'A stunning resort town on the Red Sea, famous for coral reefs and luxury hotels.',
                'type' => 'city',
                'location' => 'South Sinai, Egypt',
                'price' => 2500,
                'rating' => 4.9,
                'category' => 'Beach',
                'image' => $baseUrl . '/images/home/trending-destinations/foto_egipet_sharm_el_shejh_foto_1.jpg-1024x687.png',
            ],
            [
                'title' => 'Hurghada',
                'description' => 'A bustling beach destination perfect for scuba diving and water activities.',
                'type' => 'city',
                'location' => 'Red Sea, Egypt',
                'price' => 1800,
                'rating' => 4.8,
                'category' => 'Adventure',
                'image' => $baseUrl . '/images/home/trending-destinations/Hurghada_R03.jpg',
            ],
            [
                'title' => 'Alexandria',
                'description' => 'The Pearl of the Mediterranean, founded by Alexander the Great.',
                'type' => 'city',
                'location' => 'Alexandria, Egypt',
                'price' => 1400,
                'rating' => 4.6,
                'category' => 'Historic',
                'image' => $baseUrl . '/images/home/trending-destinations/Alx.png',
            ],
            [
                'title' => 'Marsa Alam',
                'description' => 'An urban oasis famous for its hot springs, salt lakes, and peaceful atmosphere.',
                'type' => 'city',
                'location' => 'Red Sea, Egypt',
                'price' => 900,
                'rating' => 4.9,
                'category' => 'Nature',
                'image' => $baseUrl . '/images/home/trending-destinations/marsallm.png',
            ],
            [
                'title' => 'Dahab',
                'description' => 'A bohemian beach town celebrated for the Blue Hole and laid‑back vibes.',
                'type' => 'city',
                'location' => 'South Sinai, Egypt',
                'price' => 1000,
                'rating' => 4.8,
                'category' => 'Beach',
                'image' => $baseUrl . '/images/home/trending-destinations/سفاري-دهب-بيتش-باجي.png',
            ],
        ];

        foreach ($destinations as $data) {
            Destination::create($data);
        }
    }
}
