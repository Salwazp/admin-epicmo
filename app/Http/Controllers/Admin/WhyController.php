<?php

namespace App\Http\Controllers\Admin;

use App\Models\Why;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class WhyController extends Controller
{
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
            'image'                   => 'mimes:png,jpg,jpeg|max:2000',
            'title'                   => 'required',
            'highlight_text'          => 'required',
            'icon1'                   => 'nullable|mimes:png,jpg,jpeg,gif|max:1024',
            'icon2'                   => 'nullable|mimes:png,jpg,jpeg,gif|max:1024',
            'icon3'                   => 'nullable|mimes:png,jpg,jpeg,gif|max:1024',
            'icon4'                   => 'nullable|mimes:png,jpg,jpeg,gif|max:1024',
        ]);
        
        $imagePath = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $imagePath = $file->storeAs('why', $filename, 'public');
        }
        
        // Handle icon file uploads
        $icon1Path = null;
        if ($request->hasFile('icon1')) {
            $file = $request->file('icon1');
            $filename = 'icon1_' . time() . '_' . $file->getClientOriginalName();
            $icon1Path = $file->storeAs('why/icons', $filename, 'public');
        }
        
        $icon2Path = null;
        if ($request->hasFile('icon2')) {
            $file = $request->file('icon2');
            $filename = 'icon2_' . time() . '_' . $file->getClientOriginalName();
            $icon2Path = $file->storeAs('why/icons', $filename, 'public');
        }
        
        $icon3Path = null;
        if ($request->hasFile('icon3')) {
            $file = $request->file('icon3');
            $filename = 'icon3_' . time() . '_' . $file->getClientOriginalName();
            $icon3Path = $file->storeAs('why/icons', $filename, 'public');
        }
        
        $icon4Path = null;
        if ($request->hasFile('icon4')) {
            $file = $request->file('icon4');
            $filename = 'icon4_' . time() . '_' . $file->getClientOriginalName();
            $icon4Path = $file->storeAs('why/icons', $filename, 'public');
        }
        
        $data = [
            'title' => $request->title,
            'highlight_text' => $request->highlight_text,
            'image' => $imagePath,
            'value' => [
                'subtitle1'    => $request->subtitle1,
                'deskripsi1'   => $request->deskripsi1,
                'icon1'        => $icon1Path,

                'subtitle2'    => $request->subtitle2,
                'deskripsi2'   => $request->deskripsi2,
                'icon2'        => $icon2Path,

                'subtitle3'    => $request->subtitle3,
                'deskripsi3'   => $request->deskripsi3,
                'icon3'        => $icon3Path,
                
                'subtitle4'    => $request->subtitle4,
                'deskripsi4'   => $request->deskripsi4,
                'icon4'        => $icon4Path,
            ]
        ];
        
        Why::create($data);

        return redirect()->back()->with(['create' => 'create']);
    }

    public function update(Request $request)
    {
        $why = Why::first();
        
        $request->validate([
            'image'                   => 'mimes:png,jpg,jpeg|max:2000',
            'title'                   => 'required',
            'highlight_text'          => 'required',
            'icon1'                   => 'nullable|mimes:png,jpg,jpeg,gif|max:1024',
            'icon2'                   => 'nullable|mimes:png,jpg,jpeg,gif|max:1024',
            'icon3'                   => 'nullable|mimes:png,jpg,jpeg,gif|max:1024',
            'icon4'                   => 'nullable|mimes:png,jpg,jpeg,gif|max:1024',
        ]);
        
        // Ensure value is an array
        $currentValue = is_string($why->value) ? json_decode($why->value, true) : $why->value;
        if (!is_array($currentValue)) {
            $currentValue = [];
        }
        
        $imagePath = $why->image;
        if ($request->hasFile('image')) {
            if ($why->image && Storage::disk('public')->exists($why->image)) {
                Storage::disk('public')->delete($why->image);
            }
            
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $imagePath = $file->storeAs('why', $filename, 'public');
        }
        
        // Handle icon file uploads
        if ($request->hasFile('icon1')) {
            if (isset($currentValue['icon1']) && Storage::disk('public')->exists($currentValue['icon1'])) {
                Storage::disk('public')->delete($currentValue['icon1']);
            }
            
            $file = $request->file('icon1');
            $filename = 'icon1_' . time() . '_' . $file->getClientOriginalName();
            $currentValue['icon1'] = $file->storeAs('why/icons', $filename, 'public');
        }
        
        if ($request->hasFile('icon2')) {
            if (isset($currentValue['icon2']) && Storage::disk('public')->exists($currentValue['icon2'])) {
                Storage::disk('public')->delete($currentValue['icon2']);
            }
            
            $file = $request->file('icon2');
            $filename = 'icon2_' . time() . '_' . $file->getClientOriginalName();
            $currentValue['icon2'] = $file->storeAs('why/icons', $filename, 'public');
        }
        
        if ($request->hasFile('icon3')) {
            if (isset($currentValue['icon3']) && Storage::disk('public')->exists($currentValue['icon3'])) {
                Storage::disk('public')->delete($currentValue['icon3']);
            }
            
            $file = $request->file('icon3');
            $filename = 'icon3_' . time() . '_' . $file->getClientOriginalName();
            $currentValue['icon3'] = $file->storeAs('why/icons', $filename, 'public');
        }
        
        if ($request->hasFile('icon4')) {
            if (isset($currentValue['icon4']) && Storage::disk('public')->exists($currentValue['icon4'])) {
                Storage::disk('public')->delete($currentValue['icon4']);
            }
            
            $file = $request->file('icon4');
            $filename = 'icon4_' . time() . '_' . $file->getClientOriginalName();
            $currentValue['icon4'] = $file->storeAs('why/icons', $filename, 'public');
        }
        
        $data = [
            'title' => $request->title,
            'highlight_text' => $request->highlight_text,
            'image' => $imagePath,
            'value' => [
                'subtitle1'    => $request->subtitle1,
                'deskripsi1'   => $request->deskripsi1,
                'icon1'        => $currentValue['icon1'] ?? null,

                'subtitle2'    => $request->subtitle2,
                'deskripsi2'   => $request->deskripsi2,
                'icon2'        => $currentValue['icon2'] ?? null,

                'subtitle3'    => $request->subtitle3,
                'deskripsi3'   => $request->deskripsi3,
                'icon3'        => $currentValue['icon3'] ?? null,
                
                'subtitle4'    => $request->subtitle4,
                'deskripsi4'   => $request->deskripsi4,
                'icon4'        => $currentValue['icon4'] ?? null,
            ]
        ];

        $why->update($data);

        return redirect()->back()->with(['update' => 'update']);
    }

    public function delete(Why $why)
    {
        // Delete main image
        if ($why->image && Storage::disk('public')->exists($why->image)) {
            Storage::disk('public')->delete($why->image);
        }
        
        // Delete icon images
        $value = is_string($why->value) ? json_decode($why->value, true) : $why->value;
        
        if (is_array($value)) {
            $iconFields = ['icon1', 'icon2', 'icon3', 'icon4'];
            
            foreach ($iconFields as $field) {
                if (isset($value[$field]) && Storage::disk('public')->exists($value[$field])) {
                    Storage::disk('public')->delete($value[$field]);
                }
            }
        }
        
        $why->delete();
        
        return redirect()->route('admin.why.index')->with(['delete' => 'delete']);
    }
}