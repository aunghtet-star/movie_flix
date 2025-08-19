<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

// Find the Joker movie and add a sample trailer URL
$movie = App\Models\Movie::where('title', 'Joker')->first();
if ($movie) {
    $movie->trailer_url = 'https://commondatastorage.googleapis.com/gtv-videos-bucket/sample/BigBuckBunny.mp4';
    $movie->save();
    echo "Added trailer URL to Joker movie (ID: {$movie->id})" . PHP_EOL;
} else {
    // If Joker movie not found, update the first movie
    $movie = App\Models\Movie::first();
    if ($movie) {
        $movie->trailer_url = 'https://commondatastorage.googleapis.com/gtv-videos-bucket/sample/BigBuckBunny.mp4';
        $movie->save();
        echo "Added trailer URL to movie: {$movie->title} (ID: {$movie->id})" . PHP_EOL;
    }
}

echo "Movies with trailers now: " . App\Models\Movie::whereNotNull('trailer_url')->count() . PHP_EOL;
