<?php

namespace App\Http\Controllers;

use App\Services\TmdbService; // <-- Import service kita
use Illuminate\Http\Request;
use App\Models\Movie; // <-- TAMBAHKAN USE STATEMENT INI
use Illuminate\Support\Facades\Auth; // <-- TAMBAHKAN BARIS INI
use Illuminate\Support\Facades\Cache; // <-- TAMBAHKAN INI

class MovieController extends Controller
{
    protected $tmdbService;

    // Kita menggunakan Dependency Injection di sini.
    // Laravel akan secara otomatis membuatkan instance dari TmdbService
    // dan memasukkannya ke dalam controller kita. Ajaib!
    public function __construct(TmdbService $tmdbService)
    {
        $this->tmdbService = $tmdbService;
    }
    /**
     * Menampilkan halaman utama dengan beberapa kategori film.
     */
    public function home()
    {
        // Ambil data untuk setiap kategori dari service
        $nowPlayingMovies = $this->tmdbService->getNowPlayingMovies();
        $popularMovies = $this->tmdbService->getPopularMovies();
        $topRatedMovies = $this->tmdbService->getTopRatedMovies();

        // Pilih film pertama dari kategori populer sebagai hero
        $heroMovie = !empty($popularMovies) ? $popularMovies[0] : null;

        // Kirim data ke view
        return view('home', [
            'nowPlaying' => array_slice($nowPlayingMovies, 0, 4),
            'popular' => array_slice($popularMovies, 0, 4),
            'topRated' => array_slice($topRatedMovies, 0, 4),
            'heroMovie' => $heroMovie, // <-- Kirim data hero movie ke view
        ]);
    }
    /**
     * Menangani permintaan pencarian dan menampilkan hasilnya.
     */
    public function search(Request $request)
    {
        $query = $request->input('query');
        $movies = [];
        $heading = '';

        if ($query) {
            // Logika pencarian tetap sama, tidak perlu diubah
            $movies = $this->tmdbService->searchMovies($query);
            $heading = 'Hasil Pencarian untuk "' . e($query) . '"';
        } else {
            // Jika tidak ada query, kita ambil film populer
            $popularMovies = $this->tmdbService->getPopularMovies();

            // =============================================
            // PERUBAHAN DI SINI: Ambil hanya 8 film pertama dari hasil
            $movies = array_slice($popularMovies, 0, 8);
            // =============================================

            $heading = 'Film Terpopuler Saat Ini';
        }

        return view('movies.search', [
            'movies' => $movies,
            'query' => $query,
            'heading' => $heading,
        ]);
    }
    // TAMBAHKAN METHOD BARU DI BAWAH INI
    /**
     * Menambahkan film ke watchlist pengguna.
     */
    public function addToWatchlist(int $tmdbId)
    {
        // 1. Dapatkan user yang sedang login
        $user = Auth::user();

        /** @var \App\Models\User $user */ // <-- TAMBAHKAN PETUNJUK INI

        // 2. Cek apakah film sudah ada di database 'movies' kita
        $movie = Movie::firstWhere('tmdb_id', $tmdbId);

        // 3. Jika film belum ada di database kita...
        if (!$movie) {
            // Ambil detail lengkap film dari API menggunakan service kita
            $movieDetails = $this->tmdbService->getMovieDetails($tmdbId);

            // Simpan film baru ke tabel 'movies' kita
            $movie = Movie::create([
                'tmdb_id' => $movieDetails['id'],
                'title' => $movieDetails['title'],
                'overview' => $movieDetails['overview'],
                'poster_path' => $movieDetails['poster_path'],
                'release_date' => $movieDetails['release_date'],
            ]);
        }

        // 4. Hubungkan film dengan user di pivot table (movie_user)
        // syncWithoutDetaching akan menambahkan hubungan jika belum ada,
        // dan tidak melakukan apa-apa jika sudah ada (mencegah duplikat).
        $user->movies()->syncWithoutDetaching($movie->id);

        // 5. Kembalikan pengguna ke halaman sebelumnya dengan pesan sukses
        return back()->with('success', "{$movie->title} telah ditambahkan ke watchlist Anda!");
    }
    /**
     * Menampilkan semua film di watchlist pengguna.
     */
    public function watchlist()
    {
        // 1. Dapatkan user yang sedang login
        $user = Auth::user();
        /** @var \App\Models\User $user */

        // 2. Ambil semua film yang terhubung dengan user ini
        // Inilah keajaiban dari relasi Eloquent yang kita buat sebelumnya!
        // Kita juga urutkan berdasarkan yang paling baru ditambahkan.
        $watchlistMovies = $user->movies()->latest()->get();

        // 3. Kirim data film tersebut ke sebuah view baru
        return view('watchlist.index', [
            'movies' => $watchlistMovies
        ]);
    }
    /**
     * Menghapus film dari watchlist pengguna.
     *
     * @param \App\Models\Movie $movie
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removeFromWatchlist(Movie $movie)
    {
        // Penjelasan:
        // Perhatikan parameter methodnya adalah `Movie $movie`. Ini adalah fitur canggih
        // Laravel yang disebut "Route Model Binding". Laravel akan secara otomatis
        // mencari data film di database berdasarkan ID yang ada di URL, dan
        // langsung memberikannya kepada kita sebagai objek $movie. Sangat efisien!

        // 1. Dapatkan user yang sedang login
        $user = Auth::user();
        /** @var \App\Models\User $user */

        // 2. Lepaskan hubungan antara user dan film ini di pivot table
        // Method detach() adalah kebalikan dari attach/sync, ia akan menghapus
        // baris yang relevan di tabel `movie_user`.
        $user->movies()->detach($movie->id);

        // 3. Kembalikan pengguna ke halaman sebelumnya dengan pesan sukses
        return back()->with('success', "{$movie->title} telah dihapus dari watchlist Anda.");
    }

    public function show(int $tmdbId)
    {
        // Buat kunci cache yang unik untuk setiap film
        $cacheKey = "movie_details_{$tmdbId}";

        // Gunakan Cache::remember(). untuk optimasi
        $details = Cache::remember($cacheKey, 1440, function () use ($tmdbId) {
            return $this->tmdbService->getMovieDetails($tmdbId);
        });

        $user = Auth::user();
        /** @var \App\Models\User $user */

        $movieInWatchlist = null;
        $currentRating = null;

        if ($user) {
            $movieInWatchlist = $user->movies()->where('tmdb_id', $tmdbId)->first();
            if ($movieInWatchlist) {
                $currentRating = $movieInWatchlist->pivot->rating;
            }
        }
        // dd($currentRating);
        return view('movies.show', [
            'details' => $details,
            'movieInWatchlist' => $movieInWatchlist,
            'currentRating' => $currentRating,
        ]);
    }
    /**
     * Menyimpan atau mengupdate rating untuk sebuah film di watchlist.
     */
    public function rateMovie(Request $request, Movie $movie)
    {
        // 1. Validasi input, pastikan rating adalah angka antara 1-5
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
        ]);

        // 2. Dapatkan user yang sedang login
        $user = Auth::user();
        /** @var \App\Models\User $user */

        // 3. Gunakan method updateExistingPivot untuk mengupdate kolom 'rating'
        //    di tabel 'movie_user' untuk film dan user yang relevan.
        $user->movies()->updateExistingPivot($movie->id, [
            'rating' => $validated['rating'],
        ]);

        // 4. Kembalikan ke halaman sebelumnya dengan pesan sukses
        return back()->with('success', "Anda memberikan rating {$validated['rating']} untuk film {$movie->title}.");
    }
}
