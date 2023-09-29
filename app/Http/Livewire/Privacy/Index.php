<?php

namespace App\Http\Livewire\Privacy;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.privacy.index')->layout('layouts.umum.app');
    }
}
