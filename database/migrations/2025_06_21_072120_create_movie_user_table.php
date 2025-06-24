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
        Schema::create('movie_user', function (Blueprint $table) {
            // Menghubungkan ke tabel users
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Menghubungkan ke tabel movies
            $table->foreignId('movie_id')->constrained()->onDelete('cascade');

            // Menjadikan kombinasi user_id dan movie_id sebagai primary key.
            // Ini untuk memastikan seorang user tidak bisa menambahkan film yang sama
            // ke watchlist-nya lebih dari sekali.
            $table->primary(['user_id', 'movie_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movie_user');
    }
};
