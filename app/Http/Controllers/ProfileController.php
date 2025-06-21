<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Film;
use App\Models\FilmGenre;
use App\Models\Forum;
use App\Models\ForumReply;
use App\Models\Genre;
use App\Models\Rating;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Laravel\Socialite\Facades\Socialite;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Ambil semua rating yang diberikan oleh pengguna yang sedang login
        $userRatings = Rating::where('user_id', $user->id)->get();

        $ratedFilms = [];

        foreach ($userRatings as $userRating) {

            // Ambil detail film berdasarkan film_id di rating
            $film = Film::find($userRating->film_id);

            if($film) {
                // Tambahkan informasi rating ke dalam objek film
                $film->user_rating = $userRating->rating;
                $film->user_comment = $userRating->comment;

                // Ambil ID genre dari tabel film_genres
                $genreIds = FilmGenre::where('film_id', $film->id)->pluck('genre_id')->toArray();

                // Ambil nama genre berdasarkan ID genre
                $genreNames = Genre::whereIn('id', $genreIds)->pluck('nama')->toArray();

                // Tambahkan informasi genre ke dalam objek film
                $film->genres = implode(', ', $genreNames);


                $ratedFilms[] = $film;
            }
        }

        // Ambil semua balasan forum yang dibuat oleh pengguna yang sedang login
        $forumReplies = ForumReply::where('user_id', $user->id)->get();

        $userForumReplies = [];
        foreach($forumReplies as $reply){

            // Ambil informasi forum terkait
            $forum = Forum::find($reply->forum_id);
            if($forum){

                // Ambil informasi film terkait dengan forum
                $film = Film::find($forum->film_id);
                if($film){
                    $reply->forumTittle = $forum->title;
                    $reply->filmName = $film->judul;
                    $userForumReplies[] = $reply;
                }
            }
        }        
       
        return view('pages.profile', compact(['user', 'ratedFilms', 'userForumReplies']));
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = Auth::user();
        if (!$user) {
            return redirect('profile')->withErrors(['error' => 'Pengguna tidak ditemukan.']);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', \Illuminate\Validation\Rule::unique('users')->ignore($user->id)],
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect('profile')
                        ->withErrors($validator)
                        ->withInput(); // Mengirimkan kembali input lama agar tidak perlu diisi ulang
        }

        $validatedData = $request->validated();


        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        
        if ($request->filled('password')) {
            $user->password = Hash::make($validatedData['password']);
        }

        $user-> save();
        return redirect('profile')->with('success', 'Profil berhasil diperbarui.');
    
    }

    public function updateRating(Request $request, Film $film)
    {
        // Validasi input dari form
        $request->validate([
            'rating' => ['required', 'numeric', 'min:0', 'max:10'],
            'comment' => 'nullable|string|max:255', // Contoh validasi komentar
        ]);

        // Dapatkan pengguna yang sedang login
        $user = Auth::user();

        // Cari rating yang sudah ada untuk pengguna dan film ini
        $existingRating = Rating::where('user_id', $user->id)
            ->where('film_id', $film->id)
            ->first();

         // Dapatkan pengguna yang sedang login
         $user = Auth::user();

         // Cari rating yang sudah ada untuk pengguna dan film ini
         $existingRating = Rating::where('user_id', $user->id)
             ->where('film_id', $film->id)
             ->first();
 
         if ($existingRating) {

             // Jika rating sudah ada, update rating dan komentar
             $existingRating->rating = $request->rating;
             $existingRating->comment = $request->comment;
             $existingRating->save();
 
             return back()->with('success', 'Rating dan komentar berhasil diperbarui.');
         } else {

             // Jika belum ada rating, buat rating baru
             $rating = new Rating([
                 'user_id' => $user->id,
                 'film_id' => $film->id,
                 'rating' => $request->rating,
                 'comment' => $request->comment,
             ]);
             $rating->save();
 
             return back()->with('success', 'Rating dan komentar berhasil disimpan.');
         }
    }

    public function destroyRating(Film $film)
    {
        // Dapatkan pengguna yang sedang login
        $user = Auth::user();
        
        // Cari rating yang sesuai dengan pengguna dan film
        $ratingToDelete = Rating::where('user_id', $user->id)
            ->where('film_id', $film->id)
            ->first();

        if ($ratingToDelete) {
            $ratingToDelete->delete();
            return back()->with('success', 'Rating berhasil dihapus.');
        } else {
            return back()->withErrors(['error' => 'Rating tidak ditemukan.']);
        }
    }
   
    public function updateReply(Request $request, ForumReply $forumReply)
    {
        if (Auth::id() === $forumReply->user_id) {
            $request->validate([
                'body' => 'required|string|max:255',
            ]);

            $forumReply->body = $request->input('body');
            $forumReply->save();
            return back()->with('success', 'Komentar forum berhasil diperbarui.');
        } else {
            return back()->withErrors(['error' => 'Anda tidak memiliki izin untuk memperbarui balasan ini.']);
        }
    }

    public function destroyReply(ForumReply $forumReply)
    {
        if(Auth::id() === $forumReply->user_id){
            $forumReply->delete();
            return back()->with('success', 'Komentar forum berhasil dihapus.');
            } else {
                return back()->withErrors(['error' => 'Anda tidak memiliki izin untuk menghapus balasan ini.']);
            }
    }

    public function deleteAccount(Request $request){
        $user = Auth::user();

         // Logout pengguna sebelum menghapus akun
        Auth::logout();

        // Hapus akun pengguna
        $user->delete();
    
        return redirect()->route('/profile')->with('success', 'Akun Anda berhasil dihapus.');
    }
    


   public function handleGoogleCallback(Request $request)
{
    // 1. Validasi request dari frontend
    $validator = Validator::make($request->all(), [
        'code' => 'required|string', // Kita butuh 'code' dari frontend
    ]);

    if ($validator->fails()) {
        return response()->json($validator->errors(), 422);
    }

    try {
        // 2. Dapatkan data user dari Google menggunakan 'code'
        // Gunakan userFromCode, bukan user() karena kita provide code secara manual
        $googleUser = Socialite::driver('google')->stateless()->userFromCode($request->code);

        // 3. Buat atau perbarui user di database Anda
        $user = User::updateOrCreate(
            [
                'google_id' => $googleUser->getId(),
            ],
            [
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'google_token' => $googleUser->token,
                'password' => Hash::make('password_google'), // Password acak/tetap untuk user Google
                'email_verified_at' => now(),
            ]
        );

        // 4. Buat API Token untuk user tersebut
        $token = $user->createToken('google-auth-token')->plainTextToken;

        // 5. Kembalikan token dan data user sebagai respons JSON
        return response()->json([
            'message' => 'Login dengan Google berhasil.',
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user
        ]);

    } catch (\Exception $e) {
        // Tangani jika ada error
        return response()->json([
            'message' => 'Autentikasi gagal.',
            'error' => $e->getMessage()
        ], 401);
    }
}
}
