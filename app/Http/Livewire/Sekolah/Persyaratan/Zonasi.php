<?php

namespace App\Http\Livewire\Sekolah\Persyaratan;

use App\Models\Admin\Persyaratan;
use Livewire\Component;
use Livewire\WithPagination;


class Zonasi extends Component
{
    protected $paginationTheme = 'bootstrap';
    use WithPagination;

    public $nama_surat, $sekolah_id, $id_persyaratan;
    public function render()
    {
        // get persyaratan where sekolah_id with paginate
        $persyaratan = Persyaratan::where('sekolah_id', auth()->user()->sekolah_id)
        ->where('jalur', 'zonasi')
        ->paginate('10');
        // dd($persyaratan);
        return view('livewire.sekolah.persyaratan.zonasi', [
            'persyaratan' => $persyaratan
        ]);
    }

    // resetField
    public function resetField()
    {
        $this->nama_surat = '';
        $this->sekolah_id = '';
        $this->id_persyaratan = '';
    }

    public function edit($id)
    {
        // $persyaratan = Persyaratan::find($id);
        // dd($persyaratan);
        // $this->nama_surat = $persyaratan->nama_surat;
        // $this->sekolah_id = $persyaratan->sekolah_id;
        $persyaratan = Persyaratan::find($id);
        $nama_surat = $persyaratan->nama_surat;
        $new_nama_surat = strtr($nama_surat, '_', ' ');
        $this->nama_surat = $new_nama_surat;
        $this->sekolah_id = $persyaratan->sekolah_id;
        $this->id_persyaratan = $persyaratan->id;
    }

    // make update data
    public function update()
    {
        $this->validate([
            'nama_surat' => 'required',
        ]);

        $nama_file_temp = strtr($this->nama_surat, " ", "_");
        $nama_file = strtolower($nama_file_temp);

        $persyaratan = Persyaratan::find($this->id_persyaratan);
        $persyaratan->sekolah_id = auth()->user()->sekolah_id;
        $persyaratan->nama_surat = $nama_file;
        $persyaratan->save();

        session()->flash('success', 'Data berhasil diperbarui !');
        return redirect()->route('sekolah.persyaratan.zonasi.index');
    }

    // make store nama persyaratan
    public function store()
    {
        $this->validate([
            'nama_surat' => 'required',
        ]);

        $nama_file_temp = strtr($this->nama_surat, " ", "_");
        $nama_file = strtolower($nama_file_temp);

        $persyaratan = new Persyaratan();
        $persyaratan->sekolah_id = auth()->user()->sekolah_id;
        $persyaratan->jalur = 'zonasi';
        $persyaratan->nama_surat = $nama_file;
        $persyaratan->save();

        session()->flash('success', 'Data berhasil ditambahkan !');
        return redirect()->route('sekolah.persyaratan.zonasi.index');
    }

    public function delete($id)
    {
        $data = Persyaratan::find($id);
        if ($data) {
            $data->delete();
            session()->flash('success', 'Data berhasil dihapus !');
        } else {
            $this->showToastr('error', '', 'Something Error.');
        }
        return redirect()->route('sekolah.persyaratan.zonasi.index');
    }
}
