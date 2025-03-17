<?php

namespace App\Http\Controllers\Admin;

use App\Models\GalleryImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Repository\UploadRepository;


class GalleryImageController extends Controller
{
    protected $upload;

    public function __construct(UploadRepository $upload) {
        $this->upload = $upload;
    }

    public function edit(GalleryImage $gallery_image)
    {
       $data = $gallery_image;
       return view('pages.admin.gallery.action', compact('data'));
    }

    public function update(Request $request, GalleryImage $gallery_image)
    {
        $request->validate([
            'image'     => 'mimes:jpg,png,jpeg,gif|max:2000'
        ]);
        
        
        if ($request->file('image')) {
            $image = $this->upload->save($request->file('image'));
        } else {
            $image = $gallery_image->image;
        }

        $gallery_image->update([
            'image'   => $image,
            'dimensi' => $request->dimensi
        ]);

        return redirect()->route("admin.gallery.index")->with(['update' => 'update']);
    }
}
