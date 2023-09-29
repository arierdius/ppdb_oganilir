<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;

class Dashboard extends Component
{
    use WithPagination;
    public function render()
    {
        // get count produk
        return view('livewire.admin.dashboard'
        );
    }
}
