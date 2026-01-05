<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('progress_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->date('date');
            $table->float('weight_kg');
            $table->float('bmi')->nullable();
            $table->float('body_fat')->nullable();
            $table->float('daily_calories')->nullable();
            $table->json('daily_macros')->nullable();
            $table->integer('waist_cm')->nullable();
            $table->integer('neck_cm')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('progress_logs');
    }
};

