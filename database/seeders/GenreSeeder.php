<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // List of potential genres (more than 10 to ensure variety)
        $genreOptions = [
            'Action', 'Adventure', 'Animation', 'Biography', 'Comedy',
            'Crime', 'Documentary', 'Drama', 'Family', 'Fantasy',
            'History', 'Horror', 'Musical', 'Mystery', 'Romance',
            'Sci-Fi', 'Sport', 'Thriller', 'War', 'Western'
        ];

        // Shuffle and take 10 random genres
        shuffle($genreOptions);
        $selectedGenres = array_slice($genreOptions, 0, 10);

        // Create the genres
        foreach ($selectedGenres as $genreName) {
            Genre::firstOrCreate(['name' => $genreName]);
        }
    }
}
