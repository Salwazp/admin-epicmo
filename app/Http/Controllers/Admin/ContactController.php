<?php

namespace App\Http\Controllers\Admin;

use Excel;
use App\Models\Preference;
use App\Models\ContactForm;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Exports\ContactExport;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Repository\UploadRepository;


class ContactController extends Controller
{
    protected $upload;

    public function __construct(UploadRepository $upload) {
        $this->upload = $upload;
    }
    
    public function index()
    {
        $data = Preference::where('type', 'contact')->first();
        return view('pages.admin.contact.index', compact('data'));
    }
    

    public function store(Request $request)
    { 
        Preference::create([
            'type'  => 'contact',
            'value' => $request->except(['_token']),
        ]);

        return redirect()->back()->with(['create' => 'create']);
    }

    public function update(Request $request, Preference $contact)
    {

        $contact->update([
            'type'  => 'contact',
            'value' => $request->except(['_token'])
        ]);

        return redirect()->back()->with(['update' => 'update']);
    }


    public function list(Request $request)
    {
        $data = ContactForm::latest()->get();
        if (request()->ajax()){
            return DataTables::of($data)
            ->make(true);
        }
        return view('pages.admin.contact.form.index', compact('data'));
    }

    public function export(Request $request)
    {
        // $data = ContactForm::select('name', 'email', 'subject', 'message', 'created_at')->get();
        return Excel::download(new ContactExport, 'contact.xlsx');
    }
}
