<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\Command\Seed;
use Illuminate\Database\Seeder;
use App\Models\Movie;
use App\Models\Genre;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Storage;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Make sure the storage directory exists
        Storage::makeDirectory('public/movies');

        // Get all existing genres from the database
        $genreIds = Genre::pluck('id')->toArray();

        // If no genres exist, create a fallback message
        if (empty($genreIds)) {
            $this->command->warn('No genres found in database. Please run GenreSeeder first.');
            return;
        }

        for ($i = 1; $i <= 20; $i++) {
            // Use placeholder images
            $imageName = 'movie_' . $i . '.jpg';
            $imagePath = 'movies/' . $imageName;

            // Copy a default image or use a placeholder
            if (file_exists(public_path('image/movie.png'))) {
                // Copy the default image to storage with the movie name
                Storage::copy('public/image/movie.png', 'public/' . $imagePath);
            }

            // Generate movie data
            Movie::create([
                'picture' => $imagePath,
                'title' => $faker->sentence(3),
                'actor' => $faker->name('male'),
                'actress' => $faker->name('female'),
                'genre_id' => $faker->randomElement($genreIds),
                'description' => $faker->paragraph(3),
                'year' => $faker->year(),
                'download_link' => $faker->url,
                'long_time' => $faker->randomElement(['1h 30m', '2h 15m', '1h 45m', '2h 30m']),
                'views' => $faker->numberBetween(100, 10000),
                'ratings' => $faker->randomFloat(1, 1, 5),
                'ratings_count' => $faker->numberBetween(10, 1000),
            ]);
        }
    }
}
