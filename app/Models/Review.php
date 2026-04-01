<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'item_type',
        'item_id',
        'rating',
        'comment',
    ];

    protected $with = ['user']; // Always load the user who left the review

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
