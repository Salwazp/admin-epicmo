<?php

namespace App\Http\Controllers\Admin;

use App\Models\About;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Repository\UploadRepository;

class AboutController extends Controller
{
    protected $upload;

    public function __construct(UploadRepository $upload) {
        $this->upload = $upload;
    }



    public function index()
    {
        $data = About::orderby('id', 'DESC')->first();
        return view('pages.admin.about.index', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'banner'        => 'required|mimes:png,jpg,jpeg|max:2000',
            'image'         => 'required|mimes:png,jpg,jpeg|max:2000',
            'visi'          => 'required',
            'misi'          => 'required'
        ]);

        if ($request->file('banner'))
        {
            $banner = $this->upload->save($request->file('banner'));
        } else {
            $banner = null;
        }
        
        if($request->file('image'))
        {
            $image = $this->upload->save($request->file('image'));
        } else {
            $image = null;
        }

        About::create([
            'banner'            => $banner,
            'image'             => $image,
            'visi'              => $request->visi,
            'misi'              => $request->misi
        ]);

        return redirect()->back()->with(['create' => 'create']);
    }

    public function update(Request $request)
    {
        $request->validate([
            'banner'        => 'mimes:png,jpg,jpeg|max:2000',
            'image'         => 'mimes:png,jpg,jpeg|max:2000',
            'visi'          => 'required',
            'misi'          => 'required'
        ]);
        $about = About::first();
        

        if ($request->file('banner')) 
        {
            $banner = $this->upload->save($request->file('banner'));
        } else {
            $banner = isset($about->banner) ? $about->banner : '';
        }
        
        if($request->file('image')){
            $image = $this->upload->save($request->file('image'));
        } else {
            $image = isset($about->image) ? $about->image : '';
        }

        $about->update([
            'banner'            => $banner,
            'image'             => $image,
            'visi'              => $request->visi,
            'misi'              => $request->misi
        ]);

        return redirect()->back()->with(['update' => 'update']);
    }
}
