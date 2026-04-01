<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'hotel_id', 'room_type', 'capacity_adults', 'capacity_children',
        'price_per_night', 'available_count', 'features', 'image', 'ar_url'
    ];

    protected $casts = [
        'features' => 'array',
        'price_per_night' => 'decimal:2'
    ];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }
}
