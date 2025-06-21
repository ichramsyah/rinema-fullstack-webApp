<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\FilmGenre;
use App\Models\Forum;
use App\Models\ForumReply;
use App\Models\Genre;
use App\Models\Rating;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    function home(){
        $latestFilms = Film::orderBy('tahun_rilis', 'desc')->take(10)->get();

        foreach ($latestFilms as $film) {
            $genres = FilmGenre::where('film_id', $film->id)->pluck('genre_id')->toArray();
            $genreNames = Genre::whereIn('id', $genres)->pluck('nama')->toArray();
            $film->genres = implode(', ', $genreNames);
        }

        // Ambil film dengan rating tertinggi yang memiliki minimal 5 rating
        $topRatedFilmId = Rating::select('film_id', DB::raw('AVG(rating) as average_rating'))
            ->groupBy('film_id')
            ->having(DB::raw('COUNT(film_id)'), '>=', 5) // Filter film dengan minimal 5 rating
            ->orderByDesc('average_rating')
            ->first();

        // Ambil detail film berdasarkan film_id yang didapatkan
        $topRatedFilm = null;
        $comments = [];
        $genres = []; // Inisialisasi variabel genres

        if ($topRatedFilmId) {
            $topRatedFilm = Film::find($topRatedFilmId->film_id);
            $topRatedFilm->average_rating = $topRatedFilmId->average_rating; // Tambahkan rata-rata rating ke model film

            $genreIds = FilmGenre::where('film_id', $topRatedFilmId->film_id)->pluck('genre_id')->toArray();
            $genres = Genre::whereIn('id', $genreIds)->pluck('nama')->toArray();
            $comments = Rating::where('film_id', $topRatedFilmId->film_id)->with('user')->get();
        }

        return view('pages.home', [
            'topRatedFilm' => $topRatedFilm,
            'comments' => $comments,
            'latestFilms' => $latestFilms,
            'genres' => $genres,
        ]);
    }

    // Film
  function film(Request $request)
{
    // 1. Mengambil input dari request
    $genreFilter = $request->input('genre');
    $searchQuery = $request->input('search');
    $sort = $request->input('sort');

    // 2. Memulai query untuk mengambil data film
    $films = FilmGenre::with('film', 'genre');

    if ($genreFilter) {
        $genre = Genre::where('nama', $genreFilter)->first();
        if ($genre) {
            $films->where('genre_id', $genre->id);
        }
    }

    if ($searchQuery) {
        $films->whereHas('film', function ($query) use ($searchQuery) {
            $query->where('judul', 'like', '%' . $searchQuery . '%');
        });
    }

    $films = $films->get();

    // 3. Mengambil dan menghitung rata-rata rating untuk setiap film
    $averageRatings = Rating::groupBy('film_id')
        ->selectRaw('film_id, avg(rating) as average_rating')
        ->pluck('average_rating', 'film_id');

    // 4. Memproses data untuk menyatukan film dengan genrenya
    $uniqueFilms = [];
    $filmGenres = [];

    foreach ($films as $filmGenre) {
        $filmId = $filmGenre->film_id;

        if (!isset($uniqueFilms[$filmId])) {
            $uniqueFilms[$filmId] = $filmGenre->film;
            $filmGenres[$filmId] = [];
        }

        $filmGenres[$filmId][] = $filmGenre->genre->nama;
    }

    $filmsWithGenres = [];
    foreach ($uniqueFilms as $filmId => $film) {
        $film->genres = implode(', ', $filmGenres[$filmId]);
        $film->average_rating = $averageRatings->has($filmId) ? $averageRatings[$filmId] : 0;
        $filmsWithGenres[] = $film;
    }
    
    // Siapkan teks default untuk ditampilkan di tombol filter
    $sort_text = 'Default'; 

    if ($sort == 'popular') {
        $sort_text = 'Terpopuler';
        usort($filmsWithGenres, function ($a, $b) {
            return $b->average_rating <=> $a->average_rating;
        });
    } elseif ($sort == 'latest') {
        $sort_text = 'Terbaru';
        usort($filmsWithGenres, function ($a, $b) {
            // Mengurutkan berdasarkan tahun rilis, dari yang terbaru ke terlama
            return strtotime($b->tahun_rilis) <=> strtotime($a->tahun_rilis);
        });
    } elseif ($sort == 'oldest') {
        $sort_text = 'Terlawas';
        usort($filmsWithGenres, function ($a, $b) {
            // Mengurutkan berdasarkan tahun rilis, dari yang terlama ke terbaru
            return strtotime($a->tahun_rilis) <=> strtotime($b->tahun_rilis);
        });
    }

    return view('pages.film', compact('filmsWithGenres', 'sort_text'));
}

// Detail Film
    public function detailfilm($id){
    $film = Film::findOrFail($id);

    $ratings = Rating::where('film_id', $id)->with('user')->get();
    $averageRatings = $ratings->avg('rating');

    $userHasRated = null;
    if (Auth::check()) {
        $userHasRated = Rating::where('film_id', $id)
                            ->where('user_id', Auth::id())
                            ->first(); 
    }

    $genres = FilmGenre::where('film_id', $film->id)->with('genre')->get(); 
    $genreNames = $genres->pluck('genre.nama')->toArray();

    $forums = Forum::where('film_id', $id)
            ->with(['user', 'forumReplies.user', 'forumReplies.parent'])
            ->get();

    $user = Auth::user();

    return view('pages.detailFilm', compact('film', 'ratings', 'averageRatings','genreNames', 'forums', 'user', 'userHasRated'));
    }

    public function storeRating(Request $request, $id)
    {
        $request->validate([
            'rating' => 'required|numeric|min:0|max:10',
        ]);

        Rating::create([
            'film_id' => $id,
            'user_id' => Auth::id(),
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return redirect()->back()->with('success', 'Rating berhasil dikirim.');
    }

    public function destroyRating($ratingId)
    {
        $rating = Rating::findOrFail($ratingId);

        if($rating->user_id !== Auth::id()){
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk menghapus rating ini.');
        }

        $rating->delete();

        return redirect()->back()->with('success', 'Anda berhasil menghapus rating.');
    }

    
    // Forum
    public function storeForumReply(Request $request, $id)
    {
        $request->validate([
            'body' => 'required',
        ]);
    
        $forum = Forum::where('film_id', $id)->first();
    
        if ($forum && Auth::check()) {
            ForumReply::create([
                'forum_id' => $forum->id,
                'user_id' => Auth::id(),
                'body' => $request->body,
                'parent_reply_id' => null, // Balasan langsung ke forum, jadi parent_reply_id null
            ]);
    
            return redirect()->back()->with('success', 'Balasan berhasil dikirim.');
        } else {
            return redirect()->back()->with('error', 'Forum tidak ditemukan atau Anda belum login.');
        }
    }

    public function deleteForumReply($replyId)
    {
    $reply = ForumReply::find($replyId);

    if (!$reply) {
        return redirect()->back()->with('error', 'Komentar tidak ditemukan.');
    }

    if (Auth::id() !== $reply->user_id) {
        return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk menghapus komentar ini.');
    }

    $reply->delete();

    return redirect()->back()->with('success', 'Komentar berhasil dihapus.');
    }


    public function updateForumReply(Request $request, $replyId)
    {
    $request->validate([
        'body' => 'required',
    ]);

    $reply = ForumReply::find($replyId);

    if (!$reply) {
        return redirect()->back()->with('error', 'Komentar tidak ditemukan.');
    }

    if (Auth::id() !== $reply->user_id) {
        return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk mengedit komentar ini.');
    }

    $reply->body = $request->body;
    $reply->save();

    return redirect()->back()->with('success', 'Komentar berhasil diubah.');
    }
}