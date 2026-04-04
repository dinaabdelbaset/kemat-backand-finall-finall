<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index(Request $request)
    {
        $wishlists = Wishlist::where('user_id', $request->user()->id)->get();
        return response()->json($wishlists);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'item_id' => 'required',
            'type' => 'required|string',
        ]);

        $existing = Wishlist::where('user_id', $request->user()->id)
            ->where('item_type', $validated['type'])
            ->where('item_id', $validated['item_id'])
            ->first();

        if ($existing) {
            return response()->json(['success' => true, 'message' => 'Already in wishlist']);
        }

        Wishlist::create([
            'user_id' => $request->user()->id,
            'item_type' => $validated['type'],
            'item_id' => $validated['item_id'],
        ]);

        return response()->json(['success' => true, 'message' => 'Added to wishlist'], 201);
    }

    public function destroy($id, Request $request)
    {
        $wishlist = Wishlist::where('id', $id)
            ->where('user_id', $request->user()->id)
            ->first();

        if (!$wishlist) {
            return response()->json(['message' => 'Item not found'], 404);
        }

        $wishlist->delete();
        return response()->json(['success' => true, 'message' => 'Removed from wishlist']);
    }
}
