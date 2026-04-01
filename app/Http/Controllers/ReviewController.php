<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    // Fetch all global reviews for the reviews page
    public function allReviews()
    {
        $reviews = Review::with('user')
            ->orderBy('created_at', 'desc')
            ->limit(20)
            ->get();
            
        return response()->json($reviews);
    }

    // Fetch all reviews for a specific item (e.g. tour or package)
    public function index($item_type, $item_id)
    {
        $reviews = Review::where('item_type', $item_type)
            ->where('item_id', $item_id)
            ->orderBy('created_at', 'desc')
            ->get();
            
        return response()->json($reviews);
    }

    // Store a new review for an item
    public function store(Request $request, $item_type, $item_id)
    {
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        $review = Review::create([
            'user_id' => $request->user()->id,
            'item_type' => $item_type,
            'item_id' => $item_id,
            'rating' => $validated['rating'],
            'comment' => $validated['comment'] ?? '',
        ]);

        // Load the user relation so the frontend can immediately display the reviewer's name
        $review->load('user');

        return response()->json([
            'message' => 'Review submitted successfully',
            'review' => $review
        ], 201);
    }
}
