<?php

namespace App\Http\Controllers\Admin;

use App\Models\Banner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use App\Repository\UploadRepository;

class BannerController extends Controller
{
    protected $upload;

    public function __construct(UploadRepository $upload)
    {
        $this->upload = $upload;
    }

    public function index()
    {
        if (request()->ajax()) {
            $data = Banner::latest()->get();
            return DataTables::of($data)->make(true);
        }
        $data = Banner::orderby('id', 'DESC')->first();
        return view('pages.admin.banner.index', compact('data'));
    }

    public function create()
    {
        $data = null;
        return view('pages.admin.banner.action', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'image'             => 'required|mimes:jpg,png,jpeg,gif|max:2000',
            'title'             => 'required',
            'description'       => 'required',
            'highlight_text'    => 'required',
            'buttons'           => 'required'
        ]);

        // Upload gambar ke Wasabi S3
        $image = $request->hasFile('image') ? 
                 $this->upload->save($request->file('image')) : 
                 null;

        Banner::create([
            'image'          => $image,
            'title'          => $request->title,
            'description'    => $request->description,
            'highlight_text' => $request->highlight_text,
            'buttons'        => $request->buttons
        ]);

        return redirect()->route('admin.banner.index')->with(['create' => 'create']);
    }

    public function edit(Banner $banner)
    {
        $data = $banner;
        return view('pages.admin.banner.action', compact('data'));
    }

    public function update(Request $request, Banner $banner)
    {
        $request->validate([
            'image'          => 'nullable|mimes:jpg,png,jpeg,gif|max:2000',
            'title'          => 'required',
            'description'    => 'required',
            'highlight_text' => 'required',
            'buttons'        => 'required'
        ]);

        // Jika ada gambar baru, upload ke Wasabi
        if ($request->hasFile('image')) {
            $image = $this->upload->save($request->file('image'));
        } else {
            $image = $banner->image;
        }

        $banner->update([
            'image'          => $image,
            'title'          => $request->title,
            'description'    => $request->description,
            'highlight_text' => $request->highlight_text,
            'buttons'        => $request->buttons
        ]);

        return redirect()->route('admin.banner.index')->with(['update' => 'update']);
    }

    public function delete(Banner $banner)
    {
        // Tidak perlu hapus gambar karena `UploadRepository` tidak punya fungsi delete
        $banner->delete();

        return response()->json(['success' => true]);
    }
}
