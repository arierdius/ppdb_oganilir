<?php

namespace App\Http\Livewire\Admin\SekolahArea;

use App\Models\Admin\Kelurahan;
use Livewire\Component;
use App\Models\Admin\Sekolah_area;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $dataId, $sekolah_id, $search, $dataid_sekolah, $data_sekolah_temp = [];
    public $pengumuman_add, $id_kelurahan;


    public function mount($id = null)
    {
        $this->sekolah_id = $id;
    }

    public function render()
    {
        $this->emit('reinitializeSelect2');

        // cek jika search berisi maka search
        if ($this->search != null) {
            $data_sekolah = Sekolah_area::where('sekolah_id', $this->sekolah_id)
                ->whereHas('kelurahan', function ($query) {
                    $query->where('nama_kelurahan', 'like', '%' . $this->search . '%');
                })->paginate(10);
        } else {
            $data_sekolah = Sekolah_area::where('sekolah_id', $this->sekolah_id)->paginate(10);
        }

        // get data kelurahan
        $data_kelurahan = Kelurahan::where('kecamatan_id', '1610020')->get();


        return view(
            'livewire.admin.sekolah-area.index',
            [
                'data_kelurahan' => $data_kelurahan,
                'data_sekolah' => $data_sekolah,
            ]
        );
    }

    // store
    public function store()
    {
        // dd($this->sekolah_id);
        // dd($this->id_kelurahan);
        foreach ($this->id_kelurahan as $key => $value) {
            $data = new Sekolah_area();
            $data->sekolah_id = $this->sekolah_id;
            $data->kelurahan_id = $value;
            $data->save();
        }
    }

    public function dataId($id)
    {
        $this->dataId = $id;
    }

    public function delete()
    {
        $data = Sekolah_area::find($this->dataId);
        $data->delete();
        session()->flash('success', 'Data berhasil dihapus');
        // redirect whit id this->sekolah_id
        return redirect()->route('admin.sekolah_area.index', $this->sekolah_id);
    }
}
