<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminMovieController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\GenreController;
use App\Http\Controllers\Frontend\MovieController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\LoginController as AdminLoginController;
use App\Http\Controllers\Admin\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::get('/', function () {
    $featuredMovies = \App\Models\Movie::with('genre')->latest()->take(6)->get();

    // Get all genres from database for the dropdown
    $allGenres = \App\Models\Genre::all();

    // Get movie counts by genre for the genre cards
    $genreCounts = \App\Models\Movie::selectRaw('genres.name as genre_name, COUNT(*) as count')
        ->join('genres', 'movies.genre_id', '=', 'genres.id')
        ->groupBy('genres.name')
        ->pluck('count', 'genre_name')
        ->toArray();

    // Get sample movies for each genre to display in genre cards
    $genreMovies = [];
    $genres = ['Action', 'Comedy', 'Drama', 'Horror', 'Sci-Fi', 'Romance'];

    foreach ($genres as $genre) {
        $genreMovies[$genre] = \App\Models\Movie::with('genre')
            ->whereHas('genre', function($q) use ($genre) {
                $q->where('name', 'like', '%' . $genre . '%');
            })
            ->take(3)
            ->get();
    }

    return view('welcome', compact('featuredMovies', 'genreCounts', 'genreMovies', 'allGenres'));
});

Route::middleware('auth')->group(function () {

    Route::get('/movie_page', [MovieController::class,'index'])->name('moviePage');
    Route::get('/movie_page_details/{id}', [MovieController::class,'show'])->name('moviePage.show');
    Route::post('movies/{id}/rate', [MovieController::class, 'rate'])->name('movies.rate');
    Route::get('/movies/search', [MovieController::class, 'search'])->name('movies.search');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});




// Admin login
Route::prefix('admin')->group(function () {
    Route::get('login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login', [AdminLoginController::class, 'login'])->name('admin.login.submit');
    Route::post('logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

    Route::middleware('auth:admin')->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::resource('admins', AdminController::class);
        Route::resource('users', UserController::class);
        Route::resource('admin_movies', AdminMovieController::class);
        Route::resource('genres', GenreController::class);
    });
});



require __DIR__.'/auth.php';
