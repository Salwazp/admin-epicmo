<?php

namespace App\Http\Controllers;

use GeoIp2\Database\Reader as GeoIP;
use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\Spesifikasi;
use App\Models\AboutSection;
use App\Models\ContactForm;
use App\Models\Gallery;
use App\Models\GalleryImage;
use App\Models\RunningImage;
use App\Models\Why;
use App\Models\Preference;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{

    public function index()
    {
        $banner         = Banner::select('id', 'title', 'deskripsi', 'image', 'with_desc')->get();
        $about          = AboutSection::select('title', 'deskripsi', 'text_highlight', 'image', 'text_button')->first();
        $runningimage   = RunningImage::select('image')->latest()->get();
        $gallery        = Gallery::select('title', 'subtitle', 'text_highlight')->first();
        $gallery_image  = GalleryImage::paginate(8);
        $why            = Why::select('image', 'title', 'value')->first();
        $contact        = Preference::where('type', 'contact')->select('value')->first();

        return view("pages.frontend.index", compact('banner', 'about', 'runningimage', 'gallery', 'gallery_image', 'why', 'contact'));
    }


    public function spesifikasi(Banner $banner)
    {
        return view("pages.frontend.spesifikasi", compact('banner'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required',
            'email'     => 'required',
            'subject'   => 'required'
        ]);

        ContactForm::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'subject'   => $request->subject,
            'message'   => $request->message
        ]);

        return redirect()->back()->with(['send' => 'Successfully']);
    }
}
