<?php

namespace App\Http\Controllers;

use App\Models\Museum;
use Illuminate\Http\Request;

class MuseumController extends Controller
{
    public function index()
    {
        if (Museum::count() === 0) {
            $this->seedMuseums();
        }

        return response()->json(Museum::all());
    }

    public function show($id)
    {
        $museum = Museum::find($id);
        if (!$museum) {
            return response()->json(['message' => 'Museum not found'], 404);
        }
        return response()->json($museum);
    }

    private function seedMuseums()
    {
        $data = [
            [
                'name' => 'Grand Egyptian Museum (GEM)',
                'location' => 'Giza',
                'address' => 'Cairo-Alexandria Desert Road, Giza',
                'description' => 'The largest archaeological museum in the world, housing over 100,000 artifacts including the complete collection of Tutankhamun\'s treasures.',
                'image' => 'http://localhost:8000/api/kamet-images/lm_gem',
                'ticket_price' => 600,
                'opening_hours' => '9:00 AM - 7:00 PM',
                'rating' => 4.9,
                'reviews_count' => 1250,
                'highlights' => ['Tutankhamun Collection', 'Royal Mummies Hall', 'Solar Boat Museum', 'Virtual Reality Experience'],
            ],
            [
                'name' => 'National Museum of Egyptian Civilization (NMEC)',
                'location' => 'Cairo',
                'address' => 'Ain El-Sira, Old Cairo',
                'description' => 'Home to the Royal Mummies Hall, this museum traces Egyptian civilization from prehistoric times to the present day.',
                'image' => 'http://localhost:8000/api/kamet-images/lm_nmec',
                'ticket_price' => 400,
                'opening_hours' => '9:00 AM - 5:00 PM',
                'rating' => 4.7,
                'reviews_count' => 890,
                'highlights' => ['Royal Mummies Hall', 'Prehistoric Gallery', 'Islamic Art Wing', 'Modern Egypt Section'],
            ],
            [
                'name' => 'Karnak Temple Complex',
                'location' => 'Luxor',
                'address' => 'East Bank, Luxor',
                'description' => 'The largest ancient religious site in the world, dedicated to the Theban triad of Amun, Mut, and Khonsu.',
                'image' => 'http://localhost:8000/api/kamet-images/lm_karnak',
                'ticket_price' => 300,
                'opening_hours' => '6:00 AM - 5:30 PM',
                'rating' => 4.9,
                'reviews_count' => 2100,
                'highlights' => ['Great Hypostyle Hall', 'Sacred Lake', 'Avenue of Sphinxes', 'Sound & Light Show'],
            ],
            [
                'name' => 'Luxor Museum',
                'location' => 'Luxor',
                'address' => 'Corniche El Nile, Luxor',
                'description' => 'A beautifully curated museum featuring artifacts from the Theban area, including statues, jewelry, and pottery from various Egyptian periods.',
                'image' => 'http://localhost:8000/api/kamet-images/lm_luxor_museum',
                'ticket_price' => 200,
                'opening_hours' => '9:00 AM - 2:00 PM, 4:00 PM - 9:00 PM',
                'rating' => 4.6,
                'reviews_count' => 560,
                'highlights' => ['Tutankhamun Statues', 'Amenhotep III Gallery', 'New Kingdom Artifacts', 'Military Equipment Display'],
            ],
            [
                'name' => 'Abu Simbel Temples',
                'location' => 'Aswan',
                'address' => 'Abu Simbel, Aswan Governorate',
                'description' => 'Two massive rock temples built by Ramesses II, rescued from the rising waters of Lake Nasser in an incredible UNESCO engineering feat.',
                'image' => 'http://localhost:8000/api/kamet-images/lm_abu_simbel',
                'ticket_price' => 500,
                'opening_hours' => '5:00 AM - 6:00 PM',
                'rating' => 4.9,
                'reviews_count' => 1800,
                'highlights' => ['Sun Festival Alignment', 'Great Temple of Ramesses II', 'Temple of Nefertari', 'Lake Nasser Views'],
            ],
            [
                'name' => 'Philae Temple',
                'location' => 'Aswan',
                'address' => 'Agilkia Island, Aswan',
                'description' => 'The stunning temple of Isis, relocated to Agilkia Island after the construction of the Aswan High Dam. A masterpiece of ancient architecture.',
                'image' => 'http://localhost:8000/api/kamet-images/lm_philae',
                'ticket_price' => 250,
                'opening_hours' => '7:00 AM - 4:00 PM',
                'rating' => 4.8,
                'reviews_count' => 920,
                'highlights' => ['Temple of Isis', 'Kiosk of Trajan', 'Sound & Light Show', 'Boat Ride to Island'],
            ],
        ];

        foreach ($data as $item) {
            Museum::create($item);
        }
    }
}
