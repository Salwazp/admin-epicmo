<?php

namespace App\Http\Controllers\Admin;

use App\Models\Why;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;
use App\Repository\UploadRepository;

class WhyController extends Controller
{
    protected $upload;

    public function __construct(UploadRepository $upload) {
        $this->upload = $upload;
    }

    public function index()
    {
        $data = Why::first();
        if ($data && is_string($data->value)) {
            $data->value = json_decode($data->value, true);
        }
        return view('pages.admin.why.index', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'image'          => 'mimes:png,jpg,jpeg|max:2000',
            'title'          => 'required',
            'highlight_text' => 'required',
            'icon1'          => 'nullable|mimes:png,jpg,jpeg,gif|max:1024',
            'icon2'          => 'nullable|mimes:png,jpg,jpeg,gif|max:1024',
            'icon3'          => 'nullable|mimes:png,jpg,jpeg,gif|max:1024',
            'icon4'          => 'nullable|mimes:png,jpg,jpeg,gif|max:1024',
        ]);
        
        $imagePath = $this->upload->store($request->file('image'), 'why');
        $icon1Path = $this->upload->store($request->file('icon1'), 'why/icons');
        $icon2Path = $this->upload->store($request->file('icon2'), 'why/icons');
        $icon3Path = $this->upload->store($request->file('icon3'), 'why/icons');
        $icon4Path = $this->upload->store($request->file('icon4'), 'why/icons');
        
        $data = [
            'title' => $request->title,
            'highlight_text' => $request->highlight_text,
            'image' => $imagePath,
            'value' => json_encode([
                'subtitle1' => $request->subtitle1,
                'deskripsi1' => $request->deskripsi1,
                'icon1' => $icon1Path,
                'subtitle2' => $request->subtitle2,
                'deskripsi2' => $request->deskripsi2,
                'icon2' => $icon2Path,
                'subtitle3' => $request->subtitle3,
                'deskripsi3' => $request->deskripsi3,
                'icon3' => $icon3Path,
                'subtitle4' => $request->subtitle4,
                'deskripsi4' => $request->deskripsi4,
                'icon4' => $icon4Path,
            ])
        ];
        
        Why::create($data);
        return redirect()->back()->with(['create' => 'create']);
    }

    public function update(Request $request)
    {
        $why = Why::first();
        
        $request->validate([
            'image'          => 'mimes:png,jpg,jpeg|max:2000',
            'title'          => 'required',
            'highlight_text' => 'required',
            'icon1'          => 'nullable|mimes:png,jpg,jpeg,gif|max:1024',
            'icon2'          => 'nullable|mimes:png,jpg,jpeg,gif|max:1024',
            'icon3'          => 'nullable|mimes:png,jpg,jpeg,gif|max:1024',
            'icon4'          => 'nullable|mimes:png,jpg,jpeg,gif|max:1024',
        ]);
        
        $currentValue = json_decode($why->value, true) ?? [];
        
        $imagePath = $this->upload->update($request->file('image'), $why->image, 'why');
        $icon1Path = $this->upload->update($request->file('icon1'), $currentValue['icon1'] ?? null, 'why/icons');
        $icon2Path = $this->upload->update($request->file('icon2'), $currentValue['icon2'] ?? null, 'why/icons');
        $icon3Path = $this->upload->update($request->file('icon3'), $currentValue['icon3'] ?? null, 'why/icons');
        $icon4Path = $this->upload->update($request->file('icon4'), $currentValue['icon4'] ?? null, 'why/icons');
        
        $data = [
            'title' => $request->title,
            'highlight_text' => $request->highlight_text,
            'image' => $imagePath,
            'value' => json_encode([
                'subtitle1' => $request->subtitle1,
                'deskripsi1' => $request->deskripsi1,
                'icon1' => $icon1Path,
                'subtitle2' => $request->subtitle2,
                'deskripsi2' => $request->deskripsi2,
                'icon2' => $icon2Path,
                'subtitle3' => $request->subtitle3,
                'deskripsi3' => $request->deskripsi3,
                'icon3' => $icon3Path,
                'subtitle4' => $request->subtitle4,
                'deskripsi4' => $request->deskripsi4,
                'icon4' => $icon4Path,
            ])
        ];

        $why->update($data);
        return redirect()->back()->with(['update' => 'update']);
    }

    public function delete(Why $why)
    {
        $this->upload->delete($why->image);
        
        $value = json_decode($why->value, true) ?? [];
        $icons = ['icon1', 'icon2', 'icon3', 'icon4'];
        foreach ($icons as $icon) {
            $this->upload->delete($value[$icon] ?? null);
        }
        
        $why->delete();
        return redirect()->route('admin.why.index')->with(['delete' => 'delete']);
    }
}
