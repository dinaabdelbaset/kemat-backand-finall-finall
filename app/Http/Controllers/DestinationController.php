<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DestinationController extends Controller
{
    public function index(Request $request)
    {
        $destinations = \App\Models\Destination::all()->map(function ($dest) {
            $dest->image = url($dest->image); // Ensure full URL
            return $dest;
        });
        return response()->json($destinations);
    }

    public function show($id)
    {
        $dest = \App\Models\Destination::find($id);
        if ($dest) {
            $dest->image = url($dest->image);
            return response()->json($dest);
        }
        return response()->json(['error' => 'Not found'], 404);
    }
}
