<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    // Tentukan nama tabel jika tidak mengikuti konvensi plural
    protected $table = 'users';

    // Tentukan kolom yang bisa diisi (fillable)
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',  // Menambahkan kolom role
    ];

    // Tentukan kolom yang harus di-cast ke tipe tertentu
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Tentukan apakah password harus selalu disembunyikan dari array dan JSON
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Jika ingin menggunakan query scope atau relasi, dapat ditambahkan di sini.
}
