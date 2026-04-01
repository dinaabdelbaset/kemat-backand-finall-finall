<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'type',
        'location',
        'duration',
        'price',
        'rating',
        'tag',
        'label',
        'start_time',
        'includes',
        'image',
    ];
}
