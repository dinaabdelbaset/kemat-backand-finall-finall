<?php

namespace App\Http\Controllers;

use App\Models\Deal;
use Illuminate\Http\Request;

class DealController extends Controller
{
    public function index()
    {
        if (Deal::count() === 0) {
            $this->seedDeals();
        }

        return response()->json(Deal::all());
    }

    public function show($id)
    {
        $deal = Deal::find($id);
        if (!$deal) {
            return response()->json(['message' => 'Deal not found'], 404);
        }
        return response()->json($deal);
    }

    private function seedDeals()
    {
        $data = [
            [
                'category' => 'Cruises',
                'icon' => '🚢',
                'title' => 'Nile Dinner Cruise',
                'locations' => 'Cairo',
                'image' => 'http://localhost:8000/api/kamet-images/deal_nile_deck',
                'price' => 'From $35',
                'rating' => 4.8,
                'color' => '#1a365d',
                'link' => '/deals/1',
                'items' => [
                    ['name' => 'Buffet Dinner', 'included' => true],
                    ['name' => 'Live Music & Shows', 'included' => true],
                    ['name' => 'Hotel Pickup', 'included' => true],
                ],
            ],
            [
                'category' => 'Adventure',
                'icon' => '🏜️',
                'title' => 'Desert Safari Experience',
                'locations' => 'Hurghada / Sharm',
                'image' => 'http://localhost:8000/api/kamet-images/deal_safari_bashing',
                'price' => 'From $45',
                'rating' => 4.7,
                'color' => '#744210',
                'link' => '/deals/2',
                'items' => [
                    ['name' => 'ATV & Quad Biking', 'included' => true],
                    ['name' => 'Bedouin Dinner', 'included' => true],
                    ['name' => 'Camel Ride', 'included' => true],
                ],
            ],
            [
                'category' => 'Water Sports',
                'icon' => '🤿',
                'title' => 'Red Sea Diving Package',
                'locations' => 'Hurghada / Sharm',
                'image' => 'http://localhost:8000/api/kamet-images/deal_dive_coral',
                'price' => 'From $55',
                'rating' => 4.9,
                'color' => '#065f46',
                'link' => '/deals/3',
                'items' => [
                    ['name' => 'Full Equipment', 'included' => true],
                    ['name' => 'Boat Trip', 'included' => true],
                    ['name' => 'Lunch Included', 'included' => true],
                ],
            ],
            [
                'category' => 'Historic',
                'icon' => '🏛️',
                'title' => 'VIP Pyramids Tour',
                'locations' => 'Giza, Cairo',
                'image' => 'http://localhost:8000/api/kamet-images/deal_pyramids_sunset',
                'price' => 'From $69',
                'rating' => 4.8,
                'color' => '#92400e',
                'link' => '/deals/4',
                'items' => [
                    ['name' => 'Private Guide', 'included' => true],
                    ['name' => 'AC Vehicle', 'included' => true],
                    ['name' => 'Museum Entry', 'included' => true],
                ],
            ],
        ];

        foreach ($data as $item) {
            Deal::create($item);
        }
    }
}
