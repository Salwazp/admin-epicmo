<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\TitleRunningImage;
use App\Http\Controllers\Controller;


class TitleRunningImageController extends Controller
{
    public function index()
    {
        $data = TitleRunningImage::all();
        return view('pages.admin.title_running_image.index'); 
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);
    
        TitleRunningImage::create([
            'title' => $request->title,
        ]);
    
        return redirect()->back()->with('success', 'Title berhasil disimpan.');
    }
    

    public function show($id)
    {
        $data = TitleRunningImage::findOrFail($id);
        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $data = TitleRunningImage::findOrFail($id);
        $data->update([
            'title' => $request->title,
        ]);

        return response()->json(['message' => 'Data berhasil diperbarui', 'data' => $data]);
    }

    public function destroy($id)
    {
        $data = TitleRunningImage::findOrFail($id);
        $data->delete();

        return response()->json(['message' => 'Data berhasil dihapus']);
    }
}
