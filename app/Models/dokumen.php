<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dokumen extends Model
{
    use HasFactory;
    protected $table = 'anggota';

    protected $fillable = [
                'permohonan_magang',
                'proposal_proyek',
                'laporan_bulan_1',
                'laporan_bulan_2',
                'laporan_bulan_3',
                'laporan_bulan_4',
                'laporan_bulan_5',
                'laporan_bulan_akhir',
                'lainnya',
    ];

    public function ketua()
    {
        return $this->belongsTo(PesertaMagang::class, 'ketua_id');
    }
}
