<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'cuisine', 'location', 'address', 'description',
        'image', 'gallery', 'price_range_min', 'price_range_max',
        'rating', 'reviews_count', 'opening_hours', 'features'
    ];

    protected $casts = [
        'gallery' => 'array',
        'features' => 'array',
        'rating' => 'float',
    ];
}
