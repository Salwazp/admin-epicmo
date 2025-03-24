<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MediaYoutube;

class MediaYoutubeController extends Controller {
    public function index() {
        $data = MediaYoutube::all();
        return view('pages.admin.media_youtube.index', compact('data'));
    }

    public function create()
{
    return view('pages.admin.media_youtube.action', [
        'data' => null // Kirim null agar tidak error
    ]);
}

    public function store(Request $request) {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'link_youtube' => 'nullable|string',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('media_images', 'public');
        }

        MediaYoutube::create([
            'image' => $imagePath ?? null, // Pastikan path gambar tersimpan atau tetap NULL
            'link_youtube' => $request->link_youtube,
        ]);
        
        return redirect()->route('admin.media_youtube.index')->with('success', 'Media berhasil ditambahkan!');
    }

    public function edit($id) {
        $data = MediaYoutube::findOrFail($id);
        return view('pages.admin.media_youtube.edit', compact('data'));
    }

    public function update(Request $request, $id) {
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads/moments', 'public');
        } else {
            $imagePath = $data->image; // Jika tidak ada gambar baru, gunakan gambar lama
        }
        
        $data = MediaYoutube::findOrFail($id);
        
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('media_images', 'public');
            $data->image = $imagePath;
        }

        $data->link_youtube = $request->link_youtube;
        $data->update([
            'image' => $imagePath,
            'link_youtube' => $request->link_youtube,
        ]);
        

        return redirect()->route('pages.admin.media_youtube.index')->with('success', 'Media berhasil diperbarui!');
    }

    public function destroy($id) {
        MediaYoutube::destroy($id);
        return redirect()->route('admin.media_youtube.index')->with('success', 'Media berhasil dihapus!');
    }
}
