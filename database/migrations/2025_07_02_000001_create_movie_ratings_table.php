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
        Schema::create('movie_ratings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('movie_id')->constrained()->onDelete('cascade');
            $table->tinyInteger('rating')->unsigned(); // 1-5 stars
            $table->text('review')->nullable();
            $table->timestamps();

            // Ensure one rating per user per movie
            $table->unique(['user_id', 'movie_id']);

            // Add indexes for better performance
            $table->index(['movie_id', 'rating']);
            $table->index(['movie_id', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movie_ratings');
    }
};
