<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MealScan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'image_path',
        'food_name',
        'calories',
        'protein',
        'carbs',
        'fat',
        'message',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}