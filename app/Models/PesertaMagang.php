<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class PesertaMagang extends Authenticatable
{
    use Notifiable;

    protected $table = 'peserta_magang';

    protected $fillable = [
        'nama',
        'email',
        'password',
        'asal_sekolah',
        'jurusan',
        'nim',
        'no_hp',
        'surat_permohonan',
        'surat_project',

        //update
        'status',
        'catatan',
        'mentor_id',
        'tanggal_mulai',
        'tanggal_selesai'
    ];

    protected $hidden = ['password'];

    public function mentor()
    {
        return $this->belongsTo(MentorModel::class);
    }

    public function anggota()
    {
        return $this->hasMany(Anggota::class, 'ketua_id');
    }
}
