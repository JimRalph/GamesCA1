<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'rating',
        'comment',
        'car_id',
    ];

    public function game()
    {
        return $this->belongsTo(Games::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
