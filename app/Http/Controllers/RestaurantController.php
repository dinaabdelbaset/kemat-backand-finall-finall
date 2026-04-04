<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function index()
    {
        if (Restaurant::count() === 0) {
            $this->seedRestaurants();
        }

        return response()->json(Restaurant::all());
    }

    public function show($id)
    {
        $restaurant = Restaurant::find($id);
        if (!$restaurant) {
            return response()->json(['message' => 'Restaurant not found'], 404);
        }
        return response()->json($restaurant);
    }

    private function seedRestaurants()
    {
        $data = [
            [
                'name' => 'Abou El Sid',
                'cuisine' => 'Egyptian Traditional',
                'location' => 'Cairo',
                'address' => 'Zamalek, Cairo, Egypt',
                'description' => 'Authentic Egyptian cuisine in a beautifully decorated traditional setting. Known for classic dishes like molokhia, stuffed pigeons, and mixed grills.',
                'image' => 'http://localhost:8000/api/kamet-images/food_1',
                'price_range_min' => 200,
                'price_range_max' => 600,
                'rating' => 4.7,
                'reviews_count' => 342,
                'opening_hours' => '12:00 PM - 2:00 AM',
                'features' => ['Dine-in', 'Takeaway', 'Reservations', 'Live Music'],
            ],
            [
                'name' => 'Felfela',
                'cuisine' => 'Egyptian Street Food',
                'location' => 'Cairo',
                'address' => 'Downtown, Cairo, Egypt',
                'description' => 'A Cairo institution since 1963, famous for its falafel, ful, and authentic Egyptian breakfast. A must-visit for food lovers.',
                'image' => 'http://localhost:8000/api/kamet-images/food_2',
                'price_range_min' => 50,
                'price_range_max' => 200,
                'rating' => 4.5,
                'reviews_count' => 567,
                'opening_hours' => '7:00 AM - 12:00 AM',
                'features' => ['Dine-in', 'Takeaway', 'Delivery', 'Breakfast'],
            ],
            [
                'name' => 'Zooba',
                'cuisine' => 'Modern Egyptian',
                'location' => 'Cairo',
                'address' => 'Zamalek, Cairo, Egypt',
                'description' => 'Modern twist on Egyptian street food favorites. Creative interpretations of classic dishes in a hip, casual setting.',
                'image' => 'http://localhost:8000/api/kamet-images/food_1',
                'price_range_min' => 100,
                'price_range_max' => 350,
                'rating' => 4.6,
                'reviews_count' => 289,
                'opening_hours' => '8:00 AM - 11:00 PM',
                'features' => ['Dine-in', 'Takeaway', 'Delivery', 'Vegetarian Options'],
            ],
            [
                'name' => 'Naguib Mahfouz Café',
                'cuisine' => 'Egyptian & Oriental',
                'location' => 'Cairo',
                'address' => 'Khan El-Khalili, Cairo, Egypt',
                'description' => 'Named after the Nobel Prize-winning author, this elegant café in the heart of Khan El-Khalili offers traditional Egyptian and Middle Eastern cuisine.',
                'image' => 'http://localhost:8000/api/kamet-images/food_2',
                'price_range_min' => 150,
                'price_range_max' => 500,
                'rating' => 4.4,
                'reviews_count' => 198,
                'opening_hours' => '10:00 AM - 12:00 AM',
                'features' => ['Dine-in', 'Shisha', 'Historic Setting', 'Reservations'],
            ],
            [
                'name' => 'Sofra Restaurant',
                'cuisine' => 'Traditional Luxor',
                'location' => 'Luxor',
                'address' => 'East Bank, Luxor, Egypt',
                'description' => 'A charming rooftop restaurant in Luxor serving delicious traditional Upper Egyptian dishes with stunning views.',
                'image' => 'http://localhost:8000/api/kamet-images/food_1',
                'price_range_min' => 80,
                'price_range_max' => 300,
                'rating' => 4.8,
                'reviews_count' => 156,
                'opening_hours' => '11:00 AM - 11:00 PM',
                'features' => ['Dine-in', 'Rooftop', 'Nile View', 'Vegetarian Options'],
            ],
            [
                'name' => 'Farhat Seafood',
                'cuisine' => 'Seafood',
                'location' => 'Alexandria',
                'address' => 'Corniche, Alexandria, Egypt',
                'description' => 'The finest seafood in Alexandria, right on the Mediterranean coast. Fresh catch daily, grilled to perfection.',
                'image' => 'http://localhost:8000/api/kamet-images/food_2',
                'price_range_min' => 200,
                'price_range_max' => 700,
                'rating' => 4.6,
                'reviews_count' => 423,
                'opening_hours' => '12:00 PM - 1:00 AM',
                'features' => ['Dine-in', 'Sea View', 'Fresh Catch', 'Reservations'],
            ],
        ];

        foreach ($data as $item) {
            Restaurant::create($item);
        }
    }
}
