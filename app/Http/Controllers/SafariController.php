<?php

namespace App\Http\Controllers;

use App\Models\Safari;
use Illuminate\Http\Request;

class SafariController extends Controller
{
    public function index()
    {
        if (Safari::count() === 0) {
            $this->seedSafaris();
        }

        return response()->json(Safari::all());
    }

    public function show($id)
    {
        $safari = Safari::find($id);
        if (!$safari) {
            return response()->json(['message' => 'Safari not found'], 404);
        }
        return response()->json($safari);
    }

    private function seedSafaris()
    {
        $data = [
            [
                'title' => 'White Desert Overnight Safari',
                'description' => 'Camp under the stars in the surreal White Desert. Explore chalk formations, crystal mountain, and enjoy Bedouin hospitality with a traditional dinner.',
                'location' => 'Farafra, Western Desert',
                'duration' => '2 Days / 1 Night',
                'price' => 120,
                'image' => 'http://localhost:8000/api/kamet-images/deal_safari_camp',
                'rating' => 4.9,
                'includes' => ['4x4 Transport', 'Camping Equipment', 'All Meals', 'Guide', 'Crystal Mountain Visit'],
                'difficulty' => 'Easy',
            ],
            [
                'title' => 'Siwa Oasis Desert Adventure',
                'description' => 'Discover the magical Siwa Oasis with sand-boarding, hot springs, and visits to ancient temples and the stunning Salt Lakes.',
                'location' => 'Siwa Oasis',
                'duration' => '3 Days / 2 Nights',
                'price' => 250,
                'image' => 'http://localhost:8000/api/kamet-images/deal_safari_lake',
                'rating' => 4.8,
                'includes' => ['4x4 Transport', 'Hotel', 'Meals', 'Sand-boarding', 'Hot Springs Visit'],
                'difficulty' => 'Moderate',
            ],
            [
                'title' => 'Hurghada Desert Quad Biking',
                'description' => 'Ride ATVs through the Eastern Desert near Hurghada. Visit a Bedouin village, ride camels, and enjoy a BBQ dinner at sunset.',
                'location' => 'Hurghada, Eastern Desert',
                'duration' => '5 Hours',
                'price' => 45,
                'image' => 'http://localhost:8000/api/kamet-images/deal_safari_bashing',
                'rating' => 4.7,
                'includes' => ['ATV Ride', 'Bedouin Village Visit', 'Camel Ride', 'BBQ Dinner', 'Tea'],
                'difficulty' => 'Easy',
            ],
            [
                'title' => 'Bahariya Oasis & Black Desert Tour',
                'description' => 'Explore the volcanic Black Desert, natural hot springs, and the ancient Golden Mummies of Bahariya Oasis.',
                'location' => 'Bahariya Oasis',
                'duration' => '2 Days / 1 Night',
                'price' => 150,
                'image' => 'http://localhost:8000/api/kamet-images/safari_1',
                'rating' => 4.6,
                'includes' => ['4x4 Transport', 'Camping', 'Meals', 'Hot Springs', 'Museum Visit'],
                'difficulty' => 'Easy',
            ],
            [
                'title' => 'Wadi El Rayan & Fayoum Day Trip',
                'description' => 'Visit the stunning waterfalls of Wadi El Rayan, the ancient Whale Valley (UNESCO), and enjoy sand-boarding on golden dunes.',
                'location' => 'Fayoum',
                'duration' => 'Full Day',
                'price' => 65,
                'image' => 'http://localhost:8000/api/kamet-images/safari_2',
                'rating' => 4.5,
                'includes' => ['Transport', 'Guide', 'Entrance Fees', 'Lunch', 'Sand-boarding'],
                'difficulty' => 'Easy',
            ],
        ];

        foreach ($data as $item) {
            Safari::create($item);
        }
    }
}
