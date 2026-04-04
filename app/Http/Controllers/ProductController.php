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
            'image' => 'http://127.0.0.1:8000/api/kamet-images/shop_papyrus'
        ],
        [
            'id' => 2,
            'name' => 'Alabaster Nefertiti Statue',
            'description' => 'Hand-carved authentic alabaster statue of Queen Nefertiti from the West Bank of Luxor.',
            'price' => 85.00,
            'category' => 'Statues',
            'image' => 'http://127.0.0.1:8000/api/kamet-images/shop_nefertiti'
        ],
        [
            'id' => 3,
            'name' => 'Mask of Tutankhamun Replica',
            'description' => 'A stunning museum-quality replica of the golden mask of King Tutankhamun, encrusted with semi-precious stones.',
            'price' => 250.00,
            'category' => 'Gifts',
            'image' => 'http://127.0.0.1:8000/api/kamet-images/shop_tut_mask'
        ],
        [
            'id' => 4,
            'name' => 'Custom Silver Cartouche',
            'description' => 'Personalized sterling silver cartouche with your name written in ancient Egyptian hieroglyphics.',
            'price' => 120.00,
            'category' => 'Jewelry',
            'image' => 'http://127.0.0.1:8000/api/kamet-images/shop_cartouche'
        ],
        [
            'id' => 5,
            'name' => 'Premium Egyptian Cotton Scarf',
            'description' => '100% genuine woven Egyptian cotton scarf. Soft, breathable, and culturally designed.',
            'price' => 35.00,
            'category' => 'Clothing',
            'image' => 'http://127.0.0.1:8000/api/kamet-images/shop_scarf'
        ],
        [
            'id' => 6,
            'name' => 'Handmade Nubian Basket Craft',
            'description' => 'Vibrantly colored, hand-woven Nubian basket directly from traditional artisans in Aswan.',
            'price' => 60.00,
            'category' => 'Art & Crafts',
            'image' => 'http://127.0.0.1:8000/api/kamet-images/shop_nubian_basket'
        ],
        [
            'id' => 7,
            'name' => 'Pharaonic God Anubis Statue',
            'description' => 'Exquisite basalt replica statue of Anubis, the ancient Egyptian god, crafted with authentic detailing.',
            'price' => 95.00,
            'category' => 'Statues',
            'image' => 'http://127.0.0.1:8000/api/kamet-images/shop_anubis'
        ],
        [
            'id' => 8,
            'name' => 'Khan El Khalili Spice Box',
            'description' => 'A curated selection of premium Egyptian spices including cumin, coriander, and authentic saffron.',
            'price' => 55.00,
            'category' => 'Gifts',
            'image' => 'http://127.0.0.1:8000/api/kamet-images/shop_spice_box'
        ]
    ];

    public function index()
    {
        $products = Product::all();
        if ($products->isEmpty()) {
            foreach ($this->mockProducts as $mockProduct) {
                Product::create([
                    'name' => $mockProduct['name'],
                    'description' => $mockProduct['description'],
                    'price' => $mockProduct['price'],
                    'category' => $mockProduct['category'],
                    'image' => $mockProduct['image'],
                    'stock' => 100
                ]);
            }
            $products = Product::all();
        } else {
            // Force update existing DB rows if they contain broken unsplash/wikimedia links
            foreach ($products as $p) {
                if (str_contains($p->image, 'unsplash') || str_contains($p->image, 'wikimedia')) {
                    $mockEquivalent = collect($this->mockProducts)->firstWhere('name', $p->name);
                    if ($mockEquivalent) {
                        $p->update(['image' => $mockEquivalent['image']]);
                    }
                }
            }
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
