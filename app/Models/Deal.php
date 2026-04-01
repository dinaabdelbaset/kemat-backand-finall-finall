<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deal extends Model
{
    use HasFactory;

    protected $fillable = [
        'category', 'icon', 'title', 'locations', 'image',
        'price', 'rating', 'color', 'link', 'items'
    ];

    protected $casts = [
        'items' => 'array',
        'rating' => 'float',
    ];
}
