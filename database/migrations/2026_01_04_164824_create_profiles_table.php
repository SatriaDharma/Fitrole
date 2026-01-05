<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            $table->string('gender')->nullable();
            $table->date('birth_date')->nullable();

            $table->integer('height_cm')->nullable();
            $table->decimal('weight_kg', 5, 1)->nullable();

            $table->integer('waist_cm')->nullable();
            $table->integer('neck_cm')->nullable();

            $table->string('activity_level')->nullable();
            $table->string('job')->nullable();
            $table->string('exercise_preference')->nullable();

            $table->string('target_program')->nullable();
            $table->decimal('target_weight', 5, 1)->nullable();

            $table->integer('age')->nullable();
            $table->decimal('bmi', 5, 2)->nullable();
            $table->decimal('body_fat', 5, 2)->nullable();
            $table->integer('bmr')->nullable();
            $table->integer('tdee')->nullable();
            $table->integer('daily_calories')->nullable();
            $table->json('daily_macros')->nullable();

            $table->integer('streak_count')->default(0);

            $table->boolean('onboarding_completed')->default(false);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
