<?php

namespace App\Services;

use Carbon\Carbon;

class NutritionCalculator
{
    public static function age(string $birthDate): int
    {
        return Carbon::parse($birthDate)->age;
    }

    public static function bmi(float $weightKg, int $heightCm): float
    {
        return round($weightKg / pow($heightCm / 100, 2), 2);
    }

    public static function bodyFat(
        string $gender,
        int $heightCm,
        int $waistCm,
        int $neckCm
    ): float 
    {
        if ($gender === 'male') {
            $bf = 86.010 * log10($waistCm - $neckCm)
                - 70.041 * log10($heightCm)
                + 36.76;
        } else {
            $bf = 163.205 * log10($waistCm)
                - 97.684 * log10($heightCm)
                - 78.387;
        }

        return round($bf, 2);
    }

    public static function bmr(
        string $gender,
        float $weightKg,
        int $heightCm,
        int $age
    ): int 
    {
        $bmr = (10 * $weightKg) + (6.25 * $heightCm) - (5 * $age);

        $bmr += $gender === 'male' ? 5 : -161;

        return (int) round($bmr);
    }

    public static function tdee(int $bmr, string $activityLevel): int
    {
        $multipliers = [
            'sedentary' => 1.2,
            'light' => 1.375,
            'moderate' => 1.55,
            'active' => 1.725,
            'very_active' => 1.9,
        ];

        $multiplier = $multipliers[$activityLevel] ?? 1.375;

        return (int) round($bmr * $multiplier);
    }

    public static function dailyCalories(int $tdee, string $program): int
    {
        return match ($program) {
            'Fat Loss' => $tdee - 500,
            'Muscle Gain' => $tdee + 300,
            default => $tdee,
        };
    }

    public static function macros(int $dailyCalories): array
    {
        return [
            'protein' => round(($dailyCalories * 0.30) / 4),
            'fat' => round(($dailyCalories * 0.25) / 9),
            'carbs' => round(($dailyCalories * 0.45) / 4),
        ];
    }
}
