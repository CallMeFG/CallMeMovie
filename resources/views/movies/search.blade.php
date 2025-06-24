<x-app-layout>
    <x-slot name="title">
        Search
    </x-slot>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Cari Film') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
            <div class="mb-4 p-4 bg-green-500 text-white rounded-lg shadow-lg">
                {{ session('success') }}
            </div>
            @endif
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <form method="GET" action="{{ route('movies.search') }}">
                        <div class="flex items-center">
                            <input type="text" name="query" placeholder="Cari judul film..."
                                class="w-full rounded-md dark:bg-gray-900" value="{{ $query ?? '' }}">
                            <button type="submit" class="ml-4 px-4 py-2 bg-blue-500 text-white rounded-md">Cari</button>
                        </div>
                    </form>

                    <h3 class="text-2xl font-bold mt-8 mb-6 text-gray-800 dark:text-gray-200">{{ $heading }}</h3>
                    <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">

                        @forelse ($movies as $movie)
                        <div class="bg-gray-700 rounded-lg overflow-hidden flex flex-col justify-between shadow-lg">
                            <a href="{{ route('movies.show', ['tmdbId' => $movie['id']]) }}" class="hover:opacity-80 transition-opacity duration-200 flex-grow">
                                <img src="{{ $movie['poster_path'] ? 'https://image.tmdb.org/t/p/w500' . $movie['poster_path'] : 'https://via.placeholder.com/500x750?text=No+Image' }}" alt="Poster {{ $movie['title'] }}" class="w-full h-auto object-cover">
                                <div class="p-4 bg-gray-800">
                                    <h3 class="font-bold text-lg text-white truncate">{{ $movie['title'] }}</h3>
                                    <p class="text-sm text-gray-300">Rilis: {{ $movie['release_date'] ? \Carbon\Carbon::parse($movie['release_date'])->format('d M Y') : 'N/A' }}</p>
                                    <p class="mt-2 text-sm text-gray-400 h-20 overflow-hidden">{{ $movie['overview'] }}</p>
                                </div>
                            </a>

                            <div class="p-4 pt-2 bg-gray-800">
                                <form method="POST" action="{{ route('watchlist.add', ['tmdbId' => $movie['id']]) }}">
                                    @csrf
                                    <button type="submit" class="w-full px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-md text-sm font-semibold transition-colors duration-200">
                                        Add to Watchlist
                                    </button>
                                </form>
                            </div>
                        </div>
                        @empty
                        <p class="col-span-full text-center text-gray-400">Tidak ada hasil yang cocok dengan kriteria Anda.</p>
                        @endforelse
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>