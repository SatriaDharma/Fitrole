<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgressLog extends Model
{
    protected $fillable = [
        'user_id',
        'date',
        'weight_kg',
        'bmi',
        'body_fat',
        'daily_calories',
        'daily_macros',
        'waist_cm',
        'neck_cm'
    ];

    protected $casts = [
        'daily_macros' => 'array',
    ];
}
