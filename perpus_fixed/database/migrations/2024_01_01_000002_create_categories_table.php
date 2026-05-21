<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * FIX: Kolom is_active ditambahkan langsung di sini (schema asli).
 * Sebelumnya, is_active ditambahkan secara kondisional di dalam migration
 * book_proposals (2025_05_03_000001) — ini anti-pattern yang rawan error
 * dan membuat schema tidak terbaca secara linear.
 */
return new class extends Migration {
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('icon')->nullable();
            $table->boolean('is_active')->default(true); // FIX: dipindahkan ke sini dari migration book_proposals
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
