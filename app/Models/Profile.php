<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'user_id','gender','birth_date','height_cm','weight_kg',
        'waist_cm','neck_cm','job','exercise_preference',
        'target_program','target_weight','age','bmr','tdee','bmi','body_fat',
        'daily_calories','daily_macros','streak_count','onboarding_completed'
    ];

    protected $casts = [
        'daily_macros' => 'array',
        'birth_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
