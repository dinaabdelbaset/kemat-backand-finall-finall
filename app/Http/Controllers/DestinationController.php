<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DestinationController extends Controller
{
    public function index(Request $request)
    {
        $destinations = \App\Models\Destination::all()->map(function ($dest) {
            if ($dest->image && !str_starts_with($dest->image, 'http')) {
                $dest->image = url($dest->image);
            } elseif (!$dest->image) {
                $dest->image = null;
            }
            return $dest;
        });
        return response()->json($destinations);
    }

    public function show($id)
    {
        $dest = \App\Models\Destination::find($id);
        if ($dest) {
            if ($dest->image && !str_starts_with($dest->image, 'http')) {
                $dest->image = url($dest->image);
            } elseif (!$dest->image) {
                $dest->image = null;
            }
            return response()->json($dest);
        }
        return response()->json(['error' => 'Not found'], 404);
    }
}
