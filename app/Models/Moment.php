<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Moment extends Model
{
    use HasFactory;

    protected $table = 'moment'; // Nama tabel di database
    protected $fillable = ['title', 'description', 'image']; // Kolom yang bisa diisi

    // Jika ada relasi, tambahkan di sini
}
