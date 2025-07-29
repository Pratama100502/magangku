<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Atribut yang boleh diisi (mass assignable).
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'asal_kampus',
        'jurusan',
        'nim',
        'no_hp',
        'keahlian',
        'anggota',
        'no_anggota',
        'surat_permohonan',
        'surat_project',
    ];

    /**
     * Atribut yang disembunyikan dari array/JSON.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Atribut yang dikonversi ke tipe data khusus.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'anggota' => 'array',
        'no_anggota' => 'array',
    ];
}
