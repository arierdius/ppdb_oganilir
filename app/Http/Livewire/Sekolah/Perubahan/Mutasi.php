<?php

namespace App\Http\Livewire\Sekolah\Perubahan;

use Livewire\Component;
use App\Models\Admin\Mutasi as AdminMutasi;
use App\Models\Admin\Pendaftar as PendaftarM;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Intervention\Image\Facades\Image;

class Mutasi extends Component
{

    use WithFileUploads;
    public $pendaftaran_id;
    public $sk_bta, $surat_pengantar_sd, $sk_mutasi_orang_tua;
    public $sk_bta_baru, $surat_pengantar_sd_baru, $sk_mutasi_orang_tua_baru;
    public $nama_lengkap, $nomor_pendaftaran;

    public $id_user;
    // public $nama_lengkap, $nomor_pendaftaran;
    // public $sk_bta_baru, $kartu_keluarga_baru, $surat_pengantar_sd_baru;


    public function mount($id = null)
    {
        $this->pendaftaran_id = $id;
        $mutasi = PendaftarM::find($id);
        $this->sk_bta = $mutasi->mutasi->sk_bta;
        $this->surat_pengantar_sd = $mutasi->mutasi->surat_pengantar_sd;
        $this->sk_mutasi_orang_tua = $mutasi->mutasi->sk_mutasi_orang_tua;
        $this->nama_lengkap = $mutasi->detail->nama_lengkap;
        $this->nomor_pendaftaran = $mutasi->no_pendaftaran;
        $this->id_user = $mutasi->siswa_id;
    }

    public function render()
    {
        $data = AdminMutasi::where('pendaftaran_id', $this->pendaftaran_id)->get();

        return view('livewire.sekolah.perubahan.mutasi');
    }



    public function perbaruiData_proses()
    {
        // validasi
        $this->validate([
            'sk_bta_baru' => 'max:1024' . ($this->sk_bta_baru != null ? '|mimes:pdf' : ''),
            'sk_mutasi_orang_tua' => 'max:1024' . ($this->sk_mutasi_orang_tua != null ? '|mimes:pdf' : ''),
            'surat_pengantar_sd_baru' => 'max:1024' . ($this->surat_pengantar_sd_baru != null ? '|mimes:pdf' : ''),
        ]);

        // data mutasi
        $mutasi = AdminMutasi::where('pendaftaran_id', $this->pendaftaran_id)->first();

        if($this->sk_bta_baru == null AND $this->surat_pengantar_sd_baru == null AND $this->sk_mutasi_orang_tua_baru == null){
           return $this->showToastr('error', '', 'Tidak ada data yang diperbarui.');
        }

        $sk_bta_baru = $this->sk_bta_baru;
        if ($this->sk_bta_baru != null) {
            if ($sk_bta_baru != null) {
                $filename = 'surat_pengantar_sd-' . $siswa_id . '.' . $sk_bta_baru->getClientOriginalExtension();
                Storage::disk('public_uploads')->putFileAs('/storage/test_doang/', $sk_bta_baru, $filename);
                $mutasi->sk_bta = $filename;
            }
        }

        $sk_mutasi_orang_tua_baru = $this->sk_mutasi_orang_tua_baru;
        if ($this->sk_mutasi_orang_tua_baru != null) {
            if ($sk_mutasi_orang_tua_baru != null) {
                $filename = 'surat_pengantar_sd-' . $siswa_id . '.' . $sk_mutasi_orang_tua_baru->getClientOriginalExtension();
                Storage::disk('public_uploads')->putFileAs('/storage/test_doang/', $sk_mutasi_orang_tua_baru, $filename);
                $mutasi->sk_mutasi_orang_tua = $filename;
            }
        }

        $surat_pengantar_sd_baru = $this->surat_pengantar_sd_baru;
        if ($this->surat_pengantar_sd_baru != null) {
            if ($surat_pengantar_sd_baru != null) {
                $filename = 'surat_pengantar_sd-' . $siswa_id . '.' . $surat_pengantar_sd_baru->getClientOriginalExtension();
                Storage::disk('public_uploads')->putFileAs('/storage/test_doang/', $surat_pengantar_sd_baru, $filename);
                $mutasi->surat_pengantar_sd = $filename;
            }
        }

        $mutasi->save();
        session()->flash('success', 'Data berhasil diperbarui !');
        return redirect()->route('admin.mutasi.index');

    }

    public function showToastr($icon, $text, $title)
    {
        $this->emit('swal:alert', [
            'icon' => $icon,
            'title' => $title,
            'text' => $text,
            'timeout'   => 1000
        ]);
    }
}
