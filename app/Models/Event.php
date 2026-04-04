<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'location', 'venue', 'date',
        'time', 'price', 'category', 'image', 'gallery', 'rating'
    ];

    protected $casts = [
        'gallery' => 'array',
        'date' => 'date',
        'rating' => 'float',
    ];
}
