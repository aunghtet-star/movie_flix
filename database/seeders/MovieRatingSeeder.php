<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MovieRating;
use App\Models\Movie;
use App\Models\User;

class MovieRatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get first user and first 3 movies
        $user = User::first();
        $movies = Movie::take(3)->get();

        if (!$user) {
            $this->command->warn('No users found. Please create users first.');
            return;
        }

        if ($movies->count() < 3) {
            $this->command->warn('Less than 3 movies found. Please run MovieSeeder first.');
            return;
        }

        // Create 3 movie ratings
        $ratings = [
            [
                'user_id' => $user->id,
                'movie_id' => $movies[0]->id, // First movie
                'rating' => 5,
                'review' => 'Absolutely amazing movie! One of the best I have ever watched. The acting was phenomenal and the story was captivating from start to finish.',
            ],
            [
                'user_id' => $user->id,
                'movie_id' => $movies[1]->id, // Second movie
                'rating' => 4,
                'review' => 'Really good movie with great visual effects and storyline. Would definitely recommend to friends and family.',
            ],
            [
                'user_id' => $user->id,
                'movie_id' => $movies[2]->id, // Third movie
                'rating' => 3,
                'review' => 'Decent movie but nothing special. It was entertaining but not memorable. Average plot and okay acting.',
            ],
        ];

        foreach ($ratings as $ratingData) {
            MovieRating::create($ratingData);
            $this->command->info("Created rating for movie ID: {$ratingData['movie_id']} with {$ratingData['rating']} stars");
        }

        $this->command->info('MovieRatingSeeder completed! Created 3 movie ratings.');
    }
}
