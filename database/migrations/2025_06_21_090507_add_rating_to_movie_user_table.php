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
        Schema::table('movie_user', function (Blueprint $table) {
            // Menambahkan kolom rating
            // Tipe: tinyInteger (angka kecil, efisien untuk 1-5)
            // unsigned: Hanya angka positif
            // nullable: Boleh kosong, karena user bisa menambahkan ke watchlist tanpa langsung memberi rating
            // after: Ditempatkan setelah kolom 'movie_id' agar rapi (opsional)
            $table->tinyInteger('rating')->unsigned()->nullable()->after('movie_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('movie_user', function (Blueprint $table) {
            // Perintah untuk menghapus kolom 'rating'
            $table->dropColumn('rating');
        });
    }
};
