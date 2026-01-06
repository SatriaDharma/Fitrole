<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Profile;
use App\Services\NutritionCalculator;
use App\Services\BadgeService;

class OnboardingController extends Controller
{
    public function step1() {
        return view('onboarding.step1');
    }

    public function storeStep1(Request $r) {
        $r->validate([
            'gender'=>'required',
            'birth_date'=>'required|date'
        ]);

        auth()->user()->profile()->updateOrCreate(
            ['user_id'=>auth()->id()],
            $r->only('gender','birth_date')
        );

        return redirect()->route('onboarding.step2');
    }

    public function step2() {
        return view('onboarding.step2');
    }

    public function storeStep2(Request $r) {
        $r->validate([
            'height_cm'=>'required',
            'weight_kg'=>'required',
            'waist_cm'=>'required',
            'neck_cm'=>'required'
        ]);

        auth()->user()->profile()->update($r->only('height_cm','weight_kg','waist_cm','neck_cm'));

        return redirect()->route('onboarding.step3');
    }

    public function step3() {
        return view('onboarding.step3');
    }

    public function storeStep3(Request $r) {
        auth()->user()->profile()->update($r->only(
            'activity_level','job','exercise_preference'
        ));

        return redirect()->route('onboarding.step4');
    }

    public function step4() {
        return view('onboarding.step4');
    }

    public function storeStep4(Request $r, BadgeService $badgeService)
    {
        $r->validate([
            'target_program' => 'required|string',
            'target_weight' => 'required|numeric'
        ]);

        $profile = auth()->user()->profile;

        $profile->update([
            'target_program' => $r->target_program,
            'target_weight' => $r->target_weight,
            'onboarding_completed' => true
        ]);

        $age = NutritionCalculator::age($profile->birth_date);

        $bmi = NutritionCalculator::bmi(
            $profile->weight_kg,
            $profile->height_cm
        );

        $bodyFat = NutritionCalculator::bodyFat(
            $profile->gender,
            $profile->height_cm,
            $profile->waist_cm,
            $profile->neck_cm
        );

        $bmr = NutritionCalculator::bmr(
            $profile->gender,
            $profile->weight_kg,
            $profile->height_cm,
            $age
        );

        $tdee = NutritionCalculator::tdee(
            $bmr,
            $profile->activity_level
        );

        $dailyCalories = NutritionCalculator::dailyCalories(
            $tdee,
            $profile->target_program
        );

        $macros = NutritionCalculator::macros($dailyCalories);

        $profile->update([
            'age' => $age,
            'bmi' => $bmi,
            'body_fat' => $bodyFat,
            'bmr' => $bmr,
            'tdee' => $tdee,
            'daily_calories' => $dailyCalories,
            'daily_macros' => $macros,
        ]);

        $badgeService->checkAll(Auth::user());

        return redirect()
            ->route('dashboard')
            ->with('success', 'Profil lengkap & nutrisi berhasil dihitung 🎉');
    }

}
