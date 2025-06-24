{{-- Kode Footer yang Sudah Disesuaikan untuk MovieLog --}}
<footer class="bg-gray-200 dark:bg-gray-900 text-black dark:text-white border-t border-gray-700">
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">

            {{-- Kolom Logo dan Deskripsi --}}
            <div class="mb-6 md:mb-0">
                <a href="{{ route('home') }}" class="flex items-center">
                    {{-- Logo MovieLog Anda --}}
                    <img src="{{ asset('images/logo-letter-c.png') }}" alt="MovieLog Logo" class="h-10 w-auto">
                    <span class="ml-3 text-xl font-bold">CallMeMovie</span>
                </a>
                <p class="mt-4 text-sm dark:text-gray-400">
                    Temukan, lacak, dan diskusikan film favorit Anda dari seluruh dunia.
                </p>
            </div>

            {{-- Kolom Navigasi --}}
            <div>
                <h3 class="text-sm font-semibold dark:text-gray-400 tracking-wider uppercase">Navigasi</h3>
                <ul class="mt-4 space-y-2">
                    <li><a href="{{ route('home') }}" class="text-base dark:text-gray-300 hover:text-blue-500 dark:hover:text-white">Home</a></li>
                    <li><a href="{{ route('movies.search') }}" class="text-base dark:text-gray-300 hover:text-blue-500 dark:hover:text-white">Cari Film</a></li>
                    {{-- Tampilkan link ini hanya jika user sudah login --}}
                    @auth
                    <li><a href="{{ route('watchlist.index') }}" class="text-base dark:text-gray-300 hover:text-blue-500 dark:hover:text-white">My Watchlist</a></li>
                    <li><a href="{{ route('dashboard') }}" class="text-base dark:text-gray-300 hover:text-blue-500 dark:hover:text-white">Dashboard</a></li>
                    @endauth
                </ul>
            </div>

            {{-- Kolom Hubungi Kami --}}
            <div>
                <h3 class="text-sm font-semibold dark:text-gray-400 tracking-wider uppercase">Hubungi Kami</h3>
                <ul class="mt-4 space-y-2 text-sm dark:text-gray-300">
                    <li class="flex items-start">
                        <i class="fas fa-map-marker-alt fa-fw mt-1 mr-2"></i>
                        <span>Pekanbaru, Riau, Indonesia</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-envelope fa-fw mt-1 mr-2"></i>
                        <span>callmestartofficial19@gmail.com</span>
                    </li>
                </ul>
            </div>

            {{-- Kolom Ikuti Kami --}}
            <div>
                <h3 class="text-sm font-semibold dark:text-gray-400 tracking-wider uppercase">Ikuti Saya</h3>
                <div class="flex mt-4 space-x-6">
                    <a target="_blank" href="https://www.linkedin.com/in/fathur-rizky-assani" class="dark:text-gray-400 hover:text-blue-500 dark:hover:text-white" aria-label="LinkedIn">
                        <i class="fab fa-linkedin fa-lg"></i>
                    </a>
                    <a target="_blank" href="https://www.instagram.com/rzky.sn_/" class="dark:text-gray-400 hover:text-blue-500 dark:hover:text-white" aria-label="Instagram">
                        <i class="fab fa-instagram fa-lg"></i>
                    </a>
                    <a target="_blank" href="https://x.com/RizkyAs_Dev" class="dark:text-gray-400 hover:text-blue-500 dark:hover:text-white" aria-label="X (Twitter)">
                        <i class="fab fa-x-twitter fa-lg"></i>
                    </a>
                    <a target="_blank" href="https://github.com/CallMeFG/" class="dark:text-gray-400 hover:text-blue-500 dark:hover:text-white" aria-label="GitHub">
                        <i class="fab fa-github fa-lg"></i>
                    </a>
                </div>
            </div>

        </div>

        <div class="mt-8 border-t border-gray-700 pt-8 text-center">
            <p class="text-base text-gray-400">&copy; {{ date('Y') }} CallMeMovie. Dibuat oleh Fathur Rizky Assani.</p>
        </div>
    </div>
</footer>