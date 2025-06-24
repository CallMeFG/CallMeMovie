<x-app-layout>
    <x-slot name="title">
        WatchList
    </x-slot>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('My Watchlist') }}
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

                    <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                        @forelse ($movies as $movie)
                        <div class="bg-gray-700 rounded-lg overflow-hidden flex flex-col justify-between shadow-lg">
                            <a href="{{ route('movies.show', ['tmdbId' => $movie->tmdb_id]) }}" class="hover:opacity-80 transition-opacity duration-200 flex-grow">
                                <img src="{{ $movie->poster_path ? 'https://image.tmdb.org/t/p/w500' . $movie->poster_path : 'https://via.placeholder.com/500x750?text=No+Image' }}" alt="Poster {{ $movie->title }}" class="w-full h-auto object-cover">
                                <div class="p-4 bg-gray-800">
                                    <h3 class="font-bold text-lg text-white truncate">{{ $movie->title }}</h3>
                                    <p class="text-sm text-gray-300">Rilis: {{ $movie->release_date ? \Carbon\Carbon::parse($movie->release_date)->format('d M Y') : 'N/A' }}</p>
                                    <p class="mt-2 text-sm text-gray-400 h-20 overflow-hidden">{{ $movie->overview }}</p>
                                </div>
                            </a>

                            <div class="p-4 pt-2 bg-gray-800">
                                <form method="POST" action="{{ route('watchlist.remove', $movie) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-full px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-md text-sm font-semibold transition-colors duration-200">
                                        Remove
                                    </button>
                                </form>
                            </div>
                        </div>
                        @empty
                        <p class="col-span-full text-center text-gray-400">Watchlist Anda masih kosong. Mulai tambahkan film dari halaman pencarian!</p>
                        @endforelse
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>