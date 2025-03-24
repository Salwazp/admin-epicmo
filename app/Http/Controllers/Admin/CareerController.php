<?php

namespace App\Http\Controllers\Admin;

use App\Models\Career;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Repository\UploadRepository;

class CareerController extends Controller
{
    protected $upload;

    public function __construct(UploadRepository $upload) {
        $this->upload = $upload;
    }


    public function index()
    {
        if (request()->ajax()){
            $data = Career::where('id', '!=', '1')->latest()->get();
        return DataTables::of($data)
            ->make(true);
        }
        $data = Career::where('id', '=', '1')->first();
        return view('pages.admin.career.index', compact('data'));
    }

    public function create()
    {
        $data = null;
        return view('pages.admin.career.action', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|mimes:jpg,png,jpeg,gif|max:2000',
            'title' => 'required'
        ]);

        if ($request->file('image')) {
            $image = $this->upload->save($request->file('image'));
        } else {
            $image = null;
        }

        Career::create([
            'image'         => $image,
            'title'         => $request->title,
            'date'          => $request->date
        ]);

        return redirect()->route('admin.career.index')->with(['create' => 'create']);
    }

    public function edit(Career $career)
    {
        $data   = $career;

        return view('pages.admin.career.action', compact('data'));
    }

    public function update(Request $request, Career $career)
    {
        $request->validate([
            'image' => 'mimes:jpg,png,jpeg,gif|max:2000',
            'title' => 'required'
        ]);

        if ($request->file('image')) {
            $image = $this->upload->save($request->file('image'));
        } else {
            $image = $career->image;
        }

        $career->update([
            'image'         => $image,
            'title'         => $request->title,
            'date'          => $request->date
        ]);

        return redirect()->route('admin.career.index')->with(['update' => 'update']);
    }

    public function delete(Career $career)
    {
        $career->delete();
    }

}
