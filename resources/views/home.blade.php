<x-app-layout>
    <x-slot name="title">
        Home
    </x-slot>
    @if($heroMovie)
    <section class="h-[50vh] sm:h-[60vh] relative flex items-center justify-center text-white text-center bg-cover bg-center" style="background-image: url('https://image.tmdb.org/t/p/original{{ $heroMovie['backdrop_path'] }}')">
        {{-- Overlay Gelap untuk Keterbacaan Teks --}}
        <div class="absolute inset-0 bg-black opacity-60"></div>
        {{-- Konten Teks Hero yang Sudah Diubah --}}
        <div class="relative z-10 p-8">
            <h1 class="text-4xl sm:text-6xl font-bold drop-shadow-lg">Selamat Datang di CallMeMovie</h1>
            <p class="mt-4 text-lg max-w-2xl mx-auto drop-shadow-lg">Temukan, lacak, dan diskusikan film favorit Anda dari seluruh dunia.</p>
            <a href="{{ route('movies.search') }}" class="mt-8 inline-block px-8 py-3 bg-blue-600 hover:bg-blue-700 rounded-lg font-semibold text-lg transition-colors">
                Cari Film Sekarang
            </a>
        </div>
    </section>
    @endif
    {{-- SISA KONTEN TETAP DI DALAM CONTAINER AGAR RAPI DI TENGAH --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <section class="mb-12">
                <h3 class="text-3xl font-bold mb-8 text-gray-800 dark:text-gray-200">Sedang Tayang</h3>
                @if(!empty($nowPlaying))
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                    @foreach ($nowPlaying as $movie)
                    @include('partials.movie-card', ['movie' => $movie])
                    @endforeach
                </div>
                @else
                <p class="text-gray-500">Tidak ada film yang sedang tayang saat ini.</p>
                @endif
            </section>

            <section class="mb-12">
                <h3 class="text-3xl font-bold mb-8 text-gray-800 dark:text-gray-200">Film Populer</h3>
                @if(!empty($popular))
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                    @foreach ($popular as $movie)
                    @include('partials.movie-card', ['movie' => $movie])
                    @endforeach
                </div>
                @else
                <p class="text-gray-500">Tidak ada film populer yang bisa ditampilkan.</p>
                @endif
            </section>

            <section>
                <h3 class="text-3xl font-bold mb-8 text-gray-800 dark:text-gray-200">Rating Tertinggi</h3>
                @if(!empty($topRated))
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                    @foreach ($topRated as $movie)
                    @include('partials.movie-card', ['movie' => $movie])
                    @endforeach
                </div>
                @else
                <p class="text-gray-500">Tidak ada film dengan rating tinggi yang bisa ditampilkan.</p>
                @endif
            </section>

        </div>
    </div>
</x-app-layout>