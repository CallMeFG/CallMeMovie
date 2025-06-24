# MovieLog 🎬

**MovieLog** adalah aplikasi web yang dirancang untuk para pencinta film. Pengguna dapat menemukan, melacak, dan memberikan rating pada film-film favorit mereka. Proyek ini dibangun sebagai portofolio untuk menunjukkan kemampuan pengembangan web full-stack, dari backend yang kuat hingga antarmuka pengguna yang responsif.

![Screenshot Halaman Utama MovieLog](https://via.placeholder.com/1200x600.png?text=Ganti+dengan+Screenshot+Proyek+Anda)
*(Ganti gambar placeholder di atas dengan screenshot aplikasi Anda)*

---

## Daftar Fitur

* **Autentikasi Pengguna:** Sistem registrasi dan login yang aman menggunakan Laravel Breeze.
* **Halaman Utama Dinamis:** Menampilkan kategori film seperti "Sedang Tayang", "Populer", dan "Rating Tertinggi" yang diambil langsung dari API TMDB.
* **Hero Section Menarik:** Header halaman utama yang dinamis dengan latar belakang gambar film yang berubah-ubah.
* **Pencarian Film:** Fungsionalitas pencarian real-time untuk menemukan film berdasarkan judul.
* **Halaman Detail Film:** Halaman detail yang kaya informasi, menampilkan poster, sinopsis, genre, durasi, dan rating publik (dengan visualisasi bintang).
* **Watchlist Pribadi:** Pengguna dapat menambahkan dan menghapus film dari watchlist pribadi mereka.
* **Sistem Rating Pribadi:** Pengguna dapat memberikan rating (1-5 bintang) pada film yang ada di watchlist mereka.
* **Dashboard Pengguna:** Halaman dashboard dengan sistem Tab modern (menggunakan Alpine.js) untuk melihat informasi dan mengelola profil (update nama, email, dan password).
* **Desain Responsif:** Tampilan yang dapat beradaptasi dengan baik di berbagai ukuran layar, dari desktop hingga mobile.
* **Optimalisasi Performa:** Implementasi *caching* pada panggilan API untuk mengurangi waktu muat halaman secara drastis.

## Teknologi yang Digunakan

* **Backend:** Laravel, PHP
* **Frontend:** Blade, Tailwind CSS, Alpine.js
* **Database:** MySQL
* **API Eksternal:** The Movie Database (TMDb) API
* **Development Environment:** Laragon

## Panduan Instalasi

Untuk menjalankan proyek ini secara lokal, ikuti langkah-langkah berikut:

1.  **Clone repository ini.**
    ```bash
    git clone [https://github.com/CallMeFG/myproject-website.git](https://github.com/CallMeFG/myproject-website.git)
    cd myproject-website
    ```

2.  **Install dependensi Composer.**
    ```bash
    composer install
    ```

3.  **Install dependensi NPM.**
    ```bash
    npm install
    ```

4.  **Siapkan file environment.**
    Salin file `.env.example` menjadi `.env`.
    ```bash
    copy .env.example .env
    ```

5.  **Generate kunci aplikasi.**
    ```bash
    php artisan key:generate
    ```

6.  **Konfigurasi `.env`**
    Buka file `.env` dan atur koneksi database Anda (DB\_HOST, DB\_PORT, DB\_DATABASE, DB\_USERNAME, DB\_PASSWORD). Lalu, tambahkan kunci API dari TMDB Anda.
    ```env
    APP_NAME=MovieLog
    APP_URL=[http://127.0.0.1:8000](http://127.0.0.1:8000)

    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=movielog
    DB_USERNAME=root
    DB_PASSWORD=

    TMDB_API_KEY=MASUKKAN_KUNCI_API_TMDB_ANDA_DI_SINI
    ```

7.  **Konfigurasi `services.php`**
    Buka `config/services.php` dan pastikan Anda memiliki konfigurasi untuk `tmdb`.
    ```php
    'tmdb' => [
        'key' => env('TMDB_API_KEY'),
        'url' => '[https://api.themoviedb.org/3](https://api.themoviedb.org/3)',
    ],
    ```

8.  **Jalankan migrasi database.**
    ```bash
    php artisan migrate
    ```

9.  **Build aset frontend.**
    ```bash
    npm run dev
    ```

10. **Jalankan server development.**
    ```bash
    php artisan serve
    ```
    Aplikasi sekarang akan berjalan di `http://127.0.0.1:8000`.

## Acknowledgements
* Data film dan gambar disediakan oleh [The Movie Database (TMDb)](https://www.themoviedb.org/).
* Proyek ini dibangun di atas framework [Laravel](https://laravel.com/).

---
Dibuat dengan ❤️ oleh **Fathur Rizky Assani**
* **GitHub:** [@CallMeFG](https://github.com/CallMeFG/)
* **LinkedIn:** [Fathur Rizky Assani](https://www.linkedin.com/in/fathur-rizky-assani)