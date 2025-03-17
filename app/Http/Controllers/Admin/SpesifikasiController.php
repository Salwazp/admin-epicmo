<?php

namespace App\Http\Controllers\Admin;

use App\Models\Banner;
use App\Models\Spesifikasi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Repository\UploadRepository;

class SpesifikasiController extends Controller
{
    protected $upload;

    public function __construct(UploadRepository $upload) {
        $this->upload = $upload;
    }

    public function index(Banner $banner)
    {
        if (request()->ajax()){
            $data = Spesifikasi::where('id_banner', $banner->id)->latest()->get();
            return DataTables::of($data)
            ->make(true);
        }
        return view('pages.admin.banner.spesifikasi.index', compact('banner'));
    }

    public function create(Banner $banner)
    {
        $data = null;
        return view('pages.admin.banner.spesifikasi.action', compact('data', 'banner'));
    }

    public function store(Request $request, Banner $banner)
    {
        $request->validate([
            'image'             => 'required|mimes:jpg,png,jpeg,gif|max:2000',
            'vessel_name'       => 'required'
        ]);

        if ($request->file('image')) {
            $image = $this->upload->save($request->file('image'));
        } else {
            $image = null;
        }

        Spesifikasi::create([
            'id_banner'     => $banner->id,
            'vessel_name'   => $request->vessel_name,
            'image'         => $image,
            'year_built'    => $request->year_built,
            'vessel_type'   => $request->vessel_type,
            'capacity'      => $request->capacity
        ]);

        return redirect()->route('admin.banner.spesifikasi.index', $banner->id)->with(['create' => 'create']);
    }

    public function edit(Spesifikasi $spesifikasi)
    {
        $data   = $spesifikasi;
        $banner = $spesifikasi->banner;

        return view('pages.admin.banner.spesifikasi.action', compact('data', 'banner'));
    }

    public function update(Request $request, Spesifikasi $spesifikasi)
    {
        $request->validate([
            'image'             => 'mimes:jpg,png,jpeg,gif|max:2000',
            'vessel_name'       => 'required'
        ]);

        if ($request->file('image')) {
            $image = $this->upload->save($request->file('image'));
        } else {
            $image = $spesifikasi->image;
        }
        $spesifikasi->update([
            'vessel_name'   => $request->vessel_name,
            'image'         => $image,
            'year_built'    => $request->year_built,
            'vessel_type'   => $request->vessel_type,
            'capacity'      => $request->capacity
        ]);

        return redirect()->route('admin.banner.spesifikasi.index', $spesifikasi->id_banner)->with(['update' => 'update']);
    }

    public function delete(Spesifikasi $spesifikasi)
    {
        $spesifikasi->delete();
    }
}
