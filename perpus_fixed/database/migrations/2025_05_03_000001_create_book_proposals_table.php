<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('book_proposals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete(); // petugas yang mengajukan
            $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete();
            $table->string('title');
            $table->string('author');
            $table->string('publisher')->nullable();
            $table->year('publish_year')->nullable();
            $table->string('isbn')->nullable();
            $table->text('synopsis')->nullable();
            $table->text('reason'); // alasan pengajuan — wajib
            $table->string('cover')->nullable(); // path cover opsional
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->foreignId('reviewed_by')->nullable()->constrained('users')->nullOnDelete();
            $table->text('admin_note')->nullable(); // catatan saat approve/reject
            $table->timestamp('reviewed_at')->nullable();
            $table->timestamps();
        });

        // Tambah kolom is_active ke categories (jika belum ada)
        if (!Schema::hasColumn('categories', 'is_active')) {
            Schema::table('categories', function (Blueprint $table) {
                $table->boolean('is_active')->default(true)->after('icon');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('book_proposals');
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumnIfExists('is_active');
        });
    }
};
