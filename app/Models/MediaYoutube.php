<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MediaYoutube extends Model {
    use HasFactory;

    protected $table = 'media_youtube';
    protected $fillable = ['image', 'link_youtube'];
}
