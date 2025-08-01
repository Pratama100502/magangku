<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class MentorModel extends Authenticatable
{
    use HasFactory;

    protected $table = 'mentor';

    protected $fillable = [
        'nama',
        'no_hp',
        'email',
        'password',
        'bidang',
    ];
    
    public function pesertaMagang()
    {
        return $this->hasMany(PesertaMagang::class);
    }
}
