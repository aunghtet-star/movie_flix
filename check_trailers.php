<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "Total movies: " . App\Models\Movie::count() . PHP_EOL;
echo "Movies with trailers: " . App\Models\Movie::whereNotNull('trailer_url')->count() . PHP_EOL;

echo "Sample movies:" . PHP_EOL;
App\Models\Movie::take(5)->get(['id', 'title', 'trailer_url'])->each(function ($movie) {
    echo "ID: {$movie->id}, Title: {$movie->title}, Trailer: " . ($movie->trailer_url ?: 'NULL') . PHP_EOL;
});
