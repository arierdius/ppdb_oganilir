<?php

namespace App\Http\Livewire\Umum\Dashboard;

use Livewire\Component;
// use App\Models\Umum\Kontak;

class Index extends Component
{
    public function render()
    {
        // $kontak = Kontak::first();
        // // dd($kontak);

        return view(
            'livewire.umum.dashboard.index'
        )->layout('layouts.umum.app');
    }
}
