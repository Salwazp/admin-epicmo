<?php
namespace App\Repository;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

interface UploadInterface
{
    public function save($image);
}

class UploadRepository implements UploadInterface
{
    public function save($image)
    {
        $name = $image->hashName();
        $path = Storage::disk('public')->put("Project/folder", $image, 'public');
        return "{$path}".$name;
        // return "https://photobooth-storage.sgp1.cdn.digitaloceanspaces.com/Squarebox/{$kode_client}/$kontak/{$date}/".$name;
    }
}
