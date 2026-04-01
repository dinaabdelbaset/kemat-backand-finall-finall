<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Activity;

class ActivitySeeder extends Seeder
{
    public function run()
    {
        Activity::create([
            'title' => 'Hot Air Balloon Ride',
            'description' => 'Experience the magic of Luxor from above at sunrise. Float peacefully over the ancient temples and the Valley of the Kings, taking in breathtaking views of the Nile River.',
            'image' => '/luxor_balloon.png',
            'price' => 75.00,
            'location' => 'Luxor',
            'rating' => 4.9,
            'review_count' => 312
        ]);

        Activity::create([
            'title' => 'Nile River Cruise',
            'description' => 'Set sail on the majestic Nile River. Enjoy a luxurious cruise with traditional entertainment, fine dining, and endless views of Egypt’s beautiful landscapes.',
            'image' => '/nile_dinner_cruise_elegant.png',
            'price' => 120.00,
            'location' => 'Aswan',
            'rating' => 4.8,
            'review_count' => 245
        ]);

        Activity::create([
            'title' => 'Desert Safari & Stargazing',
            'description' => 'Embark on an adrenaline-pumping 4x4 desert safari. Ride quad bikes, visit a Bedouin village, enjoy traditional tea, and end your night with spectacular stargazing.',
            'image' => '/desert_safari.png',
            'price' => 45.00,
            'location' => 'Hurghada',
            'rating' => 4.7,
            'review_count' => 189
        ]);

        Activity::create([
            'title' => 'Red Sea Scuba Diving',
            'description' => 'Dive into the crystal-clear waters of the Red Sea. Explore vibrant coral reefs and discover an incredible variety of colorful marine life alongside professional instructors.',
            'image' => '/red_sea_scuba.png',
            'price' => 60.00,
            'location' => 'Sharm El Sheikh',
            'rating' => 4.9,
            'review_count' => 410
        ]);

        Activity::create([
            'title' => 'Cairo Local Food Tour',
            'description' => 'Taste the authentic flavors of Egypt. From Koshary to Shawarma and traditional Egyptian sweets, walk through the bustling streets of Downtown Cairo with a local guide.',
            'image' => '/cairo_food_tour.png',
            'price' => 30.00,
            'location' => 'Cairo',
            'rating' => 4.6,
            'review_count' => 150
        ]);

        Activity::create([
            'title' => 'Pyramids Sound & Light Show',
            'description' => 'Experience the history of the Pharaohs as the Pyramids of Giza and the Sphinx are illuminated. A spectacular audio-visual journey through ancient Egyptian time.',
            'image' => '/pyramids_sound_light.png',
            'price' => 25.00,
            'location' => 'Giza',
            'rating' => 4.5,
            'review_count' => 520
        ]);
    }
}
