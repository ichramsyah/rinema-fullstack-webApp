<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Genre;
use App\Models\FilmGenre;
use Illuminate\Http\Request;

class FilmGenreController extends Controller
{
    function tampil(){
        $pageTitle = 'Film Genre';
        $films = Film::all();
    
        // Inisialisasi array untuk menyimpan genre film
        $filmGenres = [];
    
        // Loop melalui setiap film dan ambil genre yang terkait
        foreach ($films as $film) {
            $filmGenres[$film->id] = FilmGenre::where('film_id', $film->id)->get();
    
            // Ambil nama genre dari tabel genres
            foreach ($filmGenres[$film->id] as $filmGenre) {
                $genre = Genre::find($filmGenre->genre_id);
                $filmGenre->genre_name = $genre ? $genre->nama : 'Genre Tidak Ditemukan';
            }
        }
    
        return view('admin.filmgenre.tampil', compact('films', 'filmGenres', 'pageTitle'));
    }

    public function tambah(){
        $pageTitle = 'Film Genre';
        return view('admin.filmgenre.tambah', compact('pageTitle'));
    }

    public function store(Request $request)
    {
    $filmId = $request->film_id;
    $genreIdsJson = $request->genres; // Ambil string JSON

    if ($genreIdsJson) {
        $genreIds = json_decode($genreIdsJson, true); // Dekode string JSON menjadi array
        if (is_array($genreIds)) { // Pastikan hasil decode adalah array
            foreach ($genreIds as $genreId) {
                FilmGenre::create([
                    'film_id' => $filmId,
                    'genre_id' => $genreId,
                ]);
            }
        }
    }
    return redirect()->route('admin.filmgenre.tampil')->with('success', 'Genre film berhasil ditambahkan.');
    }

    public function edit($id)
    {
        
        $filmGenre = FilmGenre::findOrFail($id);
        
        $films = Film::all();
        $genres = Genre::all();
        $filmGenres = FilmGenre::where('film_id', $filmGenre->film_id)->pluck('genre_id')->toArray();
        $film = Film::find($filmGenre->film_id); // Ambil data film

        return view('admin.filmgenre.edit', compact('filmGenre', 'films', 'genres', 'filmGenres', 'film'));
    }

    public function update(Request $request, $id)
    {
    $filmGenre = FilmGenre::findOrFail($id);
    $filmId = $request->film_id; // Ambil film_id dari request

    FilmGenre::where('film_id', $filmId)->delete();

    if ($request->has('genres')) {
        foreach ($request->genres as $genreId) {
            FilmGenre::create([
                'film_id' => $filmId, // Gunakan film_id dari request
                'genre_id' => $genreId,
            ]);
        }
    }

    return redirect()->route('admin.filmgenre.tampil')->with('success', 'Genre film berhasil diperbarui.');
    }
    
}
