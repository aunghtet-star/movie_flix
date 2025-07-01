<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Http\Request;

class AdminMovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Build query with search functionality
        $query = Movie::with('genre');

        if ($search) {
            $query->where('title', 'like', "%{$search}%")
                  ->orWhere('actor', 'like', "%{$search}%")
                  ->orWhere('actress', 'like', "%{$search}%")
                  ->orWhereHas('genre', function($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%");
                  });
        }

        // Get movies with pagination
        $movies = $query->latest()->paginate(10)->appends($request->query());

        // Get movie statistics
        $stats = [
            'total_movies' => Movie::count(),
            'total_views' => Movie::sum('views'),
            'movies_this_month' => Movie::whereMonth('created_at', now()->month)
                                       ->whereYear('created_at', now()->year)
                                       ->count(),
            'average_rating' => Movie::whereNotNull('ratings')->avg('ratings') ?? 0,
            'total_genres' => Genre::count(),
            'top_genre' => $this->getTopGenre(),
        ];

        return view('admin.movies.index', compact('movies', 'search', 'stats'));
    }

    // Helper method to get the genre with most movies
    private function getTopGenre()
    {
        $topGenre = Genre::withCount('movies')
                        ->orderBy('movies_count', 'desc')
                        ->first();

        return $topGenre ? $topGenre->name : 'None';
    }

    // Show form to create a movie
    public function create()
    {
        $genres = Genre::all();
        return view('admin.movies.create', compact('genres'));
    }

    // Store a new movie
    public function store(Request $request)
    {
        try {
            // Enhanced validation with proper rules
            $validated = $request->validate([
                'picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120', // 5MB max
                'title' => 'required|string|max:255|unique:movies,title',
                'actor' => 'required|string|max:255',
                'actress' => 'required|string|max:255',
                'long_time' => 'required|string|max:50',
                'download_link' => 'required|url|max:500',
                'genre_id' => 'required|exists:genres,id',
                'description' => 'nullable|string|max:1000',
                'year' => 'required|digits:4|integer|min:1900|max:' . date('Y'),
            ]);

            // Store the uploaded picture in 'public/movies', save relative path
            if ($request->hasFile('picture')) {
                $path = $request->file('picture')->store('movies', 'public');
                $validated['picture'] = $path; // This saves as "movies/filename.jpg"
            }

            // Initialize default values
            $validated['views'] = 0;
            $validated['ratings'] = 0;
            $validated['ratings_count'] = 0;

            Movie::create($validated);

            return redirect()->route('admin_movies.index')
                           ->with('success', 'Movie created successfully!');

        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                           ->withErrors($e->errors())
                           ->withInput()
                           ->with('error', 'Please fix the validation errors below.');
        } catch (\Exception $e) {
            return redirect()->back()
                           ->withInput()
                           ->with('error', 'An error occurred while creating the movie. Please try again.');
        }
    }

    // Show a single movie (and increment views)
    public function show(Request $request, $id)
    {
        $movie = Movie::findOrFail($id);

        return view('admin.movies.show', compact('movie'));
    }

    // Show form to edit a movie
    public function edit(Request $request, $id)
    {
        $movie = Movie::findOrFail($id);
        $genres = Genre::all();
        return view('admin.movies.edit', compact('movie', 'genres'));
    }

    // Update a movie
    public function update(Request $request, $id)
    {

        $movie = Movie::findOrFail($id);
        $validated = $request->validate([
            'picture' => 'nullable|image',
            'actor' => 'required',
            'actress' => 'required',
            'long_time' => 'required',
            'download_link' => 'required',
            'title' => 'required|string|max:255',
            'genre_id' => 'required',
            'description' => 'nullable|string',
            'year' => 'required|digits:4|integer',
        ]);

        // Handle picture upload if present
        if ($request->hasFile('picture')) {
            $path = $request->file('picture')->store('movies', 'public');
            $validated['picture'] = $path;
        } else {
            // Keep the old picture if not uploading a new one
            $validated['picture'] = $movie->picture;
        }


        $movie->update($validated);

        return redirect()->route('admin_movies.index');
    }

    // Delete a movie
    public function destroy($id){
        $movie = Movie::findOrFail($id);
        // Optionally, you can also delete the picture file from storage
        if ($movie->picture) {
            \Storage::disk('public')->delete($movie->picture);
        }
        $movie->delete();

        return redirect()->route('admin_movies.index')->with('success', 'Movie deleted successfully.');

    }
}
