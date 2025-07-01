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
        $movie = Movie::with('genre')->findOrFail($id);

        // Increment view count
        $movie->increment('views');

        return view('frontend.movie_details_page', compact('movie'));
    }

// Handle rating submission
    public function rate(Request $request, $id)
    {
        $movie = Movie::findOrFail($id);

        // Validate the rating input)
        {
            $request->validate([
                'rating' => 'required|numeric|min:0|max:10',
            ]);

            // Update average rating (simple approach)
            $totalRating = ($movie->ratings * $movie->ratings_count) + $request->rating;
            $movie->ratings_count += 1;
            $movie->ratings = $totalRating / $movie->ratings_count;
            $movie->save();

            return redirect()->route('moviePage.show', $movie->id)->with('success', 'Thanks for rating!');
        }
    }
    public function search(Request $request)
    {
        // Use the same logic as index method for consistency
        return $this->index($request);
    }
}
