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
        // Make sure the storage directory exists
        Storage::makeDirectory('public/movies');

        // Get all existing genres from the database
        $genreIds = Genre::pluck('id')->toArray();

        if (empty($genreIds)) {
            $this->command->warn('No genres found in database. Please run GenreSeeder first.');
            return;
        }

        $movies = [
            [
                'title' => 'Joker',
                'actor' => 'Joaquin Phoenix',
                'actress' => 'Zazie Beetz',
                'description' => 'A mentally troubled stand-up comedian embarks on a downward spiral that leads to the creation of an iconic villain.',
                'year' => 2019,
                'download_link' => 'https://example.com/joker-download',
                'long_time' => '2h 2m',
                'views' => 12000,
                'ratings' => 4.5,
                'ratings_count' => 350,
            ],
            [
                'title' => 'Inception',
                'actor' => 'Leonardo DiCaprio',
                'actress' => 'Ellen Page',
                'description' => 'A thief who steals corporate secrets through dream-sharing technology is given the inverse task of planting an idea.',
                'year' => 2010,
                'download_link' => 'https://example.com/inception-download',
                'long_time' => '2h 28m',
                'views' => 15000,
                'ratings' => 4.8,
                'ratings_count' => 500,
            ],
            [
                'title' => 'Avengers: Endgame',
                'actor' => 'Robert Downey Jr.',
                'actress' => 'Scarlett Johansson',
                'description' => 'After the devastating events of Infinity War, the Avengers assemble once more to reverse Thanos actions and restore balance.',
                'year' => 2019,
                'download_link' => 'https://example.com/avengers-download',
                'long_time' => '3h 1m',
                'views' => 20000,
                'ratings' => 4.7,
                'ratings_count' => 800,
            ],
        ];

        foreach ($movies as $i => $data) {
            $imageName = 'movie_' . ($i + 1) . '.jpg';
            $imagePath = 'movies/' . $imageName;
            if (file_exists(public_path('image/movie.png'))) {
                Storage::copy('public/image/movie.png', 'public/' . $imagePath);
            }
            Movie::create([
                'picture' => $imagePath,
                'title' => $data['title'],
                'actor' => $data['actor'],
                'actress' => $data['actress'],
                'genre_id' => $genreIds[array_rand($genreIds)],
                'description' => $data['description'],
                'year' => $data['year'],
                'download_link' => $data['download_link'],
                'long_time' => $data['long_time'],
                'views' => $data['views'],
                'ratings' => $data['ratings'],
                'ratings_count' => $data['ratings_count'],
            ]);
        }
    }
}
