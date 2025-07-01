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
use Illuminate\Support\Facades\Auth;

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
})->name('welcome');

// Authentication Routes
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', function() {
        return view('profile.edit', [
            'user' => auth()->user()
        ]);
    })->name('profile.edit');

    Route::patch('/profile', function() {
        $user = auth()->user();

        request()->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        ]);

        $user->update([
            'name' => request('name'),
            'email' => request('email'),
        ]);

        return back()->with('status', 'profile-updated');
    })->name('profile.update');

    // Password Update Route
    Route::put('/password', function() {
        $user = auth()->user();

        request()->validate([
            'current_password' => 'required|current_password',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user->update([
            'password' => bcrypt(request('password'))
        ]);

        return back()->with('status', 'password-updated');
    })->name('password.update');

    // Profile Photo Update Route
    Route::patch('/profile/photo', function() {
        $user = auth()->user();

        // Handle photo removal
        if (request('remove_photo')) {
            if ($user->avatar && !str_contains($user->avatar, 'default-avatar')) {
                Storage::disk('public')->delete($user->avatar);
            }
            $user->update(['avatar' => null]);
            return back()->with('status', 'photo-updated');
        }

        // Handle default avatar selection
        if (request('default_avatar')) {
            $avatarNumber = request('default_avatar');
            $colors = ['#FF6B35', '#F7931E', '#FFD23F', '#06FFA5', '#118AB2', '#9D4EDD'];
            $user->update(['avatar' => "default-avatar-{$avatarNumber}"]);
            return back()->with('status', 'photo-updated');
        }

        // Handle file upload
        if (request()->hasFile('profile_photo')) {
            request()->validate([
                'profile_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            // Delete old photo if exists
            if ($user->avatar && !str_contains($user->avatar, 'default-avatar')) {
                Storage::disk('public')->delete($user->avatar);
            }

            // Store new photo
            $path = request()->file('profile_photo')->store('avatars', 'public');
            $user->update(['avatar' => $path]);

            return back()->with('status', 'photo-updated');
        }

        return back()->with('error', 'Please select a photo to upload.');
    })->name('profile.photo.update');
});

// Logout Route
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout');

// Login and Register routes (if using Laravel Breeze/Fortify, these would be auto-generated)
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

// Movie routes
Route::get('/movies', function () {
    return view('movies.index');
})->name('movies.index');

Route::middleware('auth')->group(function () {

    Route::get('/movie_page', [MovieController::class,'index'])->name('moviePage');
    Route::get('/movie_page_details/{id}', [MovieController::class,'show'])->name('moviePage.show');
    Route::post('movies/{id}/rate', [MovieController::class, 'rate'])->name('movies.rate');
    Route::delete('movies/{id}/rate', [MovieController::class, 'deleteRating'])->name('movies.deleteRating');
    Route::get('movies/{id}/user-rating', [MovieController::class, 'getUserRating'])->name('movies.getUserRating');
    Route::get('/movies/search', [MovieController::class, 'search'])->name('movies.search');
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

// Social Authentication Routes
Route::get('/auth/{provider}', [App\Http\Controllers\Auth\SocialAuthController::class, 'redirectToProvider'])->name('social.redirect');
Route::get('/auth/{provider}/callback', [App\Http\Controllers\Auth\SocialAuthController::class, 'handleProviderCallback'])->name('social.callback');

require __DIR__.'/auth.php';
