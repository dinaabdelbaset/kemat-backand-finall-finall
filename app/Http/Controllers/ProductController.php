<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $mockProducts = [
        [
            'id' => 1,
            'name' => 'Authentic Hand-Painted Papyrus',
            'description' => 'Original papyrus painting illustrating the Tree of Life. Hand-painted by local artists in Luxor.',
            'price' => 45.00,
            'category' => 'Art & Crafts',
            'image' => 'https://upload.wikimedia.org/wikipedia/commons/4/4f/Ani_papyrus.jpg'
        ],
        [
            'id' => 2,
            'name' => 'Alabaster Nefertiti Statue',
            'description' => 'Hand-carved authentic alabaster statue of Queen Nefertiti from the West Bank of Luxor.',
            'price' => 85.00,
            'category' => 'Statues',
            'image' => 'https://upload.wikimedia.org/wikipedia/commons/1/1f/Nofretete_Neues_Museum.jpg'
        ],
        [
            'id' => 3,
            'name' => 'Mask of Tutankhamun Replica',
            'description' => 'A stunning museum-quality replica of the golden mask of King Tutankhamun, encrusted with semi-precious stones.',
            'price' => 250.00,
            'category' => 'Gifts',
            'image' => 'https://upload.wikimedia.org/wikipedia/commons/d/df/Tutanchamun_Maske.jpg'
        ],
        [
            'id' => 4,
            'name' => 'Custom Silver Cartouche',
            'description' => 'Personalized sterling silver cartouche with your name written in ancient Egyptian hieroglyphics.',
            'price' => 120.00,
            'category' => 'Jewelry',
            'image' => 'https://upload.wikimedia.org/wikipedia/commons/8/87/Oseirion%2C_Cartouche_of_Seti_I%2C_Egypt.jpg'
        ],
        [
            'id' => 5,
            'name' => 'Premium Egyptian Cotton Scarf',
            'description' => '100% genuine woven Egyptian cotton scarf. Soft, breathable, and culturally designed.',
            'price' => 35.00,
            'category' => 'Clothing',
            'image' => 'https://images.unsplash.com/photo-1520006403909-838d6b92c22e?w=800&auto=format&fit=crop'
        ],
        [
            'id' => 6,
            'name' => 'Handmade Nubian Basket Craft',
            'description' => 'Vibrantly colored, hand-woven Nubian basket directly from traditional artisans in Aswan.',
            'price' => 60.00,
            'category' => 'Art & Crafts',
            'image' => 'https://upload.wikimedia.org/wikipedia/commons/4/48/Nubian_Basketry.jpg'
        ],
        [
            'id' => 7,
            'name' => 'Pharaonic God Anubis Statue',
            'description' => 'Exquisite basalt replica statue of Anubis, the ancient Egyptian god, crafted with authentic detailing.',
            'price' => 95.00,
            'category' => 'Statues',
            'image' => 'https://upload.wikimedia.org/wikipedia/commons/9/9f/Anubis_statue_from_Tutankhamun_tomb.jpg'
        ],
        [
            'id' => 8,
            'name' => 'Khan El Khalili Spice Box',
            'description' => 'A curated selection of premium Egyptian spices including cumin, coriander, and authentic saffron.',
            'price' => 55.00,
            'category' => 'Gifts',
            'image' => 'https://upload.wikimedia.org/wikipedia/commons/a/a2/Spices_in_an_Indian_market.jpg'
        ]
    ];

    public function index()
    {
        $products = Product::all();
        if ($products->isEmpty()) {
            foreach ($this->mockProducts as $mockProduct) {
                Product::create([
                    // DO NOT pass 'id' here or let it auto-increment, but since mock ID matches, it's safer to just insert
                    'name' => $mockProduct['name'],
                    'description' => $mockProduct['description'],
                    'price' => $mockProduct['price'],
                    'category' => $mockProduct['category'],
                    'image' => $mockProduct['image'],
                    'stock' => 100 // default stock
                ]);
            }
            $products = Product::all(); // Re-fetch after inserting
        }
        return response()->json($products);
    }

    public function show($id)
    {
        $product = Product::find($id);
        if (!$product) {
            $mockProduct = collect($this->mockProducts)->firstWhere('id', (int)$id);
            if ($mockProduct) {
                return response()->json($mockProduct);
            }
            return response()->json(['message' => 'Product not found'], 404);
        }
        return response()->json($product);
    }
}
