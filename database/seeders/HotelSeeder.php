<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Hotel;
use App\Models\Room;

class HotelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $locations = [
            'Cairo' => [
                'The Nile Ritz-Carlton', 'Cairo Marriott Hotel & Omar Khayyam', 'Four Seasons Hotel Cairo at Nile Plaza', 'Kempinski Nile Hotel', 'Om Kolthoom Hotel', 'Fairmont Nile City'
            ],
            'Luxor' => [
                'Sofitel Winter Palace Luxor', 'Hilton Luxor Resort & Spa', 'Jolie Ville Hotel & Spa', 'Steigenberger Nile Palace', 'Pavillon Winter Luxor', 'Sonesta St. George Hotel'
            ],
            'Aswan' => [
                'Sofitel Legend Old Cataract', 'Mövenpick Resort Aswan', 'Tolip Aswan Hotel', 'Citymax Hotel Aswan', 'Basma Hotel Aswan', 'Pyramisa Island Hotel Aswan'
            ],
            'Sharm El-Sheikh' => [
                'Rixos Premium Seagate', 'Four Seasons Resort Sharm El Sheikh', 'Sunrise Arabian Beach Resort', 'Steigenberger Alcazar', 'Mövenpick Resort Sharm', 'Stella Di Mare Beach Hotel'
            ],
            'Hurghada' => [
                'Steigenberger ALDAU Beach Hotel', 'Sunrise Royal Makadi Resort', 'Jaz Makadi Star & Spa', 'Baron Palace Sahl Hasheesh', 'Titanic Palace', 'Desert Rose Resort'
            ],
            'Alexandria' => [
                'Four Seasons San Stefano', 'Steigenberger Cecil Hotel', 'Helnan Palestine Hotel', 'Tolip Hotel Alexandria', 'Hilton Alexandria Corniche', 'Paradise Inn Le Metropole'
            ],
            'Giza' => [
                'Marriott Mena House', 'Le Méridien Pyramids Hotel', 'Steigenberger Pyramids Cairo', 'Triumph Luxury Hotel', 'Oasis Hotel Pyramids', 'Grand Pyramids Hotel'
            ],
            'Marsa Matrouh' => [
                'Jaz Almaza Beach Resort', 'Carols Beau Rivage Hotel', 'Beau Site Belle Vue', 'Porto Matrouh Beach Resort', 'Adriatica Hotel', 'Negresco Hotel'
            ],
            'Port Said' => [
                'Resta Port Said Hotel', 'Port Said Hotel', 'Jewel Port Said Hotel', 'Grand Hotel Port Said', 'Palace Hotel Port Said', 'Noras Village'
            ],
            'Fayoum' => [
                'Lazib Inn Resort & Spa', 'Byoum Lakeside Hotel', 'Helnan Auberge Fayoum', 'Tunis Village Resort', 'Tzila Lodge', 'Zad Al Mosafer Guest House'
            ]
        ];

        $images = [
            '/images/hotels/siwa.png',
            '/images/hotels/pyramids.png',
            '/images/hotels/redsea.png',
            '/images/hotels/luxor.png',
            '/images/hotels/aswan.png',
            '/images/hotels/sharm_bungalows.png',
            '/images/hotels/cairo_boutique.png',
            '/images/hotels/cairo_heritage.png',
            '/images/hotels/alex.png',
            '/images/hotels/aswan_cruise.png',
            '/images/hotels/desert.png',
            '/images/hotels/luxor_sunset.png',
            '/images/hotels/marsa_lodge.png',
            '/images/hotels/matrouh.png',
            '/images/hotels/nile.png',
            '/images/hotels/north_coast.png'
        ];

        // Placeholder 3D model for AR view
        $arUrl = 'https://modelviewer.dev/shared-assets/models/Astronaut.glb'; 

        $hotelDescriptions = [
            "Experience luxury at its finest with breathtaking views, world-class amenities, and exquisite dining options.",
            "A serene getaway offering the perfect blend of modern comfort and traditional charm. Relax in our beautiful gardens or pamper yourself at the spa.",
            "Located in the heart of the city, perfect for both business and leisure. Enjoy exceptional service and meticulously designed rooms.",
            "Discover unmatched elegance and sophistication. Our resort features pristine private beaches, infinity pools, and gourmet restaurants.",
            "Immerse yourself in a cultural oasis. Our hotel combines local heritage with luxury facilities to provide an unforgettable stay.",
            "The ideal family destination with plenty of activities, kids clubs, and spacious suites offering panoramic views."
        ];

        $roomFeaturesPool = ["Free WiFi", "AC", "TV", "Mini Bar", "Sea View", "City View", "Bathtub", "Balcony", "Room Service", "Coffee Machine"];

        foreach ($locations as $city => $hotels) {
            foreach ($hotels as $index => $hotelName) {
                
                $hotelImage = $images[$index % count($images)];
                
                // Set specific picture for Om Kolthoom Hotel (Real Image)
                if ($hotelName === 'Om Kolthoom Hotel') {
                    $hotelImage = 'https://vid.alarabiya.net/images/2021/04/09/b87e1451-b844-48ac-a796-7a701dff2acb/b87e1451-b844-48ac-a796-7a701dff2acb_16x9_1200x676.jpg';
                }
                
                $hotel = Hotel::create([
                    'title' => $hotelName,
                    'description' => ($hotelName === 'Om Kolthoom Hotel') 
                        ? 'Experience the timeless elegance and classical Egyptian heritage at the iconic Om Kolthoom Hotel, dedicated to the legacy of the Star of the East.' 
                        : $hotelDescriptions[$index % count($hotelDescriptions)],
                    'location' => $city,
                    'address' => 'Downtown, ' . $city . ', Egypt',
                    'rating' => mt_rand(40, 50) / 10,
                    'reviews_count' => rand(100, 1500),
                    'price_starts_from' => rand(80, 500),
                    'image' => $hotelImage,
                    'gallery' => [
                        $images[($index + 1) % count($images)],
                        $hotelImage,
                        $images[($index + 3) % count($images)],
                    ],
                    'ar_url' => $arUrl
                ]);

                // Create default rooms for this hotel
                $roomsToCreate = [
                    [
                        'room_type' => 'Classic Single Room',
                        'capacity_adults' => 1,
                        'capacity_children' => 0,
                        'price_multiplier' => 1.0,
                    ],
                    [
                        'room_type' => 'Deluxe Double Room',
                        'capacity_adults' => 2,
                        'capacity_children' => 1,
                        'price_multiplier' => 1.5,
                    ],
                    [
                        'room_type' => 'Executive Suite',
                        'capacity_adults' => 2,
                        'capacity_children' => 2,
                        'price_multiplier' => 2.5,
                    ],
                    [
                        'room_type' => 'Presidential Suite',
                        'capacity_adults' => 4,
                        'capacity_children' => 3,
                        'price_multiplier' => 5.0,
                    ]
                ];

                foreach ($roomsToCreate as $rInfo) {
                    $featuresCount = rand(3, 6);
                    shuffle($roomFeaturesPool);
                    $features = array_slice($roomFeaturesPool, 0, $featuresCount);

                    Room::create([
                        'hotel_id' => $hotel->id,
                        'room_type' => $rInfo['room_type'],
                        'capacity_adults' => $rInfo['capacity_adults'],
                        'capacity_children' => $rInfo['capacity_children'],
                        'price_per_night' => $hotel->price_starts_from * $rInfo['price_multiplier'],
                        'available_count' => rand(2, 10),
                        'features' => $features,
                        'image' => $images[rand(0, count($images) - 1)],
                        'ar_url' => $arUrl
                    ]);
                }
            }
        }
    }
}
