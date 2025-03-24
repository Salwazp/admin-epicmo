<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Media;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    public function index()
    {
        $data = Media::all();
        return view('pages.admin.media.index', compact('data'));
    }

    public function create()
    {
        return view('pages.admin.media.action');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'text_highlight' => 'nullable',
        ]);

        $media = new Media();
        $media->title = $request->title;
        $media->description = $request->description;
        $media->text_highlight = $request->text_highlight;

        $media->save();
        return redirect()->route('admin.media.index')->with('success', 'Media created successfully!');
    }

    public function edit($id)
    {
        $data = Media::findOrFail($id);
        return view('pages.admin.media.form', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $media = Media::findOrFail($id);
        $media->title = $request->title;
        $media->description = $request->description;
        $media->text_highlight = $request->text_highlight;

        $media->save();
        return redirect()->route('admin.media.index')->with('success', 'Media updated successfully!');
    }

    public function destroy($id)
    {
        $media = Media::findOrFail($id);
        $media->delete();
        return redirect()->route('admin.media.index')->with('success', 'Media deleted successfully!');
    }
}
