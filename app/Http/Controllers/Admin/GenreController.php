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

        $genreCount = Genre::count(); // Get the total count of genres
        $search = $request->input('search');


       //  If a search term is provided, filter the genres accordingly.
        if ($search) {
            $genres = Genre::when($search, function($query, $search) {
            return $query->where('name', 'like', "%{$search}%");
        })
            ->get();
        } else {
            $genres = Genre::all();
        }

       // dd($genres); // Debugging line to check the genres retrieved

        return view('admin.genres.index', compact('genres', 'search', 'genreCount'));
    }

    // Show the form for creating a new genre.
    public function create()
    {
        return view('admin.genres.create');
    }

    // Store a newly created genre in storage.
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:genres,name',
        ]);

        Genre::create([
            'name' => $request->name,
        ]);

        return redirect()->route('genres.index')
            ->with('success', 'Genre created successfully.');
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
        $request->validate([
            'name' => 'required|string|max:255|unique:genres,name,' . $genre->id,
        ]);

        $genre->update([
            'name' => $request->name,
        ]);

        return redirect()->route('genres.index')
            ->with('success', 'Genre updated successfully.');
    }

    // Remove the specified genre from storage.
    public function destroy(Genre $genre)
    {
        $genre->delete();

        return redirect()->route('genres.index')
            ->with('success', 'Genre deleted successfully.');
    }
}
