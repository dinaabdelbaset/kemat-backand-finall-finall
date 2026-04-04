<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        if (Event::count() === 0) {
            $this->seedEvents();
        }

        return response()->json(Event::all());
    }

    public function show($id)
    {
        $event = Event::find($id);
        if (!$event) {
            return response()->json(['message' => 'Event not found'], 404);
        }
        return response()->json($event);
    }

    private function seedEvents()
    {
        $data = [
            [
                'title' => 'Pyramids Sound & Light Show',
                'description' => 'Experience the magic of the Pyramids illuminated at night with a spectacular sound and light show narrating 7000 years of Egyptian history.',
                'location' => 'Giza',
                'venue' => 'Giza Pyramids Plateau',
                'date' => '2026-05-15',
                'time' => '7:30 PM',
                'price' => 350,
                'category' => 'Show',
                'image' => url('/api/kamet-images/pyramids'),
                'rating' => 4.8,
            ],
            [
                'title' => 'Whirling Dervishes at Al-Ghouri',
                'description' => 'Free weekly performance of the traditional Sufi Tanoura dance at the historic Al-Ghouri complex in Islamic Cairo.',
                'location' => 'Cairo',
                'venue' => 'Al-Ghouri Complex',
                'date' => '2026-05-20',
                'time' => '8:00 PM',
                'price' => 0,
                'category' => 'Cultural',
                'image' => url('/api/kamet-images/dervishes'),
                'rating' => 4.9,
            ],
            [
                'title' => 'Cairo Jazz Festival',
                'description' => 'Annual music festival featuring local and international jazz, blues, and world music artists performing across multiple stages.',
                'location' => 'Cairo',
                'venue' => 'Cairo Opera House',
                'date' => '2026-06-10',
                'time' => '6:00 PM',
                'price' => 500,
                'category' => 'Music',
                'image' => url('/api/kamet-images/jazz'),
                'rating' => 4.7,
            ],
            [
                'title' => 'Opera Aida at the Pyramids',
                'description' => 'A stunning outdoor performance of Verdi\'s Aida opera set against the backdrop of the Great Pyramids.',
                'location' => 'Giza',
                'venue' => 'Pyramids Plateau',
                'date' => '2026-07-01',
                'time' => '8:00 PM',
                'price' => 1200,
                'category' => 'Opera',
                'image' => url('/api/kamet-images/opera'),
                'rating' => 4.9,
            ],
            [
                'title' => 'Red Sea EDM Beach Party',
                'description' => 'Dance the night away on the shores of the Red Sea with top international DJs and stunning visual effects.',
                'location' => 'Hurghada',
                'venue' => 'Soma Bay Beach',
                'date' => '2026-06-25',
                'time' => '9:00 PM',
                'price' => 800,
                'category' => 'Music',
                'image' => url('/api/kamet-images/edm'),
                'rating' => 4.5,
            ],
            [
                'title' => 'Cairo International Book Fair',
                'description' => 'The largest book fair in the Arab world featuring thousands of publishers, author signings, and cultural events.',
                'location' => 'Cairo',
                'venue' => 'Egypt International Exhibition Center',
                'date' => '2026-08-15',
                'time' => '10:00 AM',
                'price' => 50,
                'category' => 'Cultural',
                'image' => url('/api/kamet-images/book'),
                'rating' => 4.3,
            ],
        ];

        foreach ($data as $item) {
            Event::create($item);
        }
    }
}
