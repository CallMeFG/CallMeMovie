<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class TmdbService
{
    protected string $apiKey;
    protected string $apiUrl;

    public function __construct()
    {
        $this->apiKey = config('services.tmdb.key');
        $this->apiUrl = config('services.tmdb.url');
    }

    public function getNowPlayingMovies(): array
    {
        return Cache::remember('now_playing_movies', 60, function () {
            $response = Http::get("{$this->apiUrl}/movie/now_playing", [
                'api_key' => $this->apiKey,
                // 'language' => 'id-ID', // DIHAPUS
                'page' => 1
            ]);
            return $response->json()['results'] ?? [];
        });
    }

    public function searchMovies(string $query): array
    {
        $response = Http::get("{$this->apiUrl}/search/movie", [
            'api_key' => $this->apiKey,
            'query' => $query,
        ]);
        return $response->json()['results'] ?? [];
    }

    public function getMovieDetails(int $movieId): array
    {
        return Cache::remember('movie_details_' . $movieId, 1440, function () use ($movieId) {
            $response = Http::get("{$this->apiUrl}/movie/{$movieId}", [
                'api_key' => $this->apiKey,
                // 'language' => 'id-ID', // DIHAPUS
            ]);

            return $response->json();
        });
    }

    public function getPopularMovies(): array
    {
        return Cache::remember('popular_movies', 60, function () {
            $response = Http::get("{$this->apiUrl}/movie/popular", [
                'api_key' => $this->apiKey,
                // 'language' => 'id-ID', // DIHAPUS
                'page' => 1,
            ]);
            return $response->json()['results'] ?? [];
        });
    }

    public function getTopRatedMovies(): array
    {
        return Cache::remember('top_rated_movies', 60, function () {
            $response = Http::get("{$this->apiUrl}/movie/top_rated", [
                'api_key' => $this->apiKey,
                // 'language' => 'id-ID', // DIHAPUS
                'page' => 1,
            ]);
            return $response->json()['results'] ?? [];
        });
    }
}
