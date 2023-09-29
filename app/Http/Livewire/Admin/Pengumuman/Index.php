<?php

namespace App\Http\Livewire\Admin\Pengumuman;

use Livewire\Component;
use App\Models\Admin\Pengumuman;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $dataId, $pengumuman_add, $search, $level;

    public function render()
    {
        if ($this->search) {
            $pengumuman = Pengumuman::where('pengumuman', 'like', '%' . $this->search . '%')->paginate(3);
        } else {
            $pengumuman = Pengumuman::orderBy('created_at', 'desc')->paginate(5);
        }


        return view('livewire.admin.pengumuman.index', ['pengumuman' => $pengumuman]);
    }

    // store
    public function store()
    {

        $validasi = $this->validate([
            'pengumuman_add' => 'required',
            'level' => 'required',
        ]);

        if ($validasi) {
            $pengumuman = new Pengumuman();
            $pengumuman->pengumuman = $this->pengumuman_add;
            $pengumuman->level = $this->level;
            $pengumuman->status = 'aktif';
            $pengumuman->created_at = now();
            $pengumuman->save();
        }




        session()->flash('success', 'Pengumuman Berhasil di Tambahkan');
        return redirect()->route('admin.pengumuman.index');
    }

    public function dataId($id)
    {
        $this->dataId = $id;
    }

    public function Matikan()
    {
        $zonasi = Pengumuman::find($this->dataId);
        $zonasi->status = 'nonaktif';
        $zonasi->save();
        session()->flash('success', 'Pengumuman di Nonaktifkan');
        return redirect()->route('admin.pengumuman.index');
    }

    public function Aktifkan()
    {
        $zonasi = Pengumuman::find($this->dataId);
        $zonasi->status = 'aktif';
        $zonasi->save();
        session()->flash('success', 'Pengumuman di Aktifkan');
        return redirect()->route('admin.pengumuman.index');
    }

    // delete
    public function delete()
    {
        $zonasi = Pengumuman::find($this->dataId);
        $zonasi->delete();
        session()->flash('success', 'Pengumuman di Hapus');
        return redirect()->route('admin.pengumuman.index');
    }
}
