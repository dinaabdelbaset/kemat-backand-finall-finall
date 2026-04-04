<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Museum extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'location', 'address', 'description', 'image',
        'gallery', 'ticket_price', 'opening_hours', 'rating',
        'reviews_count', 'highlights'
    ];

    protected $casts = [
        'gallery' => 'array',
        'highlights' => 'array',
        'rating' => 'float',
    ];
}
