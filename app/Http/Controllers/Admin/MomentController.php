<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Moment;
use App\Http\Controllers\Controller;

class MomentController extends Controller
{
    public function index()
    {
        $data = Moment::all();
        return view('pages.admin.moment.index', compact('data'));
    }

    public function create()
    {
        return view('pages.admin.moment.action', ['data' => null]);    }

        public function store(Request $request)
        {
            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string|max:255',
                'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048', // Validasi gambar
            ]);
        
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('uploads/moments', 'public'); // Simpan ke storage
            } else {
                $imagePath = null;
            }
        
            Moment::create([
                'title' => $request->title,
                'description' => $request->description,
                'image' => $imagePath, // Simpan path gambar ke database
            ]);
        
            return redirect()->route('admin.moment.index')->with('success', 'Moment created successfully.');
        }
        

    public function edit($id)
    {
        $data = Moment::findOrFail($id);
        return view('pages.admin.moment.action', compact('data'));
    }

    public function update(Request $request, $id)
{
    $data = Moment::findOrFail($id);

    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string|max:255',
        'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
    ]);

    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('uploads/moments', 'public');
    } else {
        $imagePath = $data->image; // Jika tidak ada gambar baru, gunakan yang lama
    }

    $data->update([
        'title' => $request->title,
        'description' => $request->description,
        'image' => $imagePath,
    ]);

    return redirect()->route('admin.moment.index')->with('success', 'Moment updated successfully.');
}


    public function destroy($id)
    {
        Moment::findOrFail($id)->delete();
        return redirect()->route('pages.admin.moment.index')->with('success', 'Moment deleted successfully.');
    }
}
