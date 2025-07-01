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
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('picture')->nullable();
            $table->string('actor');
            $table->string('actress');
            $table->string('long_time'); // duration
            $table->string('download_link');
            $table->foreignId('genre_id')->constrained()->onDelete('cascade');
            $table->year('year');
            $table->integer('views')->default(0);
            $table->decimal('average_rating', 3, 1)->default(0);
            $table->integer('total_ratings')->default(0);
            $table->timestamps();

            // Add indexes for better performance
            $table->index(['genre_id', 'year']);
            $table->index(['average_rating', 'total_ratings']);
            $table->index('views');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};
