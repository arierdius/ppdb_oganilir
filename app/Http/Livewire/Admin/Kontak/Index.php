<?php

namespace App\Http\Livewire\Admin\Kontak;

use Livewire\Component;
use App\Models\Umum\Kontak;

class Index extends Component
{
    public $telp, $email, $alamat;

    public function render()
    {
        return view('livewire.admin.kontak.index');
    }

    // mount
    public function mount()
    {
        // get data first
        $kontak = Kontak::first();
        $this->telp = $kontak->telp;
        $this->email = $kontak->email;
        $this->alamat = $kontak->alamat;
    }

    // update
    public function update()
    {
        // dd($this->telp);
        $kontak = Kontak::first();
        $kontak->telp = $this->telp;
        $kontak->email = $this->email;
        $kontak->alamat = $this->alamat;
        $kontak->save();

        session()->flash('success', 'Data berhasil diupdate');
        redirect()->route('admin.kontak.index');
    }
}
