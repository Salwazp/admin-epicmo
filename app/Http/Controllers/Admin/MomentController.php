<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Moment;
use App\Http\Controllers\Controller;
use App\Repository\UploadRepository;

class MomentController extends Controller
{
    protected $upload;

    public function __construct(UploadRepository $upload)
    {
        $this->upload = $upload;
    }

    public function index()
    {
        $data = Moment::all();
        return view('pages.admin.moment.index', compact('data'));
    }

    public function create()
    {
        return view('pages.admin.moment.action', ['data' => null]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'image'       => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        // Simpan gambar ke Wasabi via UploadRepository
        $imagePath = $request->hasFile('image') ? $this->upload->save($request->file('image')) : null;

        Moment::create([
            'title'       => $request->title,
            'description' => $request->description,
            'image'       => $imagePath,
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
            'title'       => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'image'       => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        // Simpan gambar baru jika ada
        $imagePath = $request->hasFile('image') ? $this->upload->save($request->file('image')) : $data->image;

        $data->update([
            'title'       => $request->title,
            'description' => $request->description,
            'image'       => $imagePath,
        ]);

        return redirect()->route('admin.moment.index')->with('success', 'Moment updated successfully.');
    }

    public function destroy($id)
    {
        Moment::findOrFail($id)->delete();
        return redirect()->route('admin.moment.index')->with('success', 'Moment deleted successfully.');
    }
}
