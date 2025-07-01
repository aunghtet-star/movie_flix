<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'picture',
        'actor',
        'actress',
        'long_time',
        'download_link',
        'genre_id',
        'year',
        'views',
        'average_rating',
        'total_ratings',
    ];

    protected $casts = [
        'average_rating' => 'decimal:1',
        'total_ratings' => 'integer',
        'views' => 'integer',
        'year' => 'integer',
    ];

    /**
     * Get the genre that owns the movie
     */
    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    /**
     * Get all ratings for this movie
     */
    public function ratings()
    {
        return $this->hasMany(MovieRating::class);
    }

    /**
     * Get user's rating for this movie
     */
    public function userRating($userId)
    {
        return $this->ratings()->where('user_id', $userId)->first();
    }

    /**
     * Calculate and update average rating
     */
    public function updateAverageRating()
    {
        $ratings = $this->ratings();
        $average = $ratings->avg('rating');
        $total = $ratings->count();

        $this->update([
            'average_rating' => $average ? round($average, 1) : 0,
            'total_ratings' => $total,
        ]);

        return $this;
    }

    /**
     * Get formatted rating display
     */
    public function getFormattedRatingAttribute()
    {
        return number_format($this->average_rating, 1);
    }

    /**
     * Get rating percentage for progress bars
     */
    public function getRatingPercentageAttribute()
    {
        return ($this->average_rating / 5) * 100;
    }

    /**
     * Get star display array for blade templates
     */
    public function getStarDisplayAttribute()
    {
        $rating = $this->average_rating;
        $stars = [];

        for ($i = 1; $i <= 5; $i++) {
            if ($i <= floor($rating)) {
                $stars[] = 'full';
            } elseif ($i <= ceil($rating) && $rating > floor($rating)) {
                $stars[] = 'half';
            } else {
                $stars[] = 'empty';
            }
        }

        return $stars;
    }

    /**
     * Increment view count
     */
    public function incrementViews()
    {
        $this->increment('views');
        return $this;
    }
}
