<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'tmdb_id',
        'title',
        'overview',
        'poster_path',
        'release_date',
    ];

    /**
     * User yang memiliki film ini di watchlist mereka.
     * KITA PERBAIKI RELASI INI
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->withPivot('rating');
    }
}
