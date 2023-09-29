<?php

namespace App\Http\Livewire\Admin\Jadwal;

use Livewire\Component;
use App\Models\Admin\Jadwal;

class Index extends Component
{
    public $tanggal, $waktu, $dataId, $kegiatan;

    public function render()
    {
        // get data from jadwal
        $jadwal = Jadwal::all();

        return view('livewire.admin.jadwal.index', ['jadwal' => $jadwal]);
    }


    // data id
    public function dataId($id)
    {
        $this->dataId = $id;
        $jadwal = Jadwal::find($id);
        $this->tanggal = $jadwal->tanggal;
        $this->waktu = $jadwal->waktu;
    }

    // reset input
    public function resetInput()
    {
        $this->tanggal = null;
        $this->waktu = null;
        $this->kegiatan = null;
    }

    // store
    public function store()
    {
        $this->validate([
            'tanggal' => 'required',
            'waktu' => 'required',
            'kegiatan'  => 'required',
        ]);

        $data_save = New Jadwal;
        $data_save->tanggal = $this->tanggal;
        $data_save->waktu = $this->waktu;
        $data_save->kegiatan = $this->kegiatan;
        $data_save->save();

        session()->flash('success', 'Data berhasil ditambahkan');
        redirect()->route('admin.jadwal.index');
    }

    // update
    public function update()
    {
        $jadwal = Jadwal::find($this->dataId);
        $jadwal->tanggal = $this->tanggal;
        $jadwal->waktu = $this->waktu;
        $jadwal->save();

        session()->flash('success', 'Data berhasil diupdate');
        redirect()->route('admin.jadwal.index');
    }

    // delete
    public function delete()
    {
        $jadwal = Jadwal::find($this->dataId);
        $jadwal->delete();
        session()->flash('success', 'Jadwal di Hapus');
        return redirect()->route('admin.jadwal.index');
    }
}
