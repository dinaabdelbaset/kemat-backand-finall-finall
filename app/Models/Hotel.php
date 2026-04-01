<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'location', 'address', 'rating', 
        'reviews_count', 'price_starts_from', 'image', 'gallery', 'ar_url'
    ];

    protected $casts = [
        'gallery' => 'array',
        'price_starts_from' => 'decimal:2',
        'rating' => 'decimal:2'
    ];

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }
}
