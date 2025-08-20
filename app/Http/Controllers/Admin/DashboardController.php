<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use App\Models\User;
use App\Models\Genre;
use App\Models\Admin;
use App\Models\MovieRating;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Get dashboard statistics
        $stats = [
            'total_movies' => Movie::count(),
            'total_users' => User::count(),
            'total_genres' => Genre::count(),
            'total_views' => Movie::sum('views'),
            'total_ratings' => MovieRating::count(),
            'average_rating' => MovieRating::avg('rating'),
        ];

        // Get recent movies (last 5)
        $recentMovies = Movie::with('genre')
            ->latest()
            ->take(5)
            ->get();

        // Get recent users (last 5)
        $recentUsers = User::latest()
            ->take(5)
            ->get();

        // Get top rated movies
        $topRatedMovies = Movie::with('genre')
            ->whereNotNull('average_rating')
            ->orderBy('average_rating', 'desc')
            ->take(5)
            ->get();

        // Get movies by genre for chart data
        $moviesByGenre = Genre::withCount('movies')
            ->having('movies_count', '>', 0)
            ->get();

        // Get monthly stats for the last 6 months
        $monthlyStats = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $monthlyStats[] = [
                'month' => $date->format('M Y'),
                'movies' => Movie::whereYear('created_at', $date->year)
                    ->whereMonth('created_at', $date->month)
                    ->count(),
                'users' => User::whereYear('created_at', $date->year)
                    ->whereMonth('created_at', $date->month)
                    ->count(),
            ];
        }

        return view('admin.dashboard', compact(
            'stats',
            'recentMovies',
            'recentUsers',
            'topRatedMovies',
            'moviesByGenre',
            'monthlyStats'
        ));
    }
}
