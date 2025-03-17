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

    public function __construct(UploadRepository $upload) {
        $this->upload = $upload;
    }

    public function index()
    {
        if (request()->ajax()){
            $data = GalleryImage::get();
            return DataTables::of($data)
            ->make(true);
        }
        $data = Gallery::orderby('id', 'DESC')->first();
        return view('pages.admin.gallery.index', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'         => 'required'
        ]);
        $text_highlight = [$request->text_highlight1, $request->text_highlight2];

        if ($request->file('image')) {
            $image = $this->upload->save($request->file('image'));
        } else {
            $image = null;
        }
        

        Gallery::create([
            'title'             => $request->title,
            'subtitle'          => $request->subtitle,
            'text_highlight'    => $text_highlight
    ]);

        return redirect()->back()->with(['create' => 'create']);
    }

    public function update(Request $request)
    {
        $request->validate([
            'title'         => 'required'
        ]);
        $gallery = Gallery::first();
        
        $text_highlight = [$request->text_highlight1, $request->text_highlight2];

        if ($request->file('image')) {
            $image = $this->upload->save($request->file('image'));
        } else {
            $image = $gallery->image;
        }

        $gallery->update([
            'title'             => $request->title,
            'subtitle'          => $request->subtitle,
            'text_highlight'    => $text_highlight
        ]);

        return redirect()->back()->with(['update' => 'update']);
    }

    

    public function delete(Gallery $gallery)
    {
        $gallery->delete();
    }
}
