<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Genre;

class GenreController extends Controller
{
    // Display a listing of the genres.
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Build query with search functionality
        $query = Genre::query();

        if ($search) {
            $query->where('name', 'like', "%{$search}%");
        }

        // Get genres with pagination and manually count movies
        $genres = $query->latest()->paginate(10)->appends($request->query());

        // Add movie counts manually for each genre
        $genres->getCollection()->transform(function ($genre) {
            $genre->movies_count = $genre->movies()->count();
            return $genre;
        });

        // Get genre statistics
        $stats = [
            'total_genres' => Genre::count(),
            'genres_with_movies' => Genre::has('movies')->count(),
            'total_movies' => \App\Models\Movie::count(),
            'average_movies_per_genre' => $this->calculateAverageMoviesPerGenre(),
        ];

        return view('admin.genres.index', compact('genres', 'search', 'stats'));
    }

    // Helper method to calculate average movies per genre
    private function calculateAverageMoviesPerGenre()
    {
        $genres = Genre::all();
        if ($genres->count() === 0) {
            return 0;
        }

        $totalMovies = 0;
        foreach ($genres as $genre) {
            $totalMovies += $genre->movies()->count();
        }

        return round($totalMovies / $genres->count(), 1);
    }

    // Show the form for creating a new genre.
    public function create()
    {
        return view('admin.genres.create');
    }

    // Store a newly created genre in storage.
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255|unique:genres,name',
            ]);

            Genre::create([
                'name' => $validated['name'],
            ]);

            return redirect()->route('genres.index')
                ->with('success', 'Genre created successfully!');
        } catch (\Exception $e) {
            return redirect()->back()
                           ->withInput()
                           ->with('error', 'Failed to create genre. Please try again.');
        }
    }

    // Display the specified genre.
    public function show(Genre $genre)
    {
        return view('admin.genres.show', compact('genre'));
    }

    // Show the form for editing the specified genre.
    public function edit(Genre $genre)
    {
        return view('admin.genres.edit', compact('genre'));
    }

    // Update the specified genre in storage.
    public function update(Request $request, Genre $genre)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255|unique:genres,name,' . $genre->id,
            ]);

            $genre->update([
                'name' => $validated['name'],
            ]);

            return redirect()->route('genres.index')
                ->with('success', 'Genre updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()
                           ->withInput()
                           ->with('error', 'Failed to update genre. Please try again.');
        }
    }

    // Remove the specified genre from storage.
    public function destroy(Genre $genre)
    {
        try {
            $genreName = $genre->name;

            // Check if genre has movies
            if ($genre->movies()->count() > 0) {
                return redirect()->route('genres.index')
                    ->with('warning', "Cannot delete genre '{$genreName}' because it has movies assigned to it.");
            }

            $genre->delete();

            return redirect()->route('genres.index')
                ->with('success', "Genre '{$genreName}' deleted successfully!");
        } catch (\Exception $e) {
            return redirect()->route('genres.index')
                           ->with('error', 'Failed to delete genre. Please try again.');
        }
    }
}
