<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

class ImportData extends Component
{
    public function render()
    {
        return view('livewire.import-data');
    }

    public function import()
    {
        Excel::import(new UsersImport, request()->file('file'));
        return redirect()->route('admin.user.index');
    }
}
