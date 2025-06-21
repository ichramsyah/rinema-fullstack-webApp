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
        Schema::create('films', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('produser')->nullable();
            $table->string('sutradara')->nullable();
            $table->string('penulis')->nullable();
            $table->string('produksi')->nullable();
            $table->text('pemeran')->nullable();
            $table->date('tahun_rilis')->nullable(); 
            $table->unsignedInteger('durasi')->nullable();
            $table->string('usia')->nullable();
            $table->string('poster')->nullable();
            $table->string('trailer')->nullable();
            $table->text('sinopsis')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('films');
    }
};
