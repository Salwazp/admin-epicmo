<?php

namespace App\Http\Controllers\Admin;

use App\Models\Preference;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Repository\UploadRepository;

class PreferenceController extends Controller
{
    protected $upload;

    public function __construct(UploadRepository $upload) {
        $this->upload = $upload;
    }
    
    public function index()
    {
        $data = Preference::where('type', 'preference')->first();
        return view('pages.admin.preference.index', compact('data'));
    }

    public function store(Request $request)
    { 
        $request->validate([
            'logo'          => 'mimes:png,jpeg,jpg|max:1500',
            'favicon'       => 'mimes:ico|max:1500'
        ]);

        if ($request->file('logo')) 
        {
            $logo = $this->upload->save($request->file('logo'));
        } else {
            $logo = null;
        }

        if($request->file('favicon')){
            $favicon = $this->upload->save($request->file('favicon'));
        } else {
            $favicon = null;
        }

        Preference::create([
            'type'  => 'preference',
            'value' => [
                'logo'              => $logo,
                'favicon'           => $favicon,
                'meta_title'        => $request->meta_title,
                'meta_deskripsi'    => $request->meta_deskripsi,
                'instagram'         => $request->instagram,
                'tiktok'            => $request->tiktok,
                'facebook'          => $request->facebook,
                'privacy_policy'    => $request->privacy_policy,
                'terms_of_service'  => $request->terms_of_service,
                'google_analytics'  => $request->google_analytics, 
                'script_meta'       => $request->script_meta, 
            ]
        ]);        

        return redirect()->back()->with(['create' => 'create']);
    }

    public function update(Request $request, Preference $preference)
    {
        $request->validate([
            'logo'          => 'mimes:png,jpeg,jpg|max:1500',
            'favicon'       => 'mimes:ico|max:1500'
        ]);

        $preference = Preference::where('type', 'preference')->first();
        
        if ($request->file('logo')) 
        {
            $logo = $this->upload->save($request->file('logo'));
        } else {
            $logo = isset($preference->value['logo']) ? $preference->value['logo'] : '';
        }
        
        if($request->file('favicon')){
            $favicon = $this->upload->save($request->file('favicon'));
        } else {
            $favicon = isset($preference->value['favicon']) ? $preference->value['favicon'] : '';
        }

        $preference->update([
            'type'  => 'preference',
            'value' => [
                'logo'              => $logo,
                'favicon'           => $favicon,
                'meta_title'        => $request->meta_title,
                'meta_deskripsi'    => $request->meta_deskripsi,
                'instagram'         => $request->instagram ?? ($preference->value['instagram'] ?? ''),
                'tiktok'            => $request->tiktok ?? ($preference->value['tiktok'] ?? ''),
                'facebook'          => $request->facebook ?? ($preference->value['facebook'] ?? ''),
                'privacy_policy'    => $request->privacy_policy ?? ($preference->value['privacy_policy'] ?? ''),
                'terms_of_service'  => $request->terms_of_service ?? ($preference->value['terms_of_service'] ?? ''),
                'google_analytics'  => $request->google_analytics ?? ($preference->value['google_analytics'] ?? ''),
                'script_meta'       => $request->script_meta ?? ($preference->value['script_meta'] ?? ''),
            ]
        ]);        

        return redirect()->back()->with(['update' => 'update']);
    }
}
