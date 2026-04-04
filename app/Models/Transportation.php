<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transportation extends Model
{
    use HasFactory;

    protected $fillable = [
        'type', 'route', 'company', 'class', 'price',
        'duration', 'departure_time', 'image', 'rating'
    ];

    protected $casts = [
        'price' => 'float',
        'rating' => 'float',
    ];
}
