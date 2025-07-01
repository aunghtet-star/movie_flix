<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Get the movies that belong to this genre.
     */
    public function movies()
    {
        return $this->hasMany(Movie::class);
    }
}
