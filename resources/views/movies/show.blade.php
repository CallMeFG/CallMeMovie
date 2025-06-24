<x-app-layout>
    <x-slot name="title">
        {{ $details['title'] }}
    </x-slot>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $details['title'] ?? 'Movie Details' }}
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
                <div class="p-6 md:p-8 flex flex-col md:flex-row gap-8">

                    <div class="w-full md:w-1/3 flex-shrink-0">
                        <img src="{{ isset($details['poster_path']) ? 'https://image.tmdb.org/t/p/w500' . $details['poster_path'] : 'https://via.placeholder.com/500x750?text=No+Image' }}" alt="Poster {{ $details['title'] ?? '' }}" class="w-full h-auto rounded-lg shadow-lg">
                    </div>

                    <div class="w-full md:w-2/3">
                        <h1 class="text-4xl font-bold text-gray-900 dark:text-gray-100">{{ $details['title'] ?? 'Judul Tidak Tersedia' }}</h1>
                        {{-- =================== BLOK RATING TMDB (AWAL) =================== --}}
                        <div class="flex items-center mt-4">
                            @if (isset($details['vote_average']) && $details['vote_average'] > 0)
                            @php
                            // Rating dari TMDB adalah per 10, kita ubah ke per 5 untuk bintang
                            $rating = round($details['vote_average'] / 2, 1);
                            $fullStars = floor($rating);
                            $halfStar = ($rating - $fullStars) >= 0.5;
                            $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0);
                            @endphp

                            {{-- Menampilkan Bintang --}}
                            <div class="flex items-center text-yellow-400" title="Rating: {{ number_format($details['vote_average'], 1) }}/10">
                                @for ($i = 0; $i < $fullStars; $i++)
                                    <i class="fas fa-star"></i>
                                    @endfor

                                    @if ($halfStar)
                                    <i class="fas fa-star-half-alt"></i>
                                    @endif

                                    @for ($i = 0; $i < $emptyStars; $i++)
                                        <i class="far fa-star"></i>
                                        @endfor
                            </div>

                            {{-- Menampilkan Teks Rating --}}
                            <span class="ml-3 text-gray-600 dark:text-gray-300 font-semibold">
                                {{ number_format($details['vote_average'], 1) }}
                                <span class="text-sm text-gray-500 dark:text-gray-400 font-normal">/ 10</span>
                            </span>
                            <span class="ml-4 text-sm text-gray-500 dark:text-gray-400">
                                ({{ number_format($details['vote_count']) }} suara)
                            </span>
                            @else
                            <span class="text-gray-500 dark:text-gray-400">Belum ada rating.</span>
                            @endif
                        </div>
                        {{-- =================== BLOK RATING TMDB (AKHIR) =================== --}}
                        <div class="flex items-center text-sm text-gray-500 dark:text-gray-400 mt-2 mb-4">
                            <span>{{ (isset($details['release_date']) && $details['release_date']) ? \Carbon\Carbon::parse($details['release_date'])->format('Y') : 'N/A' }}</span>
                            @if (isset($details['runtime']) && $details['runtime'] > 0)
                            <span class="mx-2">|</span>
                            <span>{{ floor($details['runtime'] / 60) }}j {{ $details['runtime'] % 60 }}m</span>
                            @endif
                        </div>

                        <div class="flex flex-wrap gap-2 mb-6">
                            @if (!empty($details['genres']))
                            @foreach ($details['genres'] as $genre)
                            <span class="px-2 py-1 bg-gray-600 dark:bg-gray-700 text-white dark:text-gray-200 rounded-full text-xs font-semibold">{{ $genre['name'] }}</span>
                            @endforeach
                            @endif
                        </div>

                        <h3 class="text-xl font-semibold mb-2 text-gray-900 dark:text-gray-100">Overview</h3>
                        <p class="text-gray-600 dark:text-gray-300 leading-relaxed">{{ $details['overview'] ?? 'Overview tidak tersedia.' }}</p>

                        <div class="mt-8">
                            <h3 class="text-xl font-semibold mb-2 text-gray-900 dark:text-gray-100">Rating Anda</h3>

                            @if ($movieInWatchlist)
                            <form method="POST" action="{{ route('movies.rate', $movieInWatchlist) }}">
                                @csrf
                                <div class="flex items-center gap-4">
                                    <select name="rating" class="border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                        <option value="">-- Beri Rating --</option>
                                        @for ($i = 1; $i <= 5; $i++)
                                            <option value="{{ $i }}" {{ $currentRating == $i ? 'selected' : '' }}>
                                            {{ $i }} Bintang
                                            </option>
                                            @endfor
                                    </select>
                                    <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md text-sm font-semibold">Simpan</button>
                                </div>
                                @if ($currentRating)
                                <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">Rating Anda saat ini: {{ $currentRating }} Bintang.</p>
                                @endif
                            </form>
                            @else
                            <p class="text-gray-500 dark:text-gray-400">Tambahkan film ini ke watchlist Anda untuk memberikan rating.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>