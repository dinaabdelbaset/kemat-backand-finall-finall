<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Tour;
use App\Models\Restaurant;
use App\Models\Activity;
use App\Models\Destination;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->get('q', '');

        if (empty($query)) {
            return response()->json([
                'hotels' => [],
                'tours' => [],
                'restaurants' => [],
            ]);
        }

        $hotels = Hotel::where('title', 'like', "%{$query}%")
            ->orWhere('location', 'like', "%{$query}%")
            ->orWhere('description', 'like', "%{$query}%")
            ->limit(5)
            ->get();

        $tours = Tour::where('title', 'like', "%{$query}%")
            ->orWhere('location', 'like', "%{$query}%")
            ->orWhere('description', 'like', "%{$query}%")
            ->limit(5)
            ->get();

        $restaurants = [];
        try {
            if (\Illuminate\Support\Facades\Schema::hasTable('restaurants')) {
                $restaurants = Restaurant::where('name', 'like', "%{$query}%")
                    ->orWhere('location', 'like', "%{$query}%")
                    ->orWhere('cuisine', 'like', "%{$query}%")
                    ->limit(5)
                    ->get();
            }
        } catch (\Exception $e) {
            // Table may not exist yet
        }

        return response()->json([
            'hotels' => $hotels,
            'tours' => $tours,
            'restaurants' => $restaurants,
        ]);
    }
}
