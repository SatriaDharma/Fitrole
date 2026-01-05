<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('badges', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('category');
            $table->text('description');
            $table->string('icon_path'); 
            $table->string('code')->unique(); 
            $table->timestamps();
        });

        Schema::create('badge_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('badge_id')->constrained()->onDelete('cascade');
            $table->timestamp('achieved_at')->useCurrent();
        });
    }

    public function down() {
        Schema::dropIfExists('user_badges');
        Schema::dropIfExists('badges');
    }
};
