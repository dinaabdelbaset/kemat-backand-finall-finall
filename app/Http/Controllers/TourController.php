<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use Illuminate\Http\Request;

class TourController extends Controller
{
    public function index(Request $request)
    {
        try {
            $query = Tour::query();

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
            return response()->json(['error' => $e->getMessage()], 500);
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
