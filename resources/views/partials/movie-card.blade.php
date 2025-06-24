<div class="bg-gray-800 rounded-lg overflow-hidden flex flex-col justify-between shadow-lg transform hover:-translate-y-2 transition-transform duration-300">
    {{-- Bagian Gambar dan Judul --}}
    <a href="{{ route('movies.show', ['tmdbId' => $movie['id']]) }}" class="flex-grow">
        @if($movie['poster_path'])
        <img src="https://image.tmdb.org/t/p/w500{{ $movie['poster_path'] }}" alt="Poster {{ $movie['title'] }}" class="w-full h-auto object-cover">
        @else
        <img src="https://via.placeholder.com/500x750?text={{ urlencode($movie['title']) }}" alt="Poster {{ $movie['title'] }}" class="w-full h-auto object-cover">
        @endif
        <div class="p-4">
            <h3 class="font-bold text-lg text-white truncate" title="{{ $movie['title'] }}">{{ $movie['title'] }}</h3>
            <p class="text-sm text-gray-400 mb-2">Rilis: {{ isset($movie['release_date']) && $movie['release_date'] ? \Carbon\Carbon::parse($movie['release_date'])->format('d M Y') : 'N/A' }}</p>

            {{-- Menambahkan Overview --}}
            <p class="text-sm text-gray-300 leading-relaxed">
                {{ Str::limit($movie['overview'], 100) }}
            </p>
        </div>
    </a>

    {{-- Bagian Tombol Watchlist --}}
    <div class="p-4 pt-0">
        <form method="POST" action="{{ route('watchlist.add', $movie['id']) }}">
            @csrf
            <button type="submit" class="w-full px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-md text-sm font-semibold transition-colors">
                Add to Watchlist
            </button>
        </form>
    </div>
</div>