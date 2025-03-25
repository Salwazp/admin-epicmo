<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MediaYoutube;
use App\Repository\UploadRepository;

class MediaYoutubeController extends Controller 
{
    protected $upload;

    public function __construct(UploadRepository $upload) {
        $this->upload = $upload;
    }

    public function index() 
    {
        $data = MediaYoutube::all();
        return view('pages.admin.media_youtube.index', compact('data'));
    }

    public function create()
    {
        return view('pages.admin.media_youtube.action', ['data' => null]);
    }

    public function store(Request $request) 
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'link_youtube' => 'required|url',
        ]);

        // Simpan gambar di Wasabi jika ada
        $imagePath = $request->file('image') ? $this->upload->save($request->file('image')) : null;

        MediaYoutube::create([
            'image' => $imagePath,
            'link_youtube' => $request->link_youtube,
        ]);
        
        return redirect()->route('admin.media_youtube.index')->with('success', 'Media berhasil ditambahkan!');
    }

    public function edit($id) 
    {
        $data = MediaYoutube::findOrFail($id);
        return view('pages.admin.media_youtube.edit', compact('data'));
    }

    public function update(Request $request, $id) 
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'link_youtube' => 'required|url',
        ]);

        $data = MediaYoutube::findOrFail($id);

        // Simpan gambar baru jika ada, kalau tidak pakai gambar lama
        $imagePath = $request->file('image') ? $this->upload->save($request->file('image')) : $data->image;

        $data->update([
            'image' => $imagePath,
            'link_youtube' => $request->link_youtube,
        ]);

        return redirect()->route('admin.media_youtube.index')->with('success', 'Media berhasil diperbarui!');
    }

    public function destroy($id) 
    {
        MediaYoutube::destroy($id);
        return redirect()->route('admin.media_youtube.index')->with('success', 'Media berhasil dihapus!');
    }
}
