<?php

namespace App\Http\Controllers\Admin;

use App\Models\Why;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\File;
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
        return view('pages.admin.why.index', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'image1'         => 'mimes:png,jpg,jpeg|max:2000',
            'image2'         => 'mimes:png,jpg,jpeg|max:2000',
            'image3'         => 'mimes:png,jpg,jpeg|max:2000',
            'title'          => 'required'
        ]);
        if ($request->file('image1') && $request->file('image2') && $request->file('image3')) {
            $image1 = $this->upload->save($request->file('image1'));
            $image2 = $this->upload->save($request->file('image2'));
            $image3 = $this->upload->save($request->file('image3'));
        } else {
            $image = null;
        }
        
        $data = [
            'title' => $request->title,
            'image' => [
                'image1'    => $image1,
                'image2'    => $image2,
                'image3'    => $image3
            ],
            'value' => [
                'subtitle1'    => $request->subtitle1,
                'deskripsi1'   => $request->deskripsi1,

                'subtitle2'    => $request->subtitle2,
                'deskripsi2'   => $request->deskripsi2,

                'subtitle3'    => $request->subtitle3,
                'deskripsi3'   => $request->deskripsi3,
                
                'subtitle4'    => $request->subtitle4,
                'deskripsi4'   => $request->deskripsi4,
            ]
        ];
        return $data;
        Why::create($data);

        return redirect()->back()->with(['create' => 'create']);
    }

    public function update(Request $request)
    {
        $why = Why::first();
        
        $request->validate([
            'image1'         => 'mimes:png,jpg,jpeg|max:2000',
            'image2'         => 'mimes:png,jpg,jpeg|max:2000',
            'image3'         => 'mimes:png,jpg,jpeg|max:2000',
            'title'          => 'required'
        ]);
        if ($request->file('image1') && $request->file('image2') && $request->file('image3')) {
            $image1 = $this->upload->save($request->file('image1'));
            $image2 = $this->upload->save($request->file('image2'));
            $image3 = $this->upload->save($request->file('image3'));
        } else {
            $image1 = isset($why->image['image1']) ? $why->image['image1'] : '';
            $image2 = isset($why->image['image2']) ? $why->image['image2'] : '';
            $image3 = isset($why->image['image3']) ? $why->image['image3'] : '';
        }
        $data = [
            'title' => $request->title,
            'image' => [
                'image1'    => $image1,
                'image2'    => $image2,
                'image3'    => $image3
            ],
            'value' => [
                'subtitle1'    => $request->subtitle1,
                'deskripsi1'   => $request->deskripsi1,

                'subtitle2'    => $request->subtitle2,
                'deskripsi2'   => $request->deskripsi2,

                'subtitle3'    => $request->subtitle3,
                'deskripsi3'   => $request->deskripsi3,
                
                'subtitle4'    => $request->subtitle4,
                'deskripsi4'   => $request->deskripsi4,
            ]
        ];

        $why->update($data);

        return redirect()->back()->with(['update' => 'update']);
    }

    

    public function delete(Why $why)
    {
        $why->delete();
    }
}
