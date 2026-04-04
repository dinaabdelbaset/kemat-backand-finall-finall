<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Safari extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'location', 'duration', 'price',
        'image', 'gallery', 'rating', 'includes', 'difficulty'
    ];

    protected $casts = [
        'gallery' => 'array',
        'includes' => 'array',
        'rating' => 'float',
    ];
}
