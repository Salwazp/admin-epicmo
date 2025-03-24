<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MomentButton;

class MomentButtonController extends Controller {
    public function index() {
        $buttons = MomentButton::all();
        return view('pages.admin.button_moment.index', compact('buttons'));
    }

    public function create() {
        return view('pages.admin.button_moment.action');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'title' => 'required|string|max:255',
            'link_button' => 'required|url',
        ]);

        MomentButton::create([
            'title' => $request->title,
            'link_button' => $request->link_button,
        ]);

        return redirect()->route('admin.button_moment.index')->with('success', 'Button Moment berhasil ditambahkan!');
    }

    public function edit($id) {
        $button = MomentButton::findOrFail($id);
        return view('pages.admin.button_moment.action', compact('button'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'title' => 'required|string|max:255',
            'link_button' => 'required|url',
        ]);

        $button = MomentButton::findOrFail($id);
        $button->update([
            'title' => $request->title,
            'link_button' => $request->link_button,
        ]);

        return redirect()->route('admin.button_moment.index')->with('success', 'Button Moment berhasil diperbarui!');
    }

    public function destroy($id) {
        $button = MomentButton::findOrFail($id);
        $button->delete();

        return redirect()->route('admin.button_moment.index')->with('success', 'Button Moment berhasil dihapus!');
    }

    public function action() {
        return view('pages.admin.button_moment.action');
    }
}
