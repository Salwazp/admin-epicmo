<?php

namespace App\Http\Controllers\Admin;

use App\Models\AboutSection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Repository\UploadRepository;

class AboutSectionController extends Controller
{
    protected $upload;

    public function __construct(UploadRepository $upload) {
        $this->upload = $upload;
    }



    public function index()
    {
        if (request()->ajax()){
            $data = AboutSection::latest()->get();
            return DataTables::of($data)
            ->make(true);
        }
        $data = AboutSection::orderby('id', 'DESC')->first();
        return view('pages.admin.about-section.index', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'image'         => 'mimes:png,jpg,jpeg|max:2000',
            'title'         => 'required',
            'deskripsi'     => 'required',
            'text_button'   => 'required',
        ]);
        $text_highlight = [$request->text_highlight1, $request->text_highlight2];
        if ($request->file('image')) {
            $image = $this->upload->save($request->file('image'));
        } else {
            $image = null;
        }
        

        AboutSection::create([
            'image'             => $image,
            'title'             => $request->title,
            'deskripsi'         => $request->deskripsi,
            'text_button'       => $request->text_button,
            'text_highlight'    => $text_highlight
        ]);

        return redirect()->back()->with(['create' => 'create']);
    }

    public function update(Request $request)
    {
        $request->validate([
            'image'         => 'mimes:png,jpg,jpeg|max:2000',
            'title'         => 'required',
            'deskripsi'     => 'required',
            'text_button'   => 'required'
        ]);
        $about_section = AboutSection::first();
        
        $text_highlight = [$request->text_highlight1, $request->text_highlight2];

        if ($request->file('image')) {
            $image = $this->upload->save($request->file('image'));
        } else {
            $image = $about_section->image;
        }

        $about_section->update([
            'image'             => $image,
            'title'             => $request->title,
            'deskripsi'         => $request->deskripsi,
            'text_button'       => $request->text_button,
            'text_highlight'    => $text_highlight
        ]);

        return redirect()->back()->with(['update' => 'update']);
    }
}
