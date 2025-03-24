<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $about = About::select('image', 'banner', 'visi', 'misi')->first();
        return view('pages.frontend.about', compact('about'));
    }
}
