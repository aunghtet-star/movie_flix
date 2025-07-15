<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'provider',
        'provider_id',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Get the user's profile photo URL.
     */
    public function getProfilePhotoUrlAttribute()
    {
        if ($this->avatar) {
            // Handle default avatars
            if (str_contains($this->avatar, 'default-avatar')) {
                return $this->generateDefaultAvatar();
            }

            // Handle uploaded photos
            return Storage::url($this->avatar);
        }

        // Fallback to default avatar
        return $this->generateDefaultAvatar();
    }

    /**
     * Generate a default avatar based on user's name
     */
    private function generateDefaultAvatar()
    {
        $colors = ['#FF6B35', '#F7931E', '#FFD23F', '#06FFA5', '#118AB2', '#9D4EDD'];
        $initial = strtoupper(substr($this->name, 0, 1));
        $colorIndex = ord($initial) % count($colors);
        $color = $colors[$colorIndex];

        // Create a data URL for the SVG avatar
        $svg = '<svg width="200" height="200" xmlns="http://www.w3.org/2000/svg">
                    <defs>
                        <linearGradient id="grad" x1="0%" y1="0%" x2="100%" y2="100%">
                            <stop offset="0%" style="stop-color:' . $color . ';stop-opacity:1" />
                            <stop offset="100%" style="stop-color:' . $this->lightenColor($color, 20) . ';stop-opacity:1" />
                        </linearGradient>
                    </defs>
                    <circle cx="100" cy="100" r="100" fill="url(#grad)" />
                    <text x="100" y="125" text-anchor="middle" fill="white" font-size="80" font-family="Arial, sans-serif" font-weight="bold">' . $initial . '</text>
                </svg>';

        return 'data:image/svg+xml;base64,' . base64_encode($svg);
    }

    /**
     * Lighten a hex color
     */
    private function lightenColor($hex, $percent)
    {
        $hex = str_replace('#', '', $hex);
        $r = hexdec(substr($hex, 0, 2));
        $g = hexdec(substr($hex, 2, 2));
        $b = hexdec(substr($hex, 4, 2));

        $r = min(255, $r + ($percent * 255 / 100));
        $g = min(255, $g + ($percent * 255 / 100));
        $b = min(255, $b + ($percent * 255 / 100));

        return sprintf("#%02x%02x%02x", $r, $g, $b);
    }

    /**
     * Get all movie ratings by this user
     */
    public function movieRatings()
    {
        return $this->hasMany(MovieRating::class);
    }

    /**
     * Get user's rating for a specific movie
     */
    public function getRatingForMovie($movieId)
    {
        return $this->movieRatings()->where('movie_id', $movieId)->first();
    }

    /**
     * Get user's watchlist
     */
    public function watchlist()
    {
        return $this->hasMany(Watchlist::class);
    }

    /**
     * Get movies in user's watchlist
     */
    public function watchlistMovies()
    {
        return $this->belongsToMany(Movie::class, 'watchlists');
    }

    /**
     * Check if a movie is in user's watchlist
     */
    public function hasInWatchlist($movieId)
    {
        return $this->watchlist()->where('movie_id', $movieId)->exists();
    }
}
