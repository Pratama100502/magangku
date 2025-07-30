<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class PesertaMagang extends Authenticatable
{
    use Notifiable;

    protected $table = 'peserta_magang';

    protected $fillable = [
        'nama', 'email', 'password','asal_sekolah', 'jurusan', 'nim', 'no_hp', 'surat_permohonan', 'surat_project'
    ];

    protected $hidden = ['password'];
}
