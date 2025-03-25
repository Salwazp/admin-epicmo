<?php

namespace App\Http\Controllers\Admin;

use App\Models\Gallery;
use App\Models\GalleryImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Repository\UploadRepository;

class GalleryController extends Controller
{
    protected $upload;  
    
    public function index(Request $request)
    {
        if (request()->ajax()) {
            $tableType = $request->input('table_type', 'galleries');
            
            if ($tableType === 'galleries') {
                $data = Gallery::latest()->get();
            } else {
                $data = GalleryImage::latest()->get();
            }
            
            return DataTables::of($data)->make(true);
        }
        
        return view('pages.admin.gallery.index');
    }
    
    public function create()
    {
        $data = null;
        return view('pages.admin.gallery.action', compact('data'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'highlight_text' => 'required',
        ]);
        
        Gallery::create([
            'title' => $request->title,
            'description' => $request->description,
            'highlight_text' => $request->highlight_text
        ]);
        
        return redirect()->route('admin.gallery.index')->with(['create' => 'create']);
    }
    
    public function edit(Gallery $gallery)
    {
        $data = $gallery;
        return view('pages.admin.gallery.action', compact('data'));
    }

    public function update(Request $request, Gallery $gallery)
    {
        $request->validate([
            'title'          => 'required',
            'description'    => 'required',
            'highlight_text' => 'required'
        ]);
        
        $gallery->update([
            'title'          => $request->title,
            'description'    => $request->description,
            'highlight_text' => $request->highlight_text
        ]);

        return redirect()->route('admin.gallery.index')->with(['update' => 'update']);
    }
    
    public function delete(Gallery $gallery)
    {
        $gallery->delete();
        
        return response()->json(['success' => true]);
    }
}