<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * FIX: Kolom user_note sudah ada di migration awal borrowings (2024_01_01_000004).
 * Migration ini redundan dan akan crash dengan "Column already exists" pada fresh install.
 * Solusi: tambahkan pengecekan hasColumn() agar idempotent — aman dijalankan
 * di environment lama (kolom belum ada) maupun baru (kolom sudah ada).
 */
return new class extends Migration {
    public function up(): void
    {
        if (!Schema::hasColumn('borrowings', 'user_note')) {
            Schema::table('borrowings', function (Blueprint $table) {
                $table->text('user_note')->nullable()->after('admin_note');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('borrowings', 'user_note')) {
            Schema::table('borrowings', function (Blueprint $table) {
                $table->dropColumn('user_note');
            });
        }
    }
};
