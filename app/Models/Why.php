<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Why extends Model
{
    use HasFactory;

    protected $table = 'why_choose';

    protected $guarded = [];

    protected $casts = [
        'value' => 'array',
        'image' => 'array',
    ];
}
