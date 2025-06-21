<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Film;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\RatingResource; // Kita akan buat file ini setelah ini

class RatingApiController extends Controller
{
    /**
     * Menampilkan semua rating untuk sebuah film.
     * Endpoint: GET /api/films/{film}/ratings
     */
    public function index(Film $film)
    {
        // Ambil semua rating untuk film ini, beserta data user yang memberi rating
        $ratings = $film->ratings()->with('user')->latest()->get();

        // Kembalikan sebagai koleksi resource untuk konsistensi data
        return RatingResource::collection($ratings);
    }

    /**
     * Menyimpan rating baru atau memperbarui rating yang sudah ada dari user.
     * Endpoint: POST /api/films/{film}/ratings
     */
    public function store(Request $request, Film $film)
    {
        $request->validate([
            'rating' => 'required|numeric|min:0|max:10',
            'comment' => 'nullable|string|max:1000',
        ]);

        $user = Auth::user();

        // Gunakan updateOrCreate untuk:
        // 1. MEMBUAT rating baru jika user belum pernah memberi rating untuk film ini.
        // 2. MEMPERBARUI rating lama jika user sudah pernah memberi rating.
        $rating = $film->ratings()->updateOrCreate(
            ['user_id' => $user->id], // Kunci untuk mencari rating yang ada
            [
                'rating' => $request->rating,
                'comment' => $request->comment
            ] // Data yang akan di-create atau di-update
        );

        // Cek apakah rating baru dibuat atau di-update untuk menentukan status code
        $wasRecentlyCreated = $rating->wasRecentlyCreated;
        $statusCode = $wasRecentlyCreated ? 201 : 200; // 201: Created, 200: OK

        return response()->json([
            'message' => 'Rating berhasil ' . ($wasRecentlyCreated ? 'disimpan.' : 'diperbarui.'),
            'data' => new RatingResource($rating->load('user')) // Muat relasi user dan kirim balik datanya
        ], $statusCode);
    }
    
    /**
     * Menampilkan rating spesifik dari seorang user untuk sebuah film.
     * Endpoint: GET /api/films/{film}/ratings/user
     */
    public function showUserRating(Film $film)
    {
        $user = Auth::user();
        $rating = $film->ratings()->where('user_id', $user->id)->first();

        if (!$rating) {
            return response()->json(['message' => 'Anda belum memberikan rating untuk film ini.'], 404);
        }

        return new RatingResource($rating->load('user'));
    }

    /**
     * Menghapus rating yang dimiliki oleh user yang sedang login.
     * Endpoint: DELETE /api/films/{film}/ratings
     */
    public function destroy(Film $film)
    {
        $user = Auth::user();
        $rating = $film->ratings()->where('user_id', $user->id)->first();

        if (!$rating) {
            return response()->json(['message' => 'Rating tidak ditemukan atau Anda tidak memiliki izin.'], 404);
        }

        $rating->delete();

        return response()->json(['message' => 'Rating Anda berhasil dihapus.'], 200);
    }
}