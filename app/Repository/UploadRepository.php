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
        Storage::disk('digitalocean')->put('alcb', $image, 'public');
        return 'https://sobat.sgp1.cdn.digitaloceanspaces.com/alcb/'.$name;
    }

    public function saveOriginalName($image)
    {
        $name = $image->getClientOriginalName();
        Storage::disk('digitalocean')->put('alcb', $image, 'public');
        return 'https://sobat.sgp1.cdn.digitaloceanspaces.com/alcb/'.$name;
    }

    public function saveBase64($image, $fileName)
    {
        Storage::disk('digitalocean')->put('alcb/'.$fileName, $image, 'public');
        return 'https://sobat.sgp1.cdn.digitaloceanspaces.com/alcb/'.$fileName;
    }
}