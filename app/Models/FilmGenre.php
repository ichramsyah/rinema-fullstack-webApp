<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FilmGenre extends Model
{
    use HasFactory;

    protected $table = 'film_genre';

    protected $fillable = ['film_id', 'genre_id'];

    public function film()
    {
        return $this->belongsTo(Film::class);
    }

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }
}
