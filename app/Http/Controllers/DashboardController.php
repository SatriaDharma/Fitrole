<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Profile;
use App\Models\ProgressLog;
use App\Services\NutritionCalculator;
use App\Services\BadgeService;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(BadgeService $badgeService)
    {
        $user = Auth::user();
        $profile = $user->profile;
        $progress = $user->progressDailies()->orderBy('date')->get();

        $dbEntry = $user->progressDailies()
                    ->whereDate('date', now())
                    ->first();

        $isFirstDay = $user->created_at->isToday();

        $todayEntry = $dbEntry ?: $isFirstDay;

        $weights = $user->progressDailies()
            ->orderBy('date', 'asc') 
            ->get()
            ->map(function ($item) {
                return [
                    'date' => Carbon::parse($item->date)->format('d M'),
                    'weight_kg' => $item->weight_kg,
                ];
            });

        $streak = $user->getWeightStreak();

        $initialWeight = $progress->first()?->weight_kg ?? $profile->weight_kg;
        $currentWeight = $progress->last()?->weight_kg ?? $profile->weight_kg;
        $targetWeight = $profile->target_weight;

        $weightDiff = $initialWeight - $targetWeight;
        $doneDiff   = $initialWeight - $currentWeight;

        $progressPercent = $weightDiff != 0
            ? round(min(max(($doneDiff / $weightDiff) * 100, 0), 100))
            : 0;

        $latestBmi = $currentWeight && $profile->height_cm
            ? NutritionCalculator::bmi($currentWeight, $profile->height_cm)
            : $profile->bmi;

        $latestBodyFat = $currentWeight && $profile->waist_cm && $profile->neck_cm
            ? NutritionCalculator::bodyFat($profile->gender, $profile->height_cm, $profile->waist_cm, $profile->neck_cm)
            : $profile->body_fat;

        $age = NutritionCalculator::age($profile->birth_date);
        $bmr = NutritionCalculator::bmr($profile->gender, $currentWeight, $profile->height_cm, $age);
        $tdee = NutritionCalculator::tdee($bmr, $profile->activity_level);
        $dailyCalories = NutritionCalculator::dailyCalories($tdee, $profile->target_program);
        $dailyMacros = NutritionCalculator::macros($dailyCalories);

        $badgeService->checkAll(Auth::user());

        return view('dashboard.index', [
            'user' => $user,
            'profile' => $profile,
            'progress' => $progress,
            'weights' => $weights,
            'todayEntry' => $todayEntry,
            'streak' => $streak,
            'progressPercent' => $progressPercent,
            'currentWeight' => $currentWeight,
            'latestBmi' => $latestBmi,
            'latestBodyFat' => $latestBodyFat,
            'dailyCalories' => $dailyCalories,
            'dailyMacros' => $dailyMacros,
        ]);
    }

    public function storeDaily(Request $request, BadgeService $badgeService)
    {
        $user = auth()->user();
        $profile = $user->profile;
        $today = now()->format('Y-m-d');
        $isEndOfMonth = now()->isLastOfMonth();

        $existingEntry = ProgressLog::where('user_id', $user->id)
                                    ->where('date', $today)
                                    ->first();
        if ($existingEntry) {
            return back()->with('error', 'Anda sudah memperbarui berat badan hari ini!');
        }

        $rules = [
            'weight_kg' => 'required|numeric',
        ];

        if ($isEndOfMonth) {
            $rules['waist_cm'] = 'required|integer';
            $rules['neck_cm'] = 'required|integer';
        }

        $request->validate($rules);

        $age = NutritionCalculator::age($profile->birth_date);
        $waist = $isEndOfMonth ? $request->waist_cm : $profile->waist_cm;
        $neck = $isEndOfMonth ? $request->neck_cm : $profile->neck_cm;

        $bmi = NutritionCalculator::bmi($request->weight_kg, $profile->height_cm);
        $bodyFat = NutritionCalculator::bodyFat($profile->gender, $profile->height_cm, $waist, $neck);
        $bmr = NutritionCalculator::bmr($profile->gender, $request->weight_kg, $profile->height_cm, $age);
        $tdee = NutritionCalculator::tdee($bmr, $profile->activity_level);
        $dailyCalories = NutritionCalculator::dailyCalories($tdee, $profile->target_program);
        $macros = NutritionCalculator::macros($dailyCalories);

        $profile->update([
            'waist_cm' => $waist,
            'neck_cm' => $neck,
            'bmi' => $bmi,
            'body_fat' => $bodyFat,
            'daily_calories' => $dailyCalories,
            'daily_macros' => $macros,
        ]);

        ProgressLog::create([
            'user_id' => $user->id,
            'date' => $today,
            'weight_kg' => $request->weight_kg,
            'bmi' => $bmi,
            'body_fat' => $bodyFat,
            'daily_calories' => $dailyCalories,
            'daily_macros' => $macros,
            'waist_cm' => $waist,
            'neck_cm' => $neck,
        ]);

        $badgeService->checkAll(Auth::user());

        return back()->with('success', 'Berat badan berhasil diperbarui!');
    }

}
