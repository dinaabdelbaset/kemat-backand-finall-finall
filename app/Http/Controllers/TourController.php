<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use Illuminate\Http\Request;

class TourController extends Controller
{
    public function index(Request $request)
    {
        $tours = [
            [
                'title' => 'Pyramids & Cairo City Tour',
                'description' => 'Explore the iconic Pyramids of Giza, the Sphinx, and the Egyptian Museum in one unforgettable day.',
                'type' => 'tour',
                'location' => 'Cairo, Giza',
                'duration' => 'Full Day',
                'price' => 59.00,
                'rating' => 4.8,
                'tag' => 'Historic',
                'label' => 'Best Seller',
                'start_time' => '08:00 AM',
                'includes' => 'Professional guide and air-conditioned transport',
                'image' => '/images/tour-pyramids.png',
            ],
            [
                'title' => 'Nile Dinner Cruise Experience',
                'description' => 'Enjoy a magical evening on the Nile with a delicious dinner, live music, and traditional Tanoura dance show.',
                'type' => 'tour',
                'location' => 'Cairo',
                'duration' => '2–3 Hours',
                'price' => 35.00,
                'rating' => 4.7,
                'tag' => 'Entertainment',
                'label' => 'Best Seller',
                'start_time' => '07:30 PM',
                'includes' => 'Buffet dinner and live folklore shows',
                'image' => '/images/tour-nile-cruise.png',
            ],
            [
                'title' => 'Red Sea Snorkeling Adventure',
                'description' => 'Discover the beauty of the Red Sea with a snorkeling trip including crystal-clear waters, colorful coral reefs, and a relaxing boat trip.',
                'type' => 'tour',
                'location' => 'Hurghada / Sharm',
                'duration' => 'Full Day',
                'price' => 45.00,
                'rating' => 4.9,
                'tag' => 'Water Sports',
                'label' => 'Top Rated',
                'start_time' => '09:00 AM',
                'includes' => 'Snorkeling gear, lunch, and boat trip',
                'image' => '/images/tour-red-sea.png',
            ],
            [
                'title' => 'Desert Safari & ATV Experience',
                'description' => 'Ride through the desert on an ATV, enjoy sunset views, and experience Bedouin life with a traditional dinner under the stars.',
                'type' => 'tour',
                'location' => 'Desert',
                'duration' => '3–5 Hours',
                'price' => 40.00,
                'rating' => 4.8,
                'tag' => 'Adventure',
                'label' => 'New',
                'start_time' => '03:00 PM',
                'includes' => 'ATV ride, BBQ dinner, and tea',
                'image' => '/images/tour-desert-safari.png',
            ],
            [
                'title' => 'Cairo Food Tour Experience',
                'description' => 'Taste authentic Egyptian food with a local guide. Explore hidden gems, street food spots, and traditional dishes.',
                'type' => 'tour',
                'location' => 'Cairo',
                'duration' => '4 Hours',
                'price' => 39.00,
                'rating' => 4.9,
                'tag' => 'Food & Culture',
                'label' => 'Top Rated',
                'start_time' => '06:00 PM',
                'includes' => 'Food tastings and local guide',
                'image' => '/images/tour-cairo-food.png',
            ],
            [
                'title' => 'Egyptian Museum Guided Tour',
                'description' => 'Discover ancient Egyptian artifacts and secrets of the Pharaonic civilization with a professional tour guide inside the museum.',
                'type' => 'tour',
                'location' => 'Cairo',
                'duration' => '2–3 Hours',
                'price' => 29.00,
                'rating' => 4.6,
                'tag' => 'Historic',
                'label' => 'Great Value',
                'start_time' => '10:00 AM',
                'includes' => 'Entrance fees and professional guide',
                'image' => '/images/tour-museum.png',
            ],
        ];

        try {
            if (!\Illuminate\Support\Facades\Schema::hasTable('tours')) {
                \Illuminate\Support\Facades\Artisan::call('migrate');
            }

            $query = Tour::query();

            $firstTour = Tour::first();
            $fifthTour = Tour::where('title', 'Cairo Food Tour Experience')->first();
            $sixthTour = Tour::where('title', 'Egyptian Museum Guided Tour')->first();

            // Seed tours if DB is empty, OR re-seed to get newly generated local images
            $needsReseed = Tour::count() === 0 || 
                Tour::where('image', 'like', 'https://images.unsplash.com%')->exists();

            if ($needsReseed) {
                Tour::truncate();
                foreach ($tours as $tourData) {
                    Tour::create($tourData);
                }
            }

            if ($request->has('type')) {
                $query->where('type', $request->type);
            }

            $toursList = $query->get();
            $toursList->transform(function ($item) {
                if ($item->image && !str_starts_with($item->image, 'http')) {
                    if (($pos = strpos($item->image, 'images/')) !== false) {
                        $item->image = url(substr($item->image, $pos));
                    } elseif (($pos = strpos($item->image, '/images/')) !== false) {
                        $item->image = url(substr($item->image, $pos + 1));
                    }
                }
                return $item;
            });

            return response()->json($toursList);
        } catch (\Throwable $e) {
            return response()->json($tours);
        }
    }

    public function show($id)
    {
        return response()->json(Tour::findOrFail($id));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|string', // tour, package
            'location' => 'required|string',
            'duration' => 'nullable|string',
            'price' => 'required|numeric',
            'rating' => 'nullable|numeric|between:0,5',
            'tag' => 'nullable|string',
            'image' => 'nullable|string',
            'description' => 'nullable|string'
        ]);

        $tour = Tour::create($validated);
        return response()->json($tour, 201);
    }
}
