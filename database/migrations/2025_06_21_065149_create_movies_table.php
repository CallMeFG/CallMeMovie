<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->id(); // Kolom Primary Key (ID unik untuk setiap baris)

            // Kolom untuk menyimpan ID dari TMDB API.
            // Ini akan menjadi penghubung utama kita ke data API.
            // Harus unik, karena kita tidak ingin ada film duplikat di database kita.
            $table->unsignedBigInteger('tmdb_id')->unique();

            // Kolom untuk judul film.
            $table->string('title');

            // Kolom untuk sinopsis/overview. Menggunakan TEXT karena bisa sangat panjang.
            $table->text('overview')->nullable();

            // Kolom untuk menyimpan path poster. Contoh: /pB8BM7pdSp6B6Ih7QZ4DrQ3PmJK.jpg
            // Kita buat nullable() karena mungkin ada film yang tidak punya poster.
            $table->string('poster_path')->nullable();

            // Kolom untuk tanggal rilis.
            // Kita buat nullable() untuk berjaga-jaga jika data dari API kosong.
            $table->date('release_date')->nullable();

            $table->timestamps(); // Kolom created_at dan updated_at (otomatis oleh Laravel)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};
