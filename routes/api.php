<?php

use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\FilmApiController;
use App\Http\Controllers\Api\ForumApiController;
use App\Http\Controllers\Api\RatingApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



// Semua film
Route::get('/films/allFilm', [FilmApiController::class, 'allFilm']);

// Terbaru
Route::get('/films/latest', [FilmApiController::class, 'latest']);

// Terlawas
Route::get('/films/oldest', [FilmApiController::class, 'oldest']);

// Terpopuler
Route::get('/films/popular', [FilmApiController::class, 'popular']);

// search film
Route::get('/films/search', [FilmApiController::class, 'searchFilm']);

// semua genre
Route::get('/films/allGenre', [FilmApiController::class, 'allGenre']);

// google
Route::post('/auth/google/callback', [AuthApiController::class, 'handleGoogleCallback']);

// Register
Route::post('/register', [AuthApiController::class, 'register']);

// Login
Route::post('/login', [AuthApiController::class, 'login']);


// Lihat forum
Route::get('/films/{film}/forum-replies', [ForumApiController::class, 'index']);

// rating film
Route::get('/films/{film}/ratingsView', [RatingApiController::class, 'index']);

// film berdasarkan genre
Route::get('/films/genre/{genre}', [FilmApiController::class, 'filmByGenre']);

// indeks film
Route::get('/films/{film}', [FilmApiController::class, 'show']);

// Semua rute di dalam grup ini memerlukan user untuk login (terautentikasi)
Route::middleware('auth:sanctum')->group(function () {

    // Endpoint yang berhubungan dengan rating untuk film tertentu
    Route::prefix('films/{film}/ratings')->group(function () {

        // POST /api/films/{film}/ratings -> Menyimpan/memperbarui rating dari user
        Route::post('/', [RatingApiController::class, 'store']);

        // GET /api/films/{film}/ratings/user -> Melihat rating spesifik dari user yg login
        Route::get('/user', [RatingApiController::class, 'showUserRating']);

        // DELETE /api/films/{film}/ratings -> Menghapus rating dari user
        Route::delete('/', [RatingApiController::class, 'destroy']);

    });

      // Membuat balasan baru untuk sebuah film
        Route::post('/films/{film}/forum-replies', [ForumApiController::class, 'store']);

        // Menghapus balasan spesifik
        Route::delete('/forum-replies/{reply}', [ForumApiController::class, 'destroy']);


});