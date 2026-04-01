<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TravelPackage extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'image', 'alt', 'tag', 'date', 'author', 
        'price', 'duration', 'activities', 'highlights', 
        'hotel', 'museum', 'excluded'
    ];

    protected $casts = [
        'activities' => 'array',
        'highlights' => 'array',
        'hotel' => 'array',
        'museum' => 'array',
        'excluded' => 'array',
    ];
}
