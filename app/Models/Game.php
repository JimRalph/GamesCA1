<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    //use HasFactory;

    // Define the fillable properties
    protected $fillable = [
        'title',
        'description',
        'release_date',
        'age_restriction',
        'image'
        //'created_at',
        //'updated_at'
    ];

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}

