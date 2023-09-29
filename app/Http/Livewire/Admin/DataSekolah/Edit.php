<?php

namespace App\Http\Livewire\Admin\DataSekolah;

use Livewire\Component;
use App\Models\Admin\Sekolah;
use App\Models\Admin\Kecamatan;

class Edit extends Component
{
    public $id_sekolah, $nama_sekolah, $alamat, $kecamatan_id, $telepon, $kepala_sekolah, $situs_web;
    public function render()
    {
        // get data Kecamatan
        $kecamatan = Kecamatan::all();
        return view('livewire.admin.data-sekolah.edit', [
            'kecamatan' => $kecamatan
        ]);
    }

    // make dit data 
    public function mount($id)
    {
        $sekolah = Sekolah::find($id);
        $this->id_sekolah = $sekolah->id;
        $this->nama_sekolah = $sekolah->nama_sekolah;
        $this->alamat = $sekolah->alamat;
        $this->kecamatan_id = $sekolah->kecamatan_id;
        $this->telepon = $sekolah->telepon;
        $this->kepala_sekolah = $sekolah->kepala_sekolah;
        $this->situs_web = $sekolah->situs_web;
    }


    public function update()
    {
        $datasekolah = Sekolah::find($this->id_sekolah);
        $datasekolah->nama_sekolah = $this->nama_sekolah;
        $datasekolah->alamat = $this->alamat;
        $datasekolah->kecamatan_id = $this->kecamatan_id;
        $datasekolah->telepon = $this->telepon;
        $datasekolah->kepala_sekolah = $this->kepala_sekolah;
        $datasekolah->situs_web = $this->situs_web;
        $datasekolah->save();

        session()->flash('success','Berhasil Edit Data');
        return redirect()->route('admin.data_sekolah.index');

    }
}
