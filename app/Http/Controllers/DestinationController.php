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
                'image' => $base . '/api/kamet-images/dest_cairo',
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
                'image' => $base . '/api/kamet-images/dest_luxor',
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
                'image' => $base . '/api/kamet-images/dest_aswan',
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
                'image' => $base . '/api/kamet-images/dest_sharm',
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
                'image' => $base . '/api/kamet-images/dest_hurghada',
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
                'image' => $base . '/api/kamet-images/dest_alexandria',
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
                'image' => $base . '/api/kamet-images/dest_marsa_alam',
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
                'image' => $base . '/api/kamet-images/dest_dahab',
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
