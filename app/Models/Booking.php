<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'item_type',
        'item_id',
        'status',
        'date_info',
        'total_price',
        'guests',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
