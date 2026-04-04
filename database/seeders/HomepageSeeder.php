<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Destination;
use App\Models\TravelPackage;
use App\Models\Bazaar;
use App\Models\Deal;

class HomepageSeeder extends Seeder
{
    public function run(): void
    {
        // مسح البيانات القديمة لتجنب التكرار
        Destination::truncate();
        TravelPackage::truncate();
        Bazaar::truncate();
        Deal::truncate();

        $baseUrl = url('/images/home/trending-destinations');
        
        // --- 1. Seed Destinations ---
        $destinations = [
            ['title' => 'Cairo', 'src' => "$baseUrl/download%20(1)c.ario.png", 'alt' => 'Cairo', 'tours' => 1200],
            ['title' => 'Alexandria', 'src' => "$baseUrl/Alx.png", 'alt' => 'Alexandria', 'tours' => 610],
            ['title' => 'Luxor', 'src' => "$baseUrl/luxor.png", 'alt' => 'Luxor', 'tours' => 850],
            ['title' => 'Sharm El.S', 'src' => "$baseUrl/foto_egipet_sharm_el_shejh_foto_1.jpg-1024x687.png", 'alt' => 'Sharm El-Sheikh', 'tours' => 1540],
            ['title' => 'Hurghada', 'src' => "$baseUrl/Hurghada_R03.jpg", 'alt' => 'Hurghada', 'tours' => 1390],
            ['title' => 'Aswan', 'src' => "$baseUrl/aswan.png", 'alt' => 'Aswan', 'tours' => 720],
            ['title' => 'Marsa Alam', 'src' => "$baseUrl/marsallm.png", 'alt' => 'Marsa Alam', 'tours' => 540],
            ['title' => 'Dahab', 'src' => "$baseUrl/سفاري-دهب-بيتش-باجي.png", 'alt' => 'Dahab', 'tours' => 980],
            ['title' => 'Marsa Matruh', 'src' => "$baseUrl/download%20(1)c.ario.png", 'alt' => 'Marsa Matruh', 'tours' => 460],
            ['title' => 'New Capital', 'src' => "$baseUrl/download%20(1)c.ario.png", 'alt' => 'New Capital', 'tours' => 320],
        ];

        foreach ($destinations as $dest) {
            Destination::create($dest);
        }

        // --- 2. Seed Travel Packages ---
        $packages = [
            [
                'title' => 'Siwa Oasis Safari & Camping Adventure',
                'image' => "$baseUrl/marsallm.png", // reuse image
                'alt' => 'Siwa Oasis Safari',
                'tag' => 'Adventure',
                'date' => 'November 15 2024',
                'author' => 'Omar Tariq',
                'price' => 350,
                'duration' => '4 days',
                'activities' => ["4x4 dune bashing", "Sandboarding", "Shali Fortress tour", "Cleopatra's Pool swim"],
                'highlights' => ["Camp under the Milky Way", "Organic Siwan meals included", "Local Bedouin guide"],
                'hotel' => ["Taghaghien Island Resort - 2 Nights", "Desert Camp (Tents) - 1 Night"],
                'museum' => ["Siwa House Museum"],
                'excluded' => ["Personal Expenses", "Tips & Gratuities", "Optional Quad Biking"]
            ],
            [
                'title' => 'Luxor & Aswan Nile Cruise Magic',
                'image' => "$baseUrl/download%20(1)c.ario.png",
                'alt' => 'Nile Cruise Magic',
                'tag' => 'Historic',
                'date' => 'October 10 2024',
                'author' => 'Sara Ahmed',
                'price' => 599,
                'duration' => '5 days',
                'activities' => ["Karnak Temple visit", "Valley of the Kings tomb tour", "Philae Temple light show"],
                'highlights' => ["5-Star Nile Cruise Ship", "Expert Egyptologist on board", "All meals included"],
                'hotel' => ["MS Esplanade Luxury Cruise - 4 Nights"],
                'museum' => ["Luxor Museum", "Nubian Museum"],
                'excluded' => ["International Flights", "Beverages onboard", "Abu Simbel Optional Trip"]
            ],
            [
                'title' => 'Sinai Trail & St. Catherine Monastery Hike',
                'image' => "$baseUrl/سفاري-دهب-بيتش-باجي.png",
                'alt' => 'Sinai Trail',
                'tag' => 'Hiking',
                'date' => 'December 05 2024',
                'author' => 'Karim Hassan',
                'price' => 180,
                'duration' => '3 days',
                'activities' => ["Mount Sinai Sunrise Hike", "St. Catherine Monastery guided tour", "Bedouin tea gathering"],
                'highlights' => ["Climb the biblical Mount Sinai", "Visit the Burning Bush", "Stay at an eco-lodge"],
                'hotel' => ["Morgenland Village Hotel - 2 Nights"],
                'museum' => ["Monastery Library & Icons section"],
                'excluded' => ["Lunches & Dinners", "Camel Ride to Summit"]
            ],
        ];

        foreach ($packages as $pkg) {
            TravelPackage::create($pkg);
        }

        // --- 3. Seed Bazaars ---
        $bazaars = [
            [
                'title' => 'Khan el-Khalili',
                'location' => 'Cairo, Egypt',
                'image' => "$baseUrl/download%20(1)c.ario.png",
                'description' => 'A famous historic bazaar and souq in the center of Cairo. Master artisans craft beautiful jewelry, copper, and lanterns right before your eyes.',
                'specialty' => ["Spices", "Handicrafts", "Jewelry"]
            ],
            [
                'title' => 'Aswan Spice Market',
                'location' => 'Aswan, Egypt',
                'image' => "$baseUrl/Hurghada_R03.jpg",
                'description' => 'A sensory explosion of colors and aromas. Best place to buy authentic Nubian spices, hibiscus tea, and natural perfumes.',
                'specialty' => ["Spices", "Herbs", "Perfumes"]
            ],
            [
                'title' => 'Luxor Tourist Souq',
                'location' => 'Luxor, Egypt',
                'image' => "$baseUrl/luxor.png",
                'description' => 'Wander through lanes dedicated to alabaster statues, papyrus art, and traditional clothing near the glorious Luxor Temple.',
                'specialty' => ["Alabaster", "Papyrus", "Cotton"]
            ],
            [
                'title' => 'Sharm Old Market',
                'location' => 'Sharm El-Sheikh',
                'image' => "$baseUrl/foto_egipet_sharm_el_shejh_foto_1.jpg-1024x687.png",
                'description' => 'Also known as Sharm El Maya. Famous for its beautiful Sahaba Mosque, traditional herbs, essential oils, and local cafes.',
                'specialty' => ["Oils", "Herbs", "Souvenirs"]
            ],
            [
                'title' => 'Shali Market',
                'location' => 'Siwa Oasis',
                'image' => "$baseUrl/aswan.png",
                'description' => 'Shop for unique Siwan crafts, including deeply embroidered dresses, silver jewelry, and the world\'s best organic dates.',
                'specialty' => ["Dates", "Olive Oil", "Silver"]
            ],
            [
                'title' => 'Mansheya Market',
                'location' => 'Alexandria, Egypt',
                'image' => "$baseUrl/Alx.png",
                'description' => 'A bustling coastal European-style square mixed with Egyptian charm. Discover local textiles, gold, and the famous Zan\'et El Setat alley.',
                'specialty' => ["Textiles", "Gold", "Antiques"]
            ]
        ];

        foreach ($bazaars as $bazaar) {
            Bazaar::create($bazaar);
        }

        // --- 4. Seed Deals ---
        $deals = [
            [
                'category' => 'Restaurant',
                'icon' => '🍽️',
                'title' => 'Hadramaut Mandi — حضرموت مندي',
                'locations' => 'Nasr City, Cairo',
                'image' => "$baseUrl/download%20(1)c.ario.png",
                'price' => 'From $15',
                'rating' => 4.8,
                'color' => '#E74C3C',
                'link' => '/restaurants',
                'items' => ["Mandi Lamb — مندي لحم", "Madhbi Chicken — مضبي دجاج", "Haneeth Rice — حنيذ", "Yemeni Bread & Honey"]
            ],
            [
                'category' => 'Hotel',
                'icon' => '🏨',
                'title' => 'Kempinski Nile Hotel — كمبينسكي',
                'locations' => 'Garden City, Cairo',
                'image' => "$baseUrl/download%20(1)c.ario.png",
                'price' => 'From $180/night',
                'rating' => 4.9,
                'color' => '#3498DB',
                'link' => '/hotels',
                'items' => ["Deluxe Nile View Room", "Executive Suite", "Royal Suite with Terrace", "Presidential Suite"]
            ],
            [
                'category' => 'Museum',
                'icon' => '🏛️',
                'title' => 'Grand Egyptian Museum — المتحف الكبير',
                'locations' => 'Giza Plateau, Cairo',
                'image' => "$baseUrl/luxor.png",
                'price' => 'From $20',
                'rating' => 4.9,
                'color' => '#D4AF37',
                'link' => '/museums',
                'items' => ["King Tutankhamun Gallery", "Royal Mummies Hall", "Grand Staircase & Pyramids View", "Children's Museum"]
            ],
            [
                'category' => 'Event',
                'icon' => '🎪',
                'title' => 'Sound & Light Show — الصوت والضوء',
                'locations' => 'Giza Pyramids, Cairo',
                'image' => "$baseUrl/download%20(1)c.ario.png",
                'price' => 'From $25',
                'rating' => 4.6,
                'color' => '#9B59B6',
                'link' => '/events',
                'items' => ["Sound & Light Show — عرض الصوت والضوء", "VIP Front Row Seating", "Pyramids Night Photography", "Hotel Transfer"]
            ],
            [
                'category' => 'Safari',
                'icon' => '🏜️',
                'title' => 'Siwa Oasis Safari — سفاري سيوة',
                'locations' => 'Siwa Oasis, Western Desert',
                'image' => "$baseUrl/marsallm.png",
                'price' => 'From $85',
                'rating' => 4.8,
                'color' => '#E67E22',
                'link' => '/safari',
                'items' => ["4x4 Dune Bashing — سباق الكثبان", "Camping Under the Stars — تخييم", "Sandboarding — تزلج الرمال", "Salt Lakes — بحيرات الملح"]
            ],
            [
                'category' => 'Diving',
                'icon' => '🤿',
                'title' => 'Red Sea Diving — غوص البحر الأحمر',
                'locations' => 'Sharm El Sheikh, Red Sea',
                'image' => "$baseUrl/Hurghada_R03.jpg",
                'price' => 'From $55',
                'rating' => 4.9,
                'color' => '#1ABC9C',
                'link' => '/activities',
                'items' => ["Ras Mohamed Reef Diving — غوص رأس محمد", "Tiran Island Snorkeling — سنوركل تيران", "SS Thistlegorm Wreck — حطام السفينة", "Night Diving — غوص ليلي"]
            ],
            [
                'category' => 'Nile Cruise',
                'icon' => '⛵',
                'title' => 'MS Esplanade Cruise — كروز إسبلاناد',
                'locations' => 'Luxor → Edfu → Kom Ombo → Aswan',
                'image' => "$baseUrl/aswan.png",
                'price' => 'From $350',
                'rating' => 4.9,
                'color' => '#05073C',
                'link' => '/tours',
                'items' => ["Karnak & Luxor Temples — معابد الكرنك", "Valley of the Kings — وادي الملوك", "Edfu & Kom Ombo — معبد إدفو", "Philae Temple — معبد فيلة"]
            ],
        ];

        foreach ($deals as $deal) {
            Deal::create($deal);
        }
    }
}
