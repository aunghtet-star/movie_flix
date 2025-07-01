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
            $table->string('picture'); // URL or path
            $table->string('title');
            $table->string('actor');
            $table->string('actress');
            $table->unsignedBigInteger('genre_id');
            $table->text('description')->nullable();
            $table->year('year');
            $table->string('download_link')->nullable();
            $table->string('long_time')->nullable();
            $table->unsignedBigInteger('views')->default(0);
            $table->decimal('ratings', 3, 1)->default(0.0);
            $table->unsignedBigInteger('ratings_count')->default(0);
            $table->timestamps();
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
