<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MomentButton extends Model
{
    use HasFactory;

    protected $table = 'moment_button';

    protected $fillable = ['title', 'link_button'];
}
