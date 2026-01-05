<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Models\Badge;
use App\Models\User;
use App\Services\NutritionCalculator;
use Carbon\Carbon;

class BadgeService {
    
    public function checkAll(User $user, $context = 'weight', $additionalData = []) {
        $this->checkDedicationBadges($user);
        $this->checkResultBadges($user);
        
        if ($context === 'meal_scan') {
            $this->checkMealBadges($user, $additionalData);
        }

        $this->checkEasterEggBadges($user);
    }

    private function checkDedicationBadges(User $user) {
        $streak = $user->getWeightStreak();
        
        $totalLogs = $user->progressDailies()->count();

        if ($totalLogs >= 1) {
            $this->giveBadge($user, '1ST_TIME');
        }

        if ($streak >= 7) {
            $this->giveBadge($user, '7_STREAK');
        }

        if ($streak >= 90) {
            $this->giveBadge($user, '3_MONTHS');
        }

        if ($this->hasCompletedWeekend($user)) {
            $this->giveBadge($user, 'WEEKEND');
        }
    }

    private function hasCompletedWeekend(User $user) 
    {
        $dates = $user->progressDailies()->pluck('date');

        foreach ($dates as $dateString) {
            $date = Carbon::parse($dateString);

            if ($date->isSunday()) {
                $hasSaturday = $dates->contains(function ($val) use ($date) {
                    return Carbon::parse($val)->toDateString() === $date->copy()->subDay()->toDateString();
                });

                if ($hasSaturday) {
                    return true;
                }
            }
        }

        return false;
    }

    private function checkResultBadges(User $user) {
        $initialWeight = $user->profile->weight_kg ?? 0;
        
        $latestLog = $user->progressDailies()->orderBy('date', 'desc')->first();

        if ($initialWeight <= 0 || !$latestLog) return;

        $diff = $initialWeight - $latestLog->weight_kg;

        if ($diff >= 1) {
            $this->giveBadge($user, '1ST_STEP');
        }

        if ($diff >= 5) {
            $this->giveBadge($user, 'HIGH_FIVE');
        }

        if ($this->hasExperiencedRapidLoss($user)) {
                $this->giveBadge($user, 'ON_FIRE');
        }

        $currentBmi = $latestLog->weight_kg && $user->profile->height_cm
            ? NutritionCalculator::bmi($latestLog->weight_kg, $user->profile->height_cm)
            : 0;

        if ($currentBmi >= 18.5 && $currentBmi <= 23) {
            $this->giveBadge($user, 'IDEAL_SOUL');
        }

        $targetWeight = $user->profile->target_weight ?? 0;
        if ($targetWeight > 0 && $latestLog->weight_kg <= $targetWeight) {
            $this->giveBadge($user, 'FINISH_IT');
        }
    }

    private function hasExperiencedRapidLoss(User $user)
    {
        $logs = $user->progressDailies()->orderBy('date', 'asc')->get();

        foreach ($logs as $index => $startLog) {
            $startDate = Carbon::parse($startLog->date);
            
            $compareLog = $logs->whereBetween('date', [
                $startDate->toDateString(), 
                $startDate->copy()->addDays(7)->toDateString()
            ])->last();

            if ($compareLog && $compareLog->id !== $startLog->id) {
                $diff = $startLog->weight_kg - $compareLog->weight_kg;
                
                if ($diff >= 3) {
                    return true;
                }
            }
        }

        return false;
    }

    private function checkMealBadges(User $user, $data) {
        $this->giveBadge($user, 'MEAL_SCAN');

        if (isset($data['protein']) && $data['protein'] > 35) {
            $this->giveBadge($user, 'PROTEINMEN');
        }

        if (isset($data['is_vegetable']) && $data['is_vegetable']) {
            $this->giveBadge($user, 'VEGGIEMEN');
        }

    }

    private function checkEasterEggBadges(User $user) {
        $hasNightInput = $user->progressDailies()
            ->whereRaw('HOUR(created_at) >= 0 AND HOUR(created_at) < 4')
            ->exists();

        if ($hasNightInput) {
            $this->giveBadge($user, 'NIGHT_OWL');
        }

        if ($this->hasUpdatedOnHoliday($user)) {
            $this->giveBadge($user, 'HEALTHDAY');
        }
    }

    private function hasUpdatedOnHoliday(User $user)
    {
        $holidays = ['01-01', '08-17', '12-25']; 
        
        $dates = $user->progressDailies()->pluck('date');

        foreach ($dates as $dateString) {
            $formattedDate = Carbon::parse($dateString)->format('m-d');
            
            if (in_array($formattedDate, $holidays)) {
                return true;
            }
        }

        return false;
    }

    private function giveBadge(User $user, $code) {
        $badge = Badge::where('code', $code)->first();
        if ($badge && !$user->badges->contains($badge->id)) {
            $user->badges()->attach($badge->id, ['achieved_at' => now()]);
            
            session()->push('new_badges', [
                'name' => $badge->name,
                'image' => $badge->image
            ]);
        }
    }
}