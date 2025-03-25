<?php

namespace App\Http\Controllers\Admin;

use App\Models\RunningImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Repository\UploadRepository;

class RunningImageController extends Controller
{
    protected $upload;
    public function __construct(UploadRepository $upload) {
        $this->upload = $upload;
    }
    public function index()
    {
        $runningimage = RunningImage::latest()->get(); 
        if (request()->ajax()) {
            $data = RunningImage::latest()->get();
            return DataTables::of($data)
            ->make(true);
        }
        $data = RunningImage::orderby('id', 'ASC')->first();
        return view('pages.admin.running_image.index', compact('data'));
    }

    public function create()
    {
        $data = null;
        return view('pages.admin.running_image.action', compact('data'));
    }

    public function store(Request $request)
{
    
    $request->validate([
        'image' => 'required|mimes:png,jpg,jpeg|max:1500'
    ]);

    if ($request->file('image')) {
        $image = $this->upload->save($request->file('image'));
    } else {
        $image = null;
    }
    dd($runningImage);
    $runningImage = RunningImage::create([
        'image' => $image
    ]);
    

    return response()->json([
        'success' => true,
        'data' => $runningImage
    ]);
    
}


    public function edit(RunningImage $runningImage)
    {
       $data = $runningImage;
       return view('pages.admin.running_image.action', compact('data'));
    }

    public function update(Request $request, RunningImage $runningImage)
    {
        $request->validate([
            'image'     => 'mimes:png,jpg,jpeg|max:1500'
        ]);

        if ($request->file('image')) {
            $image = $this->upload->save($request->file('image'));
        } else {
            $image = $runningImage->image;
        }
        
        $runningImage->update([
            'image' => $image
        ]);
        
        return redirect()->route('admin.running_image.index')->with(['update' => 'update']);
    }



    public function delete(RunningImage $runningImage)
    {
        $runningImage->delete();
    }
}