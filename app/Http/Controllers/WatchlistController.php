<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Watchlist;
use App\Models\Movie;
use Illuminate\Support\Facades\Auth;

class WatchlistController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display the user's watchlist
     */
    public function index()
    {
        $watchlistMovies = Auth::user()->watchlistMovies()->with('genre')->paginate(12);

        return view('frontend.watchlist', compact('watchlistMovies'));
    }

    /**
     * Add a movie to watchlist
     */
    public function store(Request $request)
    {
        $request->validate([
            'movie_id' => 'required|exists:movies,id'
        ]);

        $user = Auth::user();
        $movieId = $request->movie_id;

        // Check if already in watchlist
        if ($user->hasInWatchlist($movieId)) {
            return response()->json([
                'success' => false,
                'message' => 'Movie is already in your watchlist!'
            ]);
        }

        // Add to watchlist
        Watchlist::create([
            'user_id' => $user->id,
            'movie_id' => $movieId
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Movie added to watchlist successfully!'
        ]);
    }

    /**
     * Remove a movie from watchlist
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'movie_id' => 'required|exists:movies,id'
        ]);

        $user = Auth::user();
        $movieId = $request->movie_id;

        $watchlistItem = Watchlist::where('user_id', $user->id)
            ->where('movie_id', $movieId)
            ->first();

        if ($watchlistItem) {
            $watchlistItem->delete();

            return response()->json([
                'success' => true,
                'message' => 'Movie removed from watchlist successfully!'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Movie not found in watchlist!'
        ]);
    }
}
