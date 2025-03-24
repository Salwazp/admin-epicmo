<?php

namespace App\Http\Controllers\Api;

use GeoIp2\Database\Reader as GeoIP;
use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\About;
use App\Models\Gallery;
use App\Models\GalleryImage;
use App\Models\RunningImage;
use App\Models\Why;
use App\Models\Preferences;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{

    public function index()
    {
        $banner         = Banner::select('title', 'deskripsi', 'image', 'with_desc')->first();
        $about          = About::select('title', 'deskripsi', 'text_hightlight', 'image', 'text_button')->first();
        $runningimage   = RunningImage::select('image')->latest()->get();
        $gallery        = Gallery::select('title', 'subtitle', 'text_hightlight')->first();
        $gallery_image  = GalleryImage::Select('image', 'dimensi')->first();
        $why            = Why::select('image', 'title', 'value')->first();

        return response()->json([
            'status'    => true,
            'message'   => 'success',
            'data'      => [            
                'banner'        => $banner,
                'about'         => $about,
                'running_image' => $runningimage,
                'gallery'       => $gallery,
                'gallery_image' => $gallery_image,
                'why'           => $why
            ]
        ]);

    }
}
