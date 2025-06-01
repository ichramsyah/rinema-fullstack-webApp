<?php

use App\Http\Controllers\Api\FilmApiController;
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

// film berdasarkan genre
Route::get('/films/genre/{genre}', [FilmApiController::class, 'filmByGenre']);

// indeks film
Route::get('/films/{film}', [FilmApiController::class, 'show']);