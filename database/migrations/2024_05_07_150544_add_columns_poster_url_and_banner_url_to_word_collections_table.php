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
        Schema::table('word_collections', function (Blueprint $table) {
            $table->string('poster_url')->nullable()->after('name')->default('https://images-cdn.ubuy.co.in/633ff1157e3fbc25557517c8-one-piece-poster-japanese-anime-posters.jpg');
            $table->string('banner_url')->nullable()->after('poster_url')->default('https://i.pinimg.com/736x/00/a7/81/00a781cc93f26bc0b753e18b240673e2.jpg');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('word_collections', function (Blueprint $table) {
            $table->dropColumn('banner_url');
            $table->dropColumn('poster_url');
        });
    }
};
