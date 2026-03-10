<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('albums', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->text('deskripsi')->nullable();
            $table->string('cover')->nullable();
            $table->timestamps();
        });

        Schema::create('album_gambar', function (Blueprint $table) {
            $table->id();
            $table->foreignId('album_id')->constrained('albums')->cascadeOnDelete();
            $table->foreignId('gambar_id')->constrained('gambar')->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['album_id', 'gambar_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('album_gambar');
        Schema::dropIfExists('albums');
    }
};
