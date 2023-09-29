<?php

namespace App\Http\Livewire\Sekolah\Perubahan;

use Livewire\Component;
use App\Models\Admin\Afirmasi as AdminAfirmasi;
use App\Models\Admin\Pendaftar as PendaftarM;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Intervention\Image\Facades\Image;

class Afirmasi extends Component
{
    use WithFileUploads;
    public $pendaftaran_id;
    public $sk_bta, $surat_pengantar_sd, $pkh_kip;
    public $sk_bta_baru, $surat_pengantar_sd_baru, $pkh_kip_baru;
    public $nama_lengkap, $nomor_pendaftaran;
    public $id_user;


    public function mount($id = null)
    {
        $this->pendaftaran_id = $id;
        $afirmasi = PendaftarM::find($id);
        $this->sk_bta = $afirmasi->afirmasi->sk_bta;
        $this->surat_pengantar_sd = $afirmasi->afirmasi->surat_pengantar_sd;
        $this->pkh_kip = $afirmasi->afirmasi->pkh_kip;
        $this->nama_lengkap = $afirmasi->detail->nama_lengkap;
        $this->nomor_pendaftaran = $afirmasi->no_pendaftaran;
        $this->id_user = $afirmasi->siswa_id;
    }

    public function render()
    {
        return view('livewire.sekolah.perubahan.afirmasi');
    }

    public function perbaruiData_proses()
    {
        // validasi
        $this->validate([
            'sk_bta_baru' => 'max:1024' . ($this->sk_bta_baru != null ? '|mimes:pdf' : ''),
            'pkh_kip_baru' => 'max:1024' . ($this->pkh_kip_baru != null ? '|mimes:pdf' : ''),
            'surat_pengantar_sd_baru' => 'max:1024' . ($this->surat_pengantar_sd_baru != null ? '|mimes:pdf' : ''),
        ]);

        // data afirmasi
        $afirmasi = AdminAfirmasi::where('pendaftaran_id', $this->pendaftaran_id)->first();
        // get id pendaftar
        $pendaftar = PendaftarM::where('id', $this->pendaftaran_id)->first();
        $siswa_id = $pendaftar['siswa_id'];

        if ($this->sk_bta_baru == null && $this->pkh_kip_baru == null && $this->surat_pengantar_sd_baru == null) {
            return $this->showToastr('error', '', 'Tidak ada data yang diperbarui.');
        }


        $sk_bta_baru = $this->sk_bta_baru;
        if ($this->sk_bta_baru != null) {
            if ($sk_bta_baru != null) {
                $filename = 'sk_bta-' . $siswa_id . '.' . $sk_bta_baru->getClientOriginalExtension();
                Storage::disk('public_uploads')->putFileAs('/storage/data_pendaftaran/', $sk_bta_baru, $filename);
                $afirmasi->sk_bta = $filename;
            }
        }

        $pkh_kip_baru = $this->pkh_kip_baru;
        if ($this->pkh_kip_baru != null) {
            if ($pkh_kip_baru != null) {
                $filename = 'pkh_kip-' . $siswa_id . '.' . $pkh_kip_baru->getClientOriginalExtension();
                Storage::disk('public_uploads')->putFileAs('/storage/data_pendaftaran/', $pkh_kip_baru, $filename);
                $afirmasi->pkh_kip = $filename;
            }
        }

        $surat_pengantar_sd_baru = $this->surat_pengantar_sd_baru;
        if ($this->surat_pengantar_sd_baru != null) {
            if ($surat_pengantar_sd_baru != null) {
                $filename = 'surat_pengantar_sd-' . $siswa_id . '.' . $surat_pengantar_sd_baru->getClientOriginalExtension();
                Storage::disk('public_uploads')->putFileAs('/storage/data_pendaftaran/', $surat_pengantar_sd_baru, $filename);
                $afirmasi->surat_pengantar_sd = $filename;
            }
        }

        // save data afirmasi
        $afirmasi->save();
        session()->flash('success', 'Data berhasil diperbarui !');
        return redirect()->route('admin.afirmasi.index');
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
