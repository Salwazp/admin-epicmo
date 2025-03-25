<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EventCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Repository\UploadRepository;

class EventCategoryController extends Controller
{
    protected $upload;

    public function __construct(UploadRepository $upload) {
        $this->upload = $upload;
    }

    public function create()
    {
        $data = null;
        return view('pages.admin.event.category.action', compact('data'));
    }

    public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        'button_text' => 'nullable|string|max:255',
        'button_link' => 'nullable|string|max:255',
        'display_order' => 'nullable|integer|min:1',
    ]);

    $image = null;
    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $image = $this->upload->save($file); // Simpan ke Wasabi
    }

    $requestedOrder = $request->display_order ?? 1;

    if (!empty($requestedOrder)) {
        EventCategory::where('display_order', '>=', $requestedOrder)
            ->orderBy('display_order', 'asc')
            ->increment('display_order');
    }

    EventCategory::create([
        'title'         => $request->title,
        'description'   => $request->description,
        'image'         => $image,
        'button_text'   => $request->button_text,
        'button_link'   => $request->button_link,
        'display_order' => $requestedOrder
    ]);

    return redirect()->route('admin.event.index')->with(['create' => 'success']);
}


    public function edit(EventCategory $eventCategory)
    {
        $data = $eventCategory;
        return view('pages.admin.event.category.action', compact('data'));
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        'button_text' => 'nullable|string|max:255',
        'button_link' => 'nullable|string|max:255',
        'display_order' => 'nullable|integer|min:1',
    ]);

    $eventCategory = EventCategory::findOrFail($id);
    
    $currentOrder = $eventCategory->display_order;
    $requestedOrder = $request->display_order ?? $currentOrder;

    if ($request->hasFile('image')) {
        // Hapus gambar lama jika ada
        if ($eventCategory->image) {
            $oldPath = str_replace('https://s3.ap-southeast-1.wasabisys.com/sobatstorage/', '', $eventCategory->image);
            Storage::disk('wasabi')->delete($oldPath);
        }

        $file = $request->file('image');
        $image = $this->upload->save($file); // Simpan gambar baru ke Wasabi
    } else {
        $image = $eventCategory->image;
    }

    if ($requestedOrder != $currentOrder) {
        if ($requestedOrder > $currentOrder) {
            EventCategory::where('display_order', '>', $currentOrder)
                ->where('display_order', '<=', $requestedOrder)
                ->where('id', '!=', $id)
                ->decrement('display_order');
        } else {
            EventCategory::where('display_order', '<', $currentOrder)
                ->where('display_order', '>=', $requestedOrder)
                ->where('id', '!=', $id)
                ->increment('display_order');
        }
    }
    
    $eventCategory->update([
        'title'         => $request->title,
        'description'   => $request->description,
        'image'         => $image,
        'button_text'   => $request->button_text,
        'button_link'   => $request->button_link,
        'display_order' => $requestedOrder
    ]);

    return redirect()->route('admin.event.category.index')->with(['update' => 'success']);
}


    public function delete(EventCategory $eventCategory)
    {        
        $eventCategory->delete();
        
        return response()->json(['success' => true]);
    }
}
