<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DestinationController extends Controller
{
    public function index(Request $request)
    {
        $base = rtrim(config('app.url'), '/');

        $destinations = [
            [
                'id' => 1,
                'title' => 'Cairo',
                'description' => 'The vibrant capital of Egypt, home to the Great Pyramids and the Sphinx.',
                'type' => 'city',
                'location' => 'Cairo, Egypt',
                'price' => 1500,
                'rating' => 4.9,
                'category' => 'Historic',
                'image' => $base . '/images/home/trending-destinations/download%20(1)c.ario.png',
            ],
            [
                'id' => 2,
                'title' => 'Luxor',
                'description' => 'The world\'s greatest open-air museum, featuring the Valley of the Kings.',
                'type' => 'city',
                'location' => 'Luxor, Egypt',
                'price' => 1200,
                'rating' => 4.8,
                'category' => 'Culture',
                'image' => $base . '/images/home/trending-destinations/luxor.png',
            ],
            [
                'id' => 3,
                'title' => 'Aswan',
                'description' => 'A relaxed riverside town famous for its picturesque Nile Valley and Nubian culture.',
                'type' => 'city',
                'location' => 'Aswan, Egypt',
                'price' => 1100,
                'rating' => 4.7,
                'category' => 'Culture',
                'image' => $base . '/images/home/trending-destinations/aswan.png',
            ],
            [
                'id' => 4,
                'title' => 'Sharm El-Sheikh',
                'description' => 'A stunning resort town on the Red Sea, famous for coral reefs and luxury hotels.',
                'type' => 'city',
                'location' => 'South Sinai, Egypt',
                'price' => 2500,
                'rating' => 4.9,
                'category' => 'Beach',
                'image' => $base . '/images/home/trending-destinations/foto_egipet_sharm_el_shejh_foto_1.jpg-1024x687.png',
            ],
            [
                'id' => 5,
                'title' => 'Hurghada',
                'description' => 'A bustling beach destination perfect for scuba diving and water activities.',
                'type' => 'city',
                'location' => 'Red Sea, Egypt',
                'price' => 1800,
                'rating' => 4.8,
                'category' => 'Adventure',
                'image' => $base . '/images/home/trending-destinations/Hurghada_R03.jpg',
            ],
            [
                'id' => 6,
                'title' => 'Alexandria',
                'description' => 'The Pearl of the Mediterranean, founded by Alexander the Great.',
                'type' => 'city',
                'location' => 'Alexandria, Egypt',
                'price' => 1400,
                'rating' => 4.6,
                'category' => 'Historic',
                'image' => $base . '/images/home/trending-destinations/Alx.png',
            ],
            [
                'id' => 7,
                'title' => 'Marsa Alam',
                'description' => 'An urban oasis famous for its hot springs, salt lakes, and peaceful atmosphere.',
                'type' => 'city',
                'location' => 'Red Sea, Egypt',
                'price' => 900,
                'rating' => 4.9,
                'category' => 'Nature',
                'image' => $base . '/images/home/trending-destinations/marsallm.png',
            ],
            [
                'id' => 8,
                'title' => 'Dahab',
                'description' => 'A bohemian beach town celebrated for the Blue Hole and laid-back vibes.',
                'type' => 'city',
                'location' => 'South Sinai, Egypt',
                'price' => 1000,
                'rating' => 4.8,
                'category' => 'Beach',
                'image' => $base . '/images/home/trending-destinations/%D8%B3%D9%81%D8%A7%D8%B1%D9%8A-%D8%AF%D9%87%D8%A8-%D8%A8%D9%8A%D8%AA%D8%B4-%D8%A8%D8%A7%D8%AC%D9%8A.png',
            ],
        ];

        return response()->json($destinations);
    }

    public function show($id)
    {
        $all = $this->index(new Request())->getData(true);
        foreach ($all as $dest) {
            if ($dest['id'] == $id) {
                return response()->json($dest);
            }
        }
        return response()->json(['error' => 'Not found'], 404);
    }
}
