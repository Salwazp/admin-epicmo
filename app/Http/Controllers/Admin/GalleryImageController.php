<?php

namespace App\Http\Controllers\Admin;

use App\Models\GalleryImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;
use App\Repository\UploadRepository;

class GalleryImageController extends Controller
{
    protected $upload;

    public function __construct(UploadRepository $upload)
    {
        $this->upload = $upload;
    }

    public function create()
    {
        $data = null;
        return view('pages.admin.gallery.image.action', compact('data'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'display_order' => 'required|integer'
        ]);

        $image = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('gallery', $filename, 's3');
            $image = Storage::disk('s3')->url($path);
        }

        $requestedOrder = $request->display_order;
        
        if (!empty($requestedOrder)) {
            GalleryImage::where('display_order', '>=', $requestedOrder)
                ->orderBy('display_order', 'asc')
                ->increment('display_order');
        } else {
            $requestedOrder = 1;
        }
        
        GalleryImage::create([
            'image' => $image,
            'display_order' => $request->display_order
        ]);
        
        return redirect()->route('admin.gallery.index')->with(['create' => 'success']);
    }
    
    public function edit(GalleryImage $galleryImage)
    {
        $data = $galleryImage;
        return view('pages.admin.gallery.image.action', compact('data'));
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'display_order' => 'required|integer'
        ]);
        
        $galleryImage = GalleryImage::findOrFail($id);
        
        $currentOrder = $galleryImage->display_order;
        $requestedOrder = $request->display_order;

        if ($request->hasFile('image')) {
            if ($galleryImage->image) {
                $oldPath = basename($galleryImage->image);
                Storage::disk('s3')->delete("gallery/{$oldPath}");
            }
            
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('gallery', $filename, 's3');
            $image = Storage::disk('s3')->url($path);
        } else {
            $image = $galleryImage->image;
        }

        if (!empty($requestedOrder) && $currentOrder != $requestedOrder) {
            if ($requestedOrder > $currentOrder) {
                GalleryImage::where('display_order', '>', $currentOrder)
                    ->where('display_order', '<=', $requestedOrder)
                    ->where('id', '!=', $id)
                    ->decrement('display_order');
            } else {
                GalleryImage::where('display_order', '<', $currentOrder)
                    ->where('display_order', '>=', $requestedOrder)
                    ->where('id', '!=', $id)
                    ->increment('display_order');
            }
        }
        
        $galleryImage->update([
            'image' => $image,
            'display_order' => $request->display_order
        ]);
        
        return redirect()->route('admin.gallery.index')->with(['update' => 'update']);
    }
    
    public function imageDelete(GalleryImage $galleryImage)
    {
        if ($galleryImage->image) {
            $path = basename($galleryImage->image);
            Storage::disk('s3')->delete("gallery/{$path}");
        }

        $galleryImage->delete();
        
        return response()->json(['success' => true]);
    }
}
