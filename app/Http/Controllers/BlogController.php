<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        // Auto-seed if empty
        if (Blog::count() === 0) {
            $this->seedBlogs();
        }

        return response()->json(Blog::orderBy('created_at', 'desc')->get());
    }

    public function show($id)
    {
        $blog = Blog::find($id);
        if (!$blog) {
            return response()->json(['message' => 'Blog not found'], 404);
        }
        return response()->json($blog);
    }

    private function seedBlogs()
    {
        $blogs = [
            [
                'title' => 'Top 10 Must-Visit Temples in Luxor',
                'slug' => 'top-10-temples-luxor',
                'excerpt' => 'Discover the most breathtaking ancient temples in Luxor, from Karnak to the Valley of the Kings.',
                'content' => '<p>Luxor, often called the world\'s greatest open-air museum, is home to some of the most magnificent temples ever built. From the towering columns of Karnak Temple to the serene beauty of Hatshepsut\'s mortuary temple, each site tells a story spanning thousands of years.</p><h2>1. Karnak Temple Complex</h2><p>The largest religious building ever constructed, Karnak Temple is a vast mix of decayed temples, chapels, pylons, and other buildings.</p><h2>2. Luxor Temple</h2><p>Located on the east bank of the Nile, this temple was built approximately 1400 BCE and is dedicated to Amun, Mut, and Khonsu.</p><h2>3. Valley of the Kings</h2><p>This valley is known for containing the tombs of pharaohs and powerful nobles of the New Kingdom.</p>',
                'image' => 'http://localhost:8000/api/kamet-images/lm_karnak',
                'author' => 'Ahmed Hassan',
                'category' => 'History',
                'tags' => ['temples', 'luxor', 'ancient egypt', 'history'],
                'read_time' => 8,
            ],
            [
                'title' => 'A Complete Guide to Egyptian Street Food',
                'slug' => 'egyptian-street-food-guide',
                'excerpt' => 'From koshari to falafel, explore the vibrant street food scene that makes Egyptian cuisine unforgettable.',
                'content' => '<p>Egyptian street food is a culinary adventure that reflects the country\'s rich cultural heritage. Whether you\'re wandering through the bustling lanes of Cairo or exploring the markets of Alexandria, delicious food is never far away.</p><h2>Koshari</h2><p>Egypt\'s national dish combines rice, lentils, pasta, chickpeas, and crispy onions with a tangy tomato sauce.</p><h2>Ful Medames</h2><p>A hearty breakfast staple made from slow-cooked fava beans, seasoned with cumin, lemon, and olive oil.</p><h2>Ta\'ameya (Egyptian Falafel)</h2><p>Made with fava beans instead of chickpeas, Egyptian falafel is crispy on the outside and herb-green on the inside.</p>',
                'image' => 'http://localhost:8000/api/kamet-images/food_1',
                'author' => 'Sara Mohamed',
                'category' => 'Food & Culture',
                'tags' => ['food', 'street food', 'cairo', 'cuisine'],
                'read_time' => 6,
            ],
            [
                'title' => 'Best Diving Spots in the Red Sea',
                'slug' => 'best-diving-spots-red-sea',
                'excerpt' => 'The Red Sea offers some of the world\'s most spectacular diving experiences with crystal-clear waters and vibrant marine life.',
                'content' => '<p>The Red Sea is a diver\'s paradise, boasting warm waters, stunning coral reefs, and an incredible diversity of marine life. Whether you\'re a beginner or an experienced diver, there\'s something here for everyone.</p><h2>Ras Mohammed National Park</h2><p>Located at the southern tip of the Sinai Peninsula, this park features dramatic walls and reef sharks.</p><h2>SS Thistlegorm</h2><p>One of the world\'s most famous wreck dives, this WWII cargo ship rests at the bottom of the Red Sea.</p><h2>Blue Hole, Dahab</h2><p>A world-famous sinkhole that attracts divers from around the globe with its stunning underwater arch.</p>',
                'image' => 'http://localhost:8000/api/kamet-images/deal_dive_coral',
                'author' => 'Omar Khalil',
                'category' => 'Adventure',
                'tags' => ['diving', 'red sea', 'sharm el-sheikh', 'marine life'],
                'read_time' => 7,
            ],
            [
                'title' => 'Exploring the White Desert: A Surreal Adventure',
                'slug' => 'exploring-white-desert',
                'excerpt' => 'Journey into Egypt\'s White Desert where chalk-white rock formations create an otherworldly landscape.',
                'content' => '<p>The White Desert, located in the Farafra Depression, is one of Egypt\'s most stunning natural wonders. The landscape is dotted with massive chalk-white rock formations that have been shaped by wind erosion into surreal mushroom-like shapes.</p><h2>Getting There</h2><p>The White Desert is located approximately 500 km from Cairo. Most visitors join organized safari tours that depart from Bahariya Oasis.</p><h2>What to Expect</h2><p>Camp under the stars, explore crystal mountain, and witness the desert transform from white to gold as the sun sets.</p>',
                'image' => 'http://localhost:8000/api/kamet-images/deal_safari_camp',
                'author' => 'Fatma Ali',
                'category' => 'Adventure',
                'tags' => ['desert', 'safari', 'camping', 'nature'],
                'read_time' => 5,
            ],
            [
                'title' => 'Nile Cruise: Everything You Need to Know',
                'slug' => 'nile-cruise-guide',
                'excerpt' => 'Plan the perfect Nile cruise from Luxor to Aswan with our comprehensive guide covering routes, tips, and highlights.',
                'content' => '<p>A Nile cruise is the quintessential Egyptian experience. Gliding along the world\'s longest river, you\'ll pass by ancient temples, lush farmland, and traditional villages that seem untouched by time.</p><h2>Popular Routes</h2><p>Most cruises travel between Luxor and Aswan, with stops at Edfu and Kom Ombo temples along the way.</p><h2>Best Time to Go</h2><p>October to April offers the most comfortable temperatures for a Nile cruise.</p><h2>What to Pack</h2><p>Light layers, sunscreen, comfortable walking shoes, and a camera are essential.</p>',
                'image' => 'http://localhost:8000/api/kamet-images/deal_nile_deck',
                'author' => 'Ahmed Hassan',
                'category' => 'Travel Tips',
                'tags' => ['nile', 'cruise', 'luxor', 'aswan'],
                'read_time' => 10,
            ],
            [
                'title' => 'Shopping Guide: Khan El-Khalili Bazaar',
                'slug' => 'khan-el-khalili-shopping-guide',
                'excerpt' => 'Navigate Cairo\'s legendary bazaar like a pro with our insider tips on bargaining, must-buy souvenirs, and hidden gems.',
                'content' => '<p>Khan El-Khalili is one of the oldest and most famous bazaars in the Middle East, dating back to 1382. This maze-like market in the heart of Islamic Cairo is a treasure trove of Egyptian handicrafts, jewelry, spices, and souvenirs.</p><h2>Top Things to Buy</h2><p>Look for handmade papyrus art, alabaster vases, silver cartouche necklaces, and aromatic Egyptian spices.</p><h2>Bargaining Tips</h2><p>Start at about 40% of the asking price and negotiate from there. Always smile and be friendly!</p>',
                'image' => 'http://localhost:8000/api/kamet-images/baz_cairo',
                'author' => 'Mona Saeed',
                'category' => 'Shopping',
                'tags' => ['shopping', 'bazaar', 'cairo', 'souvenirs'],
                'read_time' => 6,
            ],
        ];

        foreach ($blogs as $blog) {
            Blog::create($blog);
        }
    }
}
