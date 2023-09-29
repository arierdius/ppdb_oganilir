<?php

namespace App\Http\Livewire\Admin\PengumumanKelulusan;

use Livewire\Component;
use App\Models\Admin\PengumumanKelulusan as PengumumanKelulusanM;

class Index extends Component
{
    public $pengumuman_kelulusan, $dataId;

    public function render()
    {
        // get pengumuman kelulusan first
        // $pengumuman_kelulusan = PengumumanKelulusanM::first();

        return view('livewire.admin.pengumuman-kelulusan.index');
    }

    // mount
    public function mount()
    {
        // get pengumuman kelulusan first
        $pengumuman_kelulusan = PengumumanKelulusanM::first();
        $this->pengumuman_kelulusan = $pengumuman_kelulusan->status_pengumuman;
    }

    // data id
    // public function dataId($id)
    // {
    //     $this->dataId = $id;
    // }

    public function tampilkan()
    {
        $status_pengumuman = PengumumanKelulusanM::find('1');
        $status_pengumuman->status_pengumuman = 'ditampilkan';
        $status_pengumuman->save();
        session()->flash('success', 'Status kelulusan di Tampilkan');
        return redirect()->route('admin.pengumuman.kelulusan.index');
    }

    public function jangan_tampilkan()
    {
        $status_pengumuman = PengumumanKelulusanM::find('1');
        $status_pengumuman->status_pengumuman = 'tidak-ditampilkan';
        $status_pengumuman->save();
        session()->flash('success', 'Status kelulusan di Tidak Ditampilkan');
        return redirect()->route('admin.pengumuman.kelulusan.index');
    }


}
