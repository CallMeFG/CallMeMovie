<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController; // <-- TAMBAHKAN BARIS INI

Route::get('/', [MovieController::class, 'home'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // TAMBAHKAN ROUTE INI UNTUK PENCARIAN FILM
    Route::get('/search', [MovieController::class, 'search'])->name('movies.search');
    // TAMBAHKAN ROUTE INI
    Route::post('/watchlist/add/{tmdbId}', [MovieController::class, 'addToWatchlist'])->name('watchlist.add');
    // TAMBAHKAN ROUTE INI UNTUK MENAMPILKAN HALAMAN WATCHLIST
    Route::get('/watchlist', [MovieController::class, 'watchlist'])->name('watchlist.index');
    // TAMBAHKAN ROUTE INI UNTUK MENGHAPUS FILM DARI WATCHLIST
    Route::delete('/watchlist/remove/{movie}', [MovieController::class, 'removeFromWatchlist'])->name('watchlist.remove');
    //
    Route::post('/movie/{movie}/rate', [MovieController::class, 'rateMovie'])->name('movies.rate');
});
//baru
Route::get('/movie/{tmdbId}', [MovieController::class, 'show'])->name('movies.show');
require __DIR__.'/auth.php';
//baru lagi
