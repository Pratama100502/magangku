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
        Schema::create('peserta_magang', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->enum('role', ['admin','peserta'])->default('peserta');
            $table->string('nim')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('no_hp')->nullable();
            $table->string('asal_sekolah')->nullable();
            $table->string('jurusan')->nullable();
            $table->enum('status', ['mengajukan', 'diterima', 'diterima_dan_loa_dapat_di_ambil', 'aktif', 'selesai', 'ditolak'])->default('mengajukan');
            $table->string('catatan')->nullable();
            $table->foreignId(column: 'mentor_id')->nullable()->constrained('mentor')->onDelete('cascade');

            //update
            $table->date('tanggal_mulai')->nullable();
            $table->date('tanggal_selesai')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peserta_magang');
    }
};
