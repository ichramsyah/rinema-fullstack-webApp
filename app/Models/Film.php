<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'produser',
        'sutradara',
        'penulis',
        'produksi',
        'pemeran',
        'tahun_rilis',
        'durasi',
        'usia',
        'poster',
        'trailer',
        'sinopsis',
    ];

    public function genres()
    {
        // Parameter kedua adalah NAMA TABEL PIVOT yang PERSIS di database Anda
        // Jika nama tabelnya 'FilmGenre' (dengan F dan G kapital)
        return $this->belongsToMany(Genre::class, 'film_genre', 'film_id', 'genre_id');
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }


     public function forum()
    {
        return $this->hasOne(Forum::class);
    }

    
}
