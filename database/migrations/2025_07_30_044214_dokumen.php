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
        Schema::create('dokumen', function (Blueprint $table) {
            $table->id();
            $table->foreignId(column: 'peserta_id')->nullable()->constrained('peserta_magang')->onDelete('cascade');
            $table->enum('jenis_dokumen', [
                'permohonan_magang',
                'proposal_proyek',
                'laporan_bulan_1',
                'laporan_bulan_2',
                'laporan_bulan_3',
                'laporan_bulan_4',
                'laporan_bulan_5',
                'laporan_bulan_akhir',
                'lainnya'
            ])->default('lainnya');
                        $table->string('file_path')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokumen');
    }
};
