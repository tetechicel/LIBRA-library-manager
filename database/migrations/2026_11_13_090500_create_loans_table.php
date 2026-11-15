<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->id(); // ID Peminjaman
            $table->foreignId('member_id')->constrained('members')->cascadeOnDelete(); // Anggota
            $table->foreignId('book_id')->constrained('books')->cascadeOnDelete(); // Buku
            $table->date('loan_date'); // Tanggal Pinjam
            $table->date('due_date'); // Tanggal Jatuh Tempo
            $table->date('return_date')->nullable(); // Tanggal Kembali
            $table->enum('status', ['dipinjam', 'dikembalikan', 'terlambat'])->default('dipinjam'); // Status
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};