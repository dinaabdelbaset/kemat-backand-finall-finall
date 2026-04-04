<?php

namespace App\Http\Controllers;

use App\Models\Transportation;
use Illuminate\Http\Request;

class TransportationController extends Controller
{
    public function index(Request $request)
    {
        // Auto-seed if empty
        if (Transportation::count() === 0) {
            $this->seedTransportation();
        }

        $query = Transportation::query();

        if ($request->has('type') && $request->type) {
            $query->where('type', $request->type);
        }

        return response()->json($query->get());
    }

    public function show($id)
    {
        $transport = Transportation::find($id);
        if (!$transport) {
            return response()->json(['message' => 'Transportation not found'], 404);
        }
        return response()->json($transport);
    }

    private function seedTransportation()
    {
        $data = [
            ['type' => 'Flight', 'route' => 'Cairo to Luxor', 'company' => 'EgyptAir', 'class' => 'Economy', 'price' => 1500, 'duration' => '1h 10m', 'departure_time' => '08:00 AM', 'rating' => 4.5],
            ['type' => 'Flight', 'route' => 'Cairo to Sharm El-Sheikh', 'company' => 'EgyptAir', 'class' => 'Economy', 'price' => 1800, 'duration' => '1h', 'departure_time' => '07:30 AM', 'rating' => 4.6],
            ['type' => 'Flight', 'route' => 'Cairo to Hurghada', 'company' => 'Nile Air', 'class' => 'Economy', 'price' => 1600, 'duration' => '1h 05m', 'departure_time' => '09:00 AM', 'rating' => 4.3],
            ['type' => 'Flight', 'route' => 'Cairo to Aswan', 'company' => 'EgyptAir', 'class' => 'Economy', 'price' => 2000, 'duration' => '1h 25m', 'departure_time' => '06:30 AM', 'rating' => 4.7],
            ['type' => 'Train', 'route' => 'Cairo to Alexandria', 'company' => 'Egyptian National Railways', 'class' => 'First Class AC', 'price' => 250, 'duration' => '2h 30m', 'departure_time' => '08:00 AM', 'rating' => 4.2],
            ['type' => 'Train', 'route' => 'Cairo to Luxor', 'company' => 'Egyptian National Railways', 'class' => 'First Class Sleeper', 'price' => 800, 'duration' => '9h', 'departure_time' => '08:00 PM', 'rating' => 4.4],
            ['type' => 'Train', 'route' => 'Cairo to Aswan', 'company' => 'Egyptian National Railways', 'class' => 'First Class Sleeper', 'price' => 900, 'duration' => '12h', 'departure_time' => '07:00 PM', 'rating' => 4.3],
            ['type' => 'Bus', 'route' => 'Cairo to Sharm El-Sheikh', 'company' => 'GoBus', 'class' => 'VIP', 'price' => 350, 'duration' => '6h', 'departure_time' => '11:00 PM', 'rating' => 4.1],
            ['type' => 'Bus', 'route' => 'Cairo to Hurghada', 'company' => 'GoBus', 'class' => 'VIP', 'price' => 400, 'duration' => '5h 30m', 'departure_time' => '10:00 PM', 'rating' => 4.0],
            ['type' => 'Bus', 'route' => 'Cairo to Alexandria', 'company' => 'West & Mid Delta', 'class' => 'AC', 'price' => 130, 'duration' => '3h', 'departure_time' => '07:00 AM', 'rating' => 3.8],
            ['type' => 'Bus', 'route' => 'Cairo to Marsa Matrouh', 'company' => 'West Delta', 'class' => 'VIP', 'price' => 300, 'duration' => '4h', 'departure_time' => '06:00 AM', 'rating' => 4.0],
            ['type' => 'Car', 'route' => 'Cairo to Fayoum', 'company' => 'Kemet Private Car', 'class' => 'Sedan', 'price' => 600, 'duration' => '1h 30m', 'departure_time' => 'On Demand', 'rating' => 4.8],
            ['type' => 'Car', 'route' => 'Cairo Airport Transfer', 'company' => 'Kemet Private Car', 'class' => 'SUV', 'price' => 450, 'duration' => '45m', 'departure_time' => 'On Demand', 'rating' => 4.9],
        ];

        foreach ($data as $item) {
            Transportation::create($item);
        }
    }
}
