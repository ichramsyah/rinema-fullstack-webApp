<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Film; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; 
use App\Http\Resources\FilmResource;
use App\Http\Resources\GenreResource;
use App\Models\Genre;

// With Eager Loading


class FilmApiController extends Controller
{
    public function allFilm() {
        $film = Film::with('genres')
            ->withAvg('ratings', 'rating')
            ->withCount('ratings')
            ->get();

        return FilmResource::collection($film);
    }

    public function latest(){
       $latest = Film::with('genres')
            ->withAvg('ratings', 'rating')
            ->withCount('ratings')
            ->orderBy('tahun_rilis', 'desc')
            ->get();

        return FilmResource::collection($latest);
    }

    public function oldest() {
        $oldest = Film::with('genres')
            ->withAvg('ratings', 'rating')
            ->withCount('ratings')
            ->orderBy('tahun_rilis', 'asc')
            ->get();

        return FilmResource::collection($oldest);
    }

    public function popular(){
        $popular = Film::with('genres')
            ->withAvg('ratings', 'rating')
            ->withCount('ratings')
            ->having('ratings_count', '>=', 5)
            ->orderByDesc('ratings_avg_rating')
            ->take(1)
            ->get();

        return FilmResource::collection($popular);
    }

    public function allGenre(){
        $allGenre = Genre::all();

        return GenreResource::collection($allGenre);
    }

    public function filmByGenre(Genre $genre){
        $filmByGenre = Film::with('genres')
            ->withAvg('ratings', 'rating')
            ->withCount('ratings')
            ->whereHas('genres', function ($query) use ($genre) {
                $query->where('genres.id', $genre->id);
            } )
            ->get();
        
            return FilmResource::collection($filmByGenre);
    }

    // Pencarian film
    public function searchFilm(Request $request){
    $searchQuery = $request->input('query');
    
    if(empty($searchQuery)) { // Validasi Input
        return response()->json([
            'message' => 'Mohon mengisi kolom input!'
        ], 400);
    }

    $films = Film::with('genres')
        ->withAvg('ratings', 'rating')
        ->withCount('ratings')
        ->where('judul', 'like', '%' . $searchQuery . '%')
        ->get();

    if ($films->isEmpty()) {
        return response()->json([
            'message' => 'Film tidak ditemukan'
        ], 404);
    }

    return FilmResource::collection($films);
}



    public function show(Film $film){
        $film->load('genres')->loadAvg('ratings', 'rating')->loadCount('ratings');

        return new FilmResource($film);
    }


}
