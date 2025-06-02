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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('merek');
            $table->string('nama');
            $table->enum('transmisi', ['manual', 'automatic']);
            $table->enum('bahan_bakar', ['bensin', 'diesel', 'listrik']);
            $table->year('tahun');
            $table->decimal('harga', 15, 2);
            $table->enum('status', ['tersedia', 'terjual'])->default('tersedia');
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
