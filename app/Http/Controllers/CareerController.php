<?php

namespace App\Http\Controllers;

use App\Models\Career;
use Illuminate\Http\Request;

class CareerController extends Controller
{
    public function index()
    {
        $career = Career::where('id', '!=', 1)->select('image', 'title', 'date')->get();
        $banner = Career::where('id', '=', 1)->select('image', 'title')->first();
        return view('pages.frontend.career', compact('career', 'banner'));
    }
}
