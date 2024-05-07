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
        Schema::create('word_collections', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('text_id');
            $table->timestamps();

            $table->foreign('text_id')->references('id')->on('texts');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('word_collections');
    }
};
