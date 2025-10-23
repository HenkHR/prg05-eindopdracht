<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('check_ins', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->decimal('weight', 5, 2);
            $table->tinyInteger('sleep_quality');
            $table->tinyInteger('training_quality');
            $table->tinyInteger('soreness');
            $table->tinyInteger('food_quality');
            $table->text('comment')->nullable(); 
            $table->text('coach_comment')->nullable();
            $table->timestamps();
            $table->string('image_path')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('check_ins');
    }
};
