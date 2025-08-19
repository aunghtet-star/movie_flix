<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

// Add a YouTube trailer URL to test
$movie = App\Models\Movie::find(1); // Get first movie
if ($movie) {
    $movie->trailer_url = 'https://www.youtube.com/watch?v=dQw4w9WgXcQ'; // Sample YouTube URL
    $movie->save();
    echo "Added YouTube trailer URL to movie: {$movie->title} (ID: {$movie->id})" . PHP_EOL;
}

// Add a different type for another movie
$movie2 = App\Models\Movie::find(2);
if ($movie2) {
    $movie2->trailer_url = 'https://youtu.be/dQw4w9WgXcQ'; // Short YouTube URL format
    $movie2->save();
    echo "Added short YouTube URL to movie: {$movie2->title} (ID: {$movie2->id})" . PHP_EOL;
}

echo "Movies with YouTube trailers: " . App\Models\Movie::where('trailer_url', 'LIKE', '%youtube%')->orWhere('trailer_url', 'LIKE', '%youtu.be%')->count() . PHP_EOL;
