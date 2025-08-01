<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    use HasFactory;

    protected $table = 'anggota';

    protected $fillable = [
        'ketua_id',
        'nama_anggota',
        'no_hp_anggota',
    ];

    public function ketua()
    {
        return $this->belongsTo(PesertaMagang::class, 'ketua_id');
    }
}
