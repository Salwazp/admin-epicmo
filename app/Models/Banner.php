<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    protected $table = 'banner';
    protected $guarded = [];

    public function spesifikasi()
    {
        return $this->hasMany(Spesifikasi::class);
    }

    public static function getBannerWithSpesifikasi()
    {
        return self::with('spesifikasi')->get();
    }
}