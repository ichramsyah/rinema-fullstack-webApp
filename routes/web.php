<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\FilmGenreController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\ForumReplyController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


// Client
Route::post('/save-intended-url', [AuthenticatedSessionController::class, 'saveIntendedUrl'])->name('save.intended.url');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('index');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/destroy', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/profile/rating/{film}', [ProfileController::class, 'updateRating'])->name('profile.rating.update');
    Route::delete('profile/rating/destroy/{film}', [ProfileController::class, 'destroyRating'])->name('profile.rating.destroy');

    Route::post('/profile/replies/{forumReply}', [ProfileController::class, 'updateReply'])->name('profile.replies.update');
    Route::delete('/profile/replies/{forumReply}', [ProfileController::class, 'destroyReply'])->name('profile.replies.destroy');

    Route::delete('profile/account-delete', [ProfileController::class, 'deleteAccount'])->name('profile.delete.account');

});

Route::get('/', [HomeController::class, 'home'])->name('home');

Route::get('/film', [HomeController::class, 'film'])->name('film');
Route::get('/film/{id}', [HomeController::class, 'detailfilm'])->name('detailfilm');
Route::post('/film/{id}/forum/reply', [HomeController::class, 'storeForumReply'])->name('forum.reply.store');
Route::delete('/forum/reply/{replyId}', [HomeController::class, 'deleteForumReply'])->name('forum.reply.delete');
Route::put('/forum/reply/{replyId}', [HomeController::class, 'updateForumReply'])->name('forum.reply.update');

Route::post('/film/{id}/rating', [HomeController::class, 'storeRating'])->name('film.rating.store');
Route::delete('/film/rating/{ratingId}', [HomeController::class, 'destroyRating'])->name('film.rating.destroy');


// Admin Panel
Route::get('admin/dashboard', [AdminController::class, 'index'])->middleware(['auth', 'admin']);

// Users
Route::get('admin/dashboard/users', [UserController::class, 'tampil'])->name('admin.users.tampil')->middleware(['auth', 'admin']);
Route::get('admin/dashboard/tambah', [UserController::class, 'tambah'])->name('admin.users.tambah')->middleware(['auth', 'admin']);
Route::post('admin/dashboard/submit', [UserController::class, 'submit'])->name('admin.users.submit')->middleware(['auth', 'admin']);

Route::get('/admin/users/edit/{id}', [UserController::class, 'edit'])->name('admin.users.edit')->middleware(['auth', 'admin']);
Route::post('/admin/users/update/{id}', [UserController::class, 'update'])->name('admin.users.update')->middleware(['auth', 'admin']);
Route::post('/admin/users/hapus/{id}', [UserController::class, 'hapus'])-> name('admin.users.hapus')->middleware(['auth', 'admin']);

//Films
Route::get('/admin/dashboard/films', [FilmController::class, 'index'])->name('admin.films.tampil')->middleware(['auth', 'admin']);

Route::get('admin/films/tambah', [FilmController::class, 'tambah'])->name('admin.films.tambah')->middleware(['auth', 'admin']);
Route::post('admin/films/submit', [FilmController::class, 'submit'])->name('admin.films.submit')->middleware(['auth', 'admin']);

Route::get('/admin/films/edit/{id}', [FilmController::class, 'edit'])->name('admin.films.edit')->middleware(['auth', 'admin']);
Route::post('/admin/films/update/{id}', [FilmController::class, 'update'])->name('admin.films.update')->middleware(['auth', 'admin']);
Route::post('/admin/films/hapus/{id}', [FilmController::class, 'hapus'])-> name('admin.films.hapus')->middleware(['auth', 'admin']);

// genre
Route::get('/admin/dashboard/genres', [GenreController::class, 'tampil'])->name('admin.genres.tampil')->middleware(['auth', 'admin']);
Route::get('/admin/genres/tambah', [GenreController::class, 'tambah'])->name('admin.genres.tambah')->middleware(['auth', 'admin']);
Route::post('/admin/genres', [GenreController::class, 'submit'])->name('admin.genres.submit')->middleware(['auth', 'admin']);

Route::get('admin/genres/edit/{id}', [GenreController::class, 'edit'])->name('admin.genres.edit')->middleware(['auth', 'admin']);
Route::post('admin/genres/update/{id}', [GenreController::class, 'update'])->name('admin.genres.update')->middleware(['auth', 'admin']);
Route::post('admin/genres/hapus/{id}', [GenreController::class, 'hapus'])->name('admin.genres.hapus')->middleware(['auth', 'admin']);

// film genre
Route::get('admin/dashboard/filmgenre', [FilmGenreController::class, 'tampil'])->name('admin.filmgenre.tampil')->middleware(['auth', 'admin']);
Route::get('admin/filmgenre/tambah', [FilmGenreController::class, 'tambah'])->name('admin.filmgenre.tambah')->middleware(['auth', 'admin']);
Route::post('admin/filmgenre/store', [FilmGenreController::class, 'store'])->name('admin.filmgenre.store')->middleware(['auth', 'admin']);

Route::get('admin/filmgenre/edit/{id}', [FilmGenreController::class, 'edit'])->name('admin.filmgenre.edit')->middleware(['auth', 'admin']);
Route::post('admin/filmgenre/update/{id}', [FilmGenreController::class, 'update'])->name('admin.filmgenre.update')->middleware(['auth', 'admin']);


// ratings
Route::get('admin/ratings/index', [RatingController::class, 'index'])->name('admin.ratings.index')->middleware(['auth', 'admin']);
Route::get('admin/ratings/create', [RatingController::class, 'create'])->name('admin.ratings.create')->middleware(['auth', 'admin']);
Route::post('admin/ratings/store', [RatingController::class, 'store'])->name('admin.ratings.store')->middleware(['auth', 'admin']);


Route::get('admin/ratings/edit/{id}', [RatingController::class, 'edit'])->name('admin.ratings.edit')->middleware(['auth', 'admin']);
Route::post('admin/ratings/update/{id}', [RatingController::class, 'update'])->name('admin.ratings.update')->middleware(['auth', 'admin']);

Route::post('admin/ratings/destroy/{id}', [RatingController::class, 'destroy'])->name('admin.ratings.destroy')->middleware(['auth', 'admin']);

// Forums
Route::get('admin/forums/index', [ForumController::class, 'index'])->name('admin.forums.index')->middleware(['auth', 'admin']);
Route::get('admin/forums/create', [ForumController::class, 'create'])->name('admin.forums.create')->middleware(['auth', 'admin']);
Route::post('admin/forums/store', [ForumController::class, 'store'])->name('admin.forums.store')->middleware(['auth', 'admin']);


Route::get('admin/forums/edit/{id}', [ForumController::class, 'edit'])->name('admin.forums.edit')->middleware(['auth', 'admin']);
Route::post('admin/forums/update/{id}', [ForumController::class, 'update'])->name('admin.forums.update')->middleware(['auth', 'admin']);
Route::post('admin/forums/destroy/{id}', [ForumController::class, 'destroy'])->name('admin.forums.destroy')->middleware(['auth', 'admin']);


Route::get('admin/forumreply/index', [ForumReplyController::class, 'index'])->name('admin.forumreply.index')->middleware(['auth', 'admin']);
Route::get('admin/forumreply/create', [ForumReplyController::class, 'create'])->name('admin.forumreply.create')->middleware(['auth', 'admin']);
Route::post('admin/forumreply/store', [ForumReplyController::class, 'store'])->name('admin.forumreply.store')->middleware(['auth', 'admin']);

Route::get('admin/forumreply/edit/{id}', [ForumReplyController::class, 'edit'])->name('admin.forumreply.edit')->middleware(['auth', 'admin']);
Route::post('admin/forumreply/update/{id}', [ForumReplyController::class, 'update'])->name('admin.forumreply.update')->middleware(['auth', 'admin']);
Route::post('admin/forumreply/destroy/{id}', [ForumReplyController::class, 'destroy'])->name('admin.forumreply.destroy')->middleware(['auth', 'admin']);


Route::get('/login/google', [ProfileController::class, 'redirectToGoogle'])->name('login.google');
Route::get('/login/google/callback', [ProfileController::class, 'handleGoogleCallback']);

require __DIR__.'/auth.php';

// Fallback
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});