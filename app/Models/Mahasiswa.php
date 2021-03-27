<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\Mahasiswa as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table='mahasiswa';
    protected $primaryKey = 'nim';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'nim',
        'nama',
        'kelas',
        'jurusan',
        'no_handphone',
        // menambahkan kolom
        'email',
        'tgl_lahir'
    ];
}

