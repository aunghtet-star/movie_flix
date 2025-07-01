<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{

    // index method to list all movies
    public function index(Request $request)
    {
        $query = Movie::with('genre');

        // Get all genres for the dropdown and tags
        $allGenres = \App\Models\Genre::all();

        // Filter by genre if provided
        if ($request->has('genre') && $request->genre != '') {
            $genreSlug = $request->genre;

            // Convert URL-friendly slug back to genre name
            // Handle both hardcoded mappings and dynamic genre names
            $genreMap = [
                'action' => 'Action',
                'comedy' => 'Comedy',
                'drama' => 'Drama',
                'horror' => 'Horror',
                'sci-fi' => 'Sci-Fi',
                'romance' => 'Romance'
            ];

            // Check if it's a predefined mapping first
            if (isset($genreMap[$genreSlug])) {
                $genreName = $genreMap[$genreSlug];
            } else {
                // Convert slug back to readable format for dynamic genres
                // Replace hyphens with spaces and capitalize each word
                $genreName = ucwords(str_replace('-', ' ', $genreSlug));
            }

            $query->whereHas('genre', function($q) use ($genreName) {
                $q->where('name', 'like', '%' . $genreName . '%');
            });
        }

        // Handle search query
        if ($request->has('query') && $request->input('query') != '') {
            $searchQuery = $request->input('query');
            $query->where(function ($q) use ($searchQuery) {
                $q->where('title', 'like', '%' . $searchQuery . '%')
                    ->orWhere('description', 'like', '%' . $searchQuery . '%')
                    ->orWhere('actor', 'like', '%' . $searchQuery . '%')
                    ->orWhere('actress', 'like', '%' . $searchQuery . '%')
                    ->orWhereHas('genre', function($subQ) use ($searchQuery) {
                        $subQ->where('name', 'like', '%' . $searchQuery . '%');
                    });
            });
        }

        $movies = $query->paginate(10)->appends($request->query());
        $selectedGenre = $request->genre ?? '';

        return view('moviePage', compact('movies', 'selectedGenre', 'allGenres'));
    }

    public function show($id)
    {
        $movie = Movie::with(['genre', 'ratings.user'])->findOrFail($id);

        // Increment view count
        $movie->increment('views');

        // Get user's rating if authenticated
        $userRating = auth()->check() ? $movie->userRating(auth()->id()) : null;

        return view('frontend.movie_details_page', compact('movie', 'userRating'));
    }

    /**
     * Rate a movie
     */
    public function rate(Request $request, $id)
    {
        try {
            $request->validate([
                'rating' => 'required|integer|min:1|max:5',
                'review' => 'nullable|string|max:1000',
            ]);

            $movie = Movie::findOrFail($id);
            $userId = auth()->id();

            // Check if user already rated this movie
            $existingRating = $movie->ratings()->where('user_id', $userId)->first();

            if ($existingRating) {
                // Update existing rating
                $existingRating->update([
                    'rating' => $request->rating,
                    'review' => $request->review,
                ]);
                $message = 'Your rating has been updated successfully!';
            } else {
                // Create new rating
                $movie->ratings()->create([
                    'user_id' => $userId,
                    'rating' => $request->rating,
                    'review' => $request->review,
                ]);
                $message = 'Thank you for rating this movie!';
            }

            // The average rating will be automatically updated via the model boot method

            return response()->json([
                'success' => true,
                'message' => $message,
                'average_rating' => $movie->fresh()->average_rating,
                'total_ratings' => $movie->fresh()->total_ratings,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to submit rating. Please try again.',
            ], 500);
        }
    }

    /**
     * Delete user's rating for a movie
     */
    public function deleteRating($id)
    {
        try {
            $movie = Movie::findOrFail($id);
            $userId = auth()->id();

            $rating = $movie->ratings()->where('user_id', $userId)->first();

            if (!$rating) {
                return response()->json([
                    'success' => false,
                    'message' => 'No rating found to delete.',
                ], 404);
            }

            $rating->delete();

            return response()->json([
                'success' => true,
                'message' => 'Your rating has been removed successfully!',
                'average_rating' => $movie->fresh()->average_rating,
                'total_ratings' => $movie->fresh()->total_ratings,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to remove rating. Please try again.',
            ], 500);
        }
    }

    /**
     * Get user's rating for a movie
     */
    public function getUserRating($id)
    {
        try {
            $movie = Movie::findOrFail($id);
            $userId = auth()->id();

            $rating = $movie->ratings()->where('user_id', $userId)->first();

            return response()->json([
                'rating' => $rating ? $rating->rating : 0,
                'review' => $rating ? $rating->review : null,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'rating' => 0,
                'review' => null,
            ]);
        }
    }

    public function search(Request $request)
    {
        // Use the same logic as index method for consistency
        return $this->index($request);
    }
}
