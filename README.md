# MovieLog - Movie Tracking & Discovery App

<p align="center">
  <a href="#">
    <img src="public/images/logo-letter-c.png" alt="MovieLog Logo" width="120" height="120">
  </a>
</p>

<p align="center">
  A comprehensive movie tracking web application built with Laravel 12, Tailwind CSS, and the TMDb API.
</p>

<p align="center">
    <img src="https://img.shields.io/badge/Laravel-12-FF2D20?style=for-the-badge&logo=laravel" alt="Laravel">
    <img src="https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php" alt="PHP">
    <img src="https://img.shields.io/badge/MySQL-8.0-4479A1?style=for-the-badge&logo=mysql" alt="MySQL">
    <img src="https://img.shields.io/badge/Tailwind_CSS-3-06B6D4?style=for-the-badge&logo=tailwindcss" alt="Tailwind CSS">
    <img src="https://img.shields.io/badge/Alpine.js-3-06B6D4?style=for-the-badge&logo=alpinedotjs" alt="Alpine.js">
    <img src="https://img.shields.io/badge/License-MIT-yellow.svg" alt="License: MIT">
</p>

---

## 📖 Daftar Isi

* [Tentang Proyek](#-tentang-proyek)
* [Fitur Utama](#-fitur-utama)
* [Teknologi](#️-teknologi-yang-digunakan)
* [Panduan Instalasi](#️-panduan-instalasi)
* [Konfigurasi](#-konfigurasi)
* [Acknowledgements](#-acknowledgements)
* [Kontak](#-kontak)

---

## 🚀 Tentang Proyek

**MovieLog** adalah aplikasi web yang dirancang untuk para pencinta film. Pengguna dapat menemukan, melacak, dan memberikan rating pada film-film favorit mereka. Proyek ini dibangun sebagai portofolio untuk menunjukkan kemampuan pengembangan web full-stack, dari backend yang kuat hingga antarmuka pengguna yang responsif, dengan integrasi data real-time dari The Movie Database (TMDb) API.

![Screenshot Halaman Utama MovieLog](https://via.placeholder.com/1200x600.png?text=Ganti+dengan+Screenshot+Proyek+Anda)
*(Ganti gambar placeholder di atas dengan screenshot aplikasi Anda)*

---

## ✨ Fitur Utama

- **Autentikasi Pengguna:** Sistem registrasi dan login yang aman menggunakan Laravel Breeze.
- **Halaman Utama Dinamis:** Menampilkan kategori film seperti "Sedang Tayang", "Populer", dan "Rating Tertinggi".
- **Hero Section Menarik:** Header halaman utama yang dinamis dengan latar belakang gambar film yang berubah-ubah.
- **Pencarian Film:** Fungsionalitas pencarian real-time untuk menemukan film berdasarkan judul.
- **Halaman Detail Film:** Halaman detail yang kaya informasi, menampilkan poster, sinopsis, genre, durasi, dan rating publik dengan visualisasi bintang.
- **Watchlist Pribadi:** Pengguna dapat menambahkan dan menghapus film dari watchlist pribadi mereka.
- **Sistem Rating Pribadi:** Pengguna dapat memberikan rating (1-5 bintang) pada film yang ada di watchlist mereka.
- **Dashboard Pengguna:** Halaman dashboard dengan sistem Tab modern (menggunakan Alpine.js) untuk mengelola profil.
- **Desain Responsif:** Tampilan yang dapat beradaptasi dengan baik di berbagai ukuran layar.
- **Optimalisasi Performa:** Implementasi *caching* pada panggilan API untuk mengurangi waktu muat halaman secara drastis.

---

## 🛠️ Teknologi yang Digunakan

* **Backend:** Laravel, PHP
* **Frontend:** Blade, Tailwind CSS, Alpine.js
* **Database:** MySQL
* **API Eksternal:** The Movie Database (TMDb) API
* **Development Environment:** Laragon

---

## ⚙️ Panduan Instalasi

Untuk menjalankan proyek ini secara lokal, ikuti langkah-langkah berikut:

#### Prasyarat
Pastikan Anda memiliki PHP, Composer, dan Node.js terpasang di sistem Anda.

#### Instalasi
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
    Buka file `.env` dan atur koneksi database Anda (DB\_DATABASE, DB\_USERNAME, dll). Lalu, tambahkan kunci API dari TMDB Anda.
    ```env
    APP_NAME=MovieLog
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

---

## 🙏 Acknowledgements
* Data film dan gambar disediakan oleh [The Movie Database (TMDb)](https://www.themoviedb.org/).
* Proyek ini dibangun di atas framework [Laravel](https://laravel.com/).

---

## 📬 Kontak
**Fathur Rizky Assani**
* **GitHub:** [@CallMeFG](https://github.com/CallMeFG/)
* **LinkedIn:** [Fathur Rizky Assani](https://www.linkedin.com/in/fathur-rizky-assani)