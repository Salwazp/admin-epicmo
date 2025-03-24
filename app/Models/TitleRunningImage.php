<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TitleRunningImage extends Model
{
    use HasFactory;

    protected $table = 'title_running_images'; // Nama tabel di database
    protected $fillable = ['title'];
}
