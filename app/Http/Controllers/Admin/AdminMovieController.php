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
    public function index()
    {
        $movies = Movie::all();
        return view('admin.movies.index', compact('movies'));
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
        // Debugging line to check the request data
        $validated = $request->validate([
            'picture' => 'required',
            'actor' => 'required',
            'actress' => 'required',
            'long_time' => 'required',
            'download_link' => 'required',
            'title' => 'required|string|max:255',
            'genre_id' => 'required',
            'description' => 'nullable|string',
            'year' => 'required|digits:4|integer',
        ]);

        // Store the uploaded picture in 'public/movies', save relative path
        if ($request->hasFile('picture')) {
            $path = $request->file('picture')->store('movies', 'public');
            $validated['picture'] = $path; // This saves as "movies/filename.jpg"
        }


        Movie::create($validated);

        return redirect()->route('admin_movies.index');
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
