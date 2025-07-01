<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovieRating extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'movie_id',
        'rating',
        'review',
    ];

    protected $casts = [
        'rating' => 'integer',
    ];

    /**
     * Get the user that owns the rating
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the movie that owns the rating
     */
    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }

    /**
     * Boot method to update movie average rating when rating changes
     */
    protected static function boot()
    {
        parent::boot();

        static::created(function ($rating) {
            $rating->movie->updateAverageRating();
        });

        static::updated(function ($rating) {
            $rating->movie->updateAverageRating();
        });

        static::deleted(function ($rating) {
            $rating->movie->updateAverageRating();
        });
    }
}
