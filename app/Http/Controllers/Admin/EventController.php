<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventCategory;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function index(Request $request)
    {
        if (request()->ajax()) {
            $tableType = $request->input('table_type', 'events');
            
            if ($tableType === 'categories') {
                $data = EventCategory::latest()->get();
            } else {
                $data = Event::latest()->get();
            }
            
            return DataTables::of($data)->make(true);
        }
        
        return view('pages.admin.event.index');
    }

    public function create()
    {
        $data = null;
        return view('pages.admin.event.action', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'             => 'required',
            'description'       => 'required',
            'highlight_text'    => 'required'
        ]);

        Event::create([
            'title'          => $request->title,
            'description'    => $request->description,
            'highlight_text' => $request->highlight_text,
        ]);

        return redirect()->route('admin.event.index')->with(['create' => 'create']);
    }

    public function edit(Event $event)
    {
        $data = $event;
        return view('pages.admin.event.action', compact('data'));
    }

    public function update(Request $request, Event $event)
    {
        $request->validate([
            'title'          => 'required',
            'description'    => 'required',
            'highlight_text' => 'required'
        ]);
        
        $event->update([
            'title'          => $request->title,
            'description'    => $request->description,
            'highlight_text' => $request->highlight_text
        ]);

        return redirect()->route('admin.event.index')->with(['update' => 'update']);
    }

    public function delete(Event $event)
    {        
        $event->delete();
        
        return response()->json(['success' => true]);
    }
}
