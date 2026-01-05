<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Carbon\Carbon;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function profile()
    {
        return $this->hasOne(\App\Models\Profile::class);
    }

    public function progressDailies()
    {
        return $this->hasMany(\App\Models\ProgressLog::class);
    }

    public function getWeightStreak()
    {
        $today = Carbon::now()->startOfDay();

        $dates = $this->progressDailies()
            ->whereDate('date', '<=', $today)
            ->orderBy('date', 'desc')
            ->pluck('date')
            ->map(fn($date) => \Carbon\Carbon::parse($date)->toDateString())
            ->unique();

        if ($dates->isEmpty()) return 0;

        $streak = 0;
        $checkDate = $today->copy();

        if ($dates->first() !== $checkDate->toDateString()) {
            $checkDate->subDay();
            if ($dates->first() !== $checkDate->toDateString()) {
                return 0;
            }
        }

        foreach ($dates as $date) {
            if ($date === $checkDate->toDateString()) {
                $streak++;
                $checkDate->subDay();
            } else {
                break;
            }
        }

        return $streak;
    }

    public function badges(): BelongsToMany
    {
        return $this->belongsToMany(Badge::class, 'badge_user')
                    ->withPivot('achieved_at');
    }

    public function mealScans()
    {
        return $this->hasMany(MealScan::class);
    }

}
