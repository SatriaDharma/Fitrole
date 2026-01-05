<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OnboardingController;
use App\Http\Controllers\AIController;
use App\Http\Controllers\MealScanController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {return view('welcome');})->name('landing');

Route::get('/generate-share', function () {
    return view('generate-share');
});

Route::middleware('auth')->group(function () {
    Route::get('/onboarding/1',[OnboardingController::class,'step1'])->name('onboarding.step1');
    Route::post('/onboarding/1',[OnboardingController::class,'storeStep1']);

    Route::get('/onboarding/2',[OnboardingController::class,'step2'])->name('onboarding.step2');
    Route::post('/onboarding/2',[OnboardingController::class,'storeStep2']);

    Route::get('/onboarding/3',[OnboardingController::class,'step3'])->name('onboarding.step3');
    Route::post('/onboarding/3',[OnboardingController::class,'storeStep3']);

    Route::get('/onboarding/4',[OnboardingController::class,'step4'])->name('onboarding.step4');
    Route::post('/onboarding/4',[OnboardingController::class,'storeStep4']);
});

Route::middleware(['auth','profile.completed'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/dashboard/daily', [DashboardController::class,'storeDaily'])->name('dashboard.daily.store');
    Route::get('/dashboard/ai', [AIController::class, 'index'])->name('dashboard.ai');
    Route::post('/ai-ask', [AIController::class, 'ask'])->name('dashboard.ai.ask');
    Route::get('/meal-scan', [MealScanController::class, 'index'])->name('dashboard.meal.scan');
    Route::post('/meal-scan/upload', [MealScanController::class, 'upload'])->name('dashboard.meal.upload');
});

require __DIR__.'/auth.php';
