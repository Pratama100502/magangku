<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dokumen extends Model
{
    use HasFactory;
    protected $table = 'dokumen';

    protected $fillable = [
                'peserta_id',
                'jenis_dokumen',
                'file_path',
    ];

    public function peserta()
    {
        return $this->belongsTo(PesertaMagang::class, 'peserta_id');
    }
}
