<?php

namespace App\Http\Livewire\Admin\DataSekolah;

use App\Models\Admin\Kelurahan;
use Livewire\Component;
use App\Models\Admin\Sekolah;
use App\Models\Admin\Sekolah_area;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $id_sekolah, $nama_sekolah, $npsn, $kepala_sekolah, $telepon, $kelurahan_id, $alamat;

    public function render()
    {
        $this->emit('reinitializeSelect2');
        $sekolah_filter = Sekolah::where('status_sekolah', 'negeri')
            ->where('jenis_sekolah_id', '3')
            ->get();

        // dd($sekolah_filter);

        if ($this->id_sekolah) {
            $data_sekolah = Sekolah::where('id', $this->id_sekolah)->paginate(10);
        } else {
            $data_sekolah =  Sekolah::where('status_sekolah', 'negeri')
                ->where('jenis_sekolah_id', '3')
                ->paginate(10);
        }

        // get kelurahan where kecamatan id 1610020
        $kelurahan = Kelurahan::where('kecamatan_id', '1610020')->get();


        // dd($kelurahan);
        // make get data sekolah with paginate
        return view(
            'livewire.admin.data-sekolah.index',
            [
                'sekolah_filter' => $sekolah_filter,
                'data_sekolah' => $data_sekolah,
                'kelurahan' => $kelurahan
            ]
        );
    }

    // reset input
    public function resetInput()
    {
        $this->nama_sekolah = null;
        $this->npsn = null;
        $this->kepala_sekolah = null;
        $this->telepon = null;
        $this->kelurahan_id = null;
        $this->alamat = null;
    }

    public function store()
    {
        // dd($this->nama_sekolah, $this->npsn, $this->kepala_sekolah, $this->telepon, $this->kelurahan_id, $this->alamat);
        $validasi = $this->validate([
            'nama_sekolah' => 'required',
            'npsn' => 'required',
            'kepala_sekolah' => 'required',
            'telepon' => 'required',
            'kelurahan_id' => 'required',
            'alamat' => 'required',
        ]);

        if ($validasi) {
            $data_save = new Sekolah();
            $data_save->status_sekolah = 'negeri';
            $data_save->jenis_sekolah_id = '3';
            $data_save->nama_sekolah = $this->nama_sekolah;
            $data_save->npsn = $this->npsn;
            $data_save->kepala_sekolah = $this->kepala_sekolah;
            $data_save->telepon = $this->telepon;
            $data_save->kelurahan_id = $this->kelurahan_id;
            $data_save->alamat = $this->alamat;
            $data_save->save();
            session()->flash('success', 'Data berhasil ditambahkan');
            redirect()->route('admin.data_sekolah.index');
        }
    }
}
