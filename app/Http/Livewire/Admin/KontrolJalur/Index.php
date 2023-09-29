<?php

namespace App\Http\Livewire\Admin\KontrolJalur;

use Livewire\Component;
use App\Models\Admin\Kontrol_jalur;

class Index extends Component
{
    public $tanggal_buka, $tanggal_tutup, $dataId, $jalur;

    public function render()
    {
        $kontrol_jalur = Kontrol_jalur::where('jenis_sekolah_id', '3')->get();

        return view('livewire.admin.kontrol-jalur.index', ['kontrol_jalur' => $kontrol_jalur]);
    }

    // data id
    public function dataId($id)
    {
        $this->dataId = $id;
        // dd($id);
        $kontrol_jalur = Kontrol_jalur::find($id);
        $this->jalur = $kontrol_jalur->jalur;
        $this->tanggal_buka = $kontrol_jalur->tanggal_buka;
        $this->tanggal_tutup = $kontrol_jalur->tanggal_tutup;
    }

    // update
    public function update()
    {
        $kontrol_jalur = Kontrol_jalur::find($this->dataId);
        // dd($kontrol_jalur);
        $kontrol_jalur->tanggal_buka = $this->tanggal_buka;
        $kontrol_jalur->tanggal_tutup = $this->tanggal_tutup;
        $kontrol_jalur->save();

        session()->flash('success', 'Data berhasil diupdate');
        redirect()->route('admin.kontrol_jalur.index');
    }

}
