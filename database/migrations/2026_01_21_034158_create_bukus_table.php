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
        Schema::create('bukus', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('penulis');
            $table->date('tahun_terbit');
            $table->string('isbn')->unique();
            $table->string('cover');    
            $table->unsignedInteger('stock_buku');
            $table->text('sinopsis');
            $table->string('penerbit');
            $table->foreignId('kategori_id')->nullable()->constrained('kategoris')->cascadeOnDelete();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bukus');
    }
};
