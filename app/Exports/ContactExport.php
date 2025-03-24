<?php

namespace App\Exports;

use App\Models\ApplyVacancy;
use App\Models\ContactForm;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ContactExport implements FromView
{
    use Exportable;


    public function view(): View
    {
        return view('exports.contact', [
            'contact'   => ContactForm::select('id', 'name', 'email', 'message', 'created_at')->get()
        ]);
    }
}
