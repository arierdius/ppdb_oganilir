<?php

namespace App\Http\Livewire\Sekolah\Perubahan;

use Livewire\Component;
use App\Models\Admin\Prestasi as AdminPrestasi;
use App\Models\Admin\Pendaftar as PendaftarM;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Intervention\Image\Facades\Image;

class Prestasi extends Component
{
    use WithFileUploads;
    public $pendaftaran_id;
    public $sk_bta, $surat_pengantar_sd;
    public $suket_rumah_tahfidz, $akumulasi_raport, $menang_lomba, $raport, $sertifikat_kabupaten, $sertifikat_provinsi, $sertifikat_nasional, $sertifikat_internasional;
    public $suket_rumah_tahfidz_baru, $akumulasi_raport_baru, $raport_baru ,$menang_lomba_baru, $rapor_baru, $sertifikat_kabupaten_baru, $sertifikat_provinsi_baru, $sertifikat_nasional_baru, $sertifikat_internasional_baru;
    public $pesan_persyaratan, $pendaftarant, $agama_user;
    public $sk_bta_baru, $surat_pengantar_sd_baru;
    public $nama_lengkap, $nomor_pendaftaran;

    public function mount($id = null)
    {
        $this->pendaftaran_id = $id;
        $prestasi = PendaftarM::find($id);
        $this->sk_bta = $prestasi->prestasi->sk_bta;
        $this->surat_pengantar_sd = $prestasi->prestasi->surat_pengantar_sd;
        // akademik
        $this->raport = $prestasi->prestasi->raport;
        $this->akumulasi_raport = $prestasi->prestasi->akumulasi_raport;
        $this->menang_lomba = $prestasi->prestasi->menang_lomba;
        // hafidz
        $this->suket_rumah_tahfidz = $prestasi->prestasi->suket_rumah_tahfidz;
        // non akademik
        $this->sertifikat_kabupaten = $prestasi->prestasi->sertifikat_kabupaten;
        $this->sertifikat_provinsi = $prestasi->prestasi->sertifikat_provinsi;
        $this->sertifikat_nasional = $prestasi->prestasi->sertifikat_nasional;
        $this->sertifikat_internasional = $prestasi->prestasi->sertifikat_internasional;

        $this->nama_lengkap = $prestasi->detail->nama_lengkap;
        $this->nomor_pendaftaran = $prestasi->no_pendaftaran;
    }

    public function render()
    {
        return view('livewire.sekolah.perubahan.prestasi');
    }

    public function perbaruiData_proses()
    {
        $this->validate([
            'sk_bta_baru' => 'max:1024' . ($this->sk_bta_baru != null ? '|mimes:pdf' : ''),
            'surat_pengantar_sd_baru' => 'max:1024' . ($this->surat_pengantar_sd_baru != null ? '|mimes:pdf' : ''),
            'raport_baru' => 'max:1024' . ($this->raport_baru != null ? '|mimes:pdf' : ''),
            'akumulasi_raport_baru' => 'max:1024' . ($this->akumulasi_raport_baru != null ? '|mimes:pdf' : ''),
            'menang_lomba_baru' => 'max:1024' . ($this->menang_lomba_baru != null ? '|mimes:pdf' : ''),
            'suket_rumah_tahfidz_baru'  => 'max:1024' . ($this->suket_rumah_tahfidz_baru != null ? '|mimes:pdf' : ''),
            'sertifikat_kabupaten_baru' => 'max:1024' . ($this->sertifikat_kabupaten_baru != null ? '|mimes:pdf' : ''),
            'sertifikat_provinsi_baru' => 'max:1024' . ($this->sertifikat_provinsi_baru != null ? '|mimes:pdf' : ''),
            'sertifikat_nasional_baru' => 'max:1024' . ($this->sertifikat_nasional_baru != null ? '|mimes:pdf' : ''),
            'sertifikat_internasional_baru' => 'max:1024' . ($this->sertifikat_internasional_baru != null ? '|mimes:pdf' : ''),
        ]);


        // data zonasi
        $prestasi = AdminPrestasi::where('pendaftaran_id', $this->pendaftaran_id)->first();
        // get id pendaftar
        $pendaftar = PendaftarM::where('id', $this->pendaftaran_id)->first();
        $siswa_id = $pendaftar['siswa_id'];
        $surat = $this->surat_pengantar_sd_baru;
        if ($surat != null) {
            $filename = 'surat_pengantar_sd-'. $siswa_id. '.' . $surat->getClientOriginalExtension();
            Storage::disk('public_uploads')->putFileAs('/storage/data_pendaftaran/', $surat, $filename);
            $prestasi->surat_pengantar_sd = $filename;
        }

        $sk_bta_baru = $this->sk_bta_baru;
        if ($sk_bta_baru != null) {
            $filename = 'sk_bta-' . $siswa_id. '.' . $sk_bta_baru->getClientOriginalExtension();
            Storage::disk('public_uploads')->putFileAs('/storage/data_pendaftaran/', $sk_bta_baru, $filename);
            $prestasi->sk_bta = $filename;
        }

        $raport_baru = $this->raport_baru;
        if ($raport_baru != null) {
            $filename = 'raport-' . $siswa_id. '.' . $raport_baru->getClientOriginalExtension();
            Storage::disk('public_uploads')->putFileAs('/storage/data_pendaftaran/', $raport_baru, $filename);
            $prestasi->raport = $filename;
        }

        $akumulasi_raport_baru = $this->akumulasi_raport_baru;
        if ($akumulasi_raport_baru != null) {
            $filename = 'akumulasi_raport-' . $siswa_id. '.' . $akumulasi_raport_baru->getClientOriginalExtension();
            Storage::disk('public_uploads')->putFileAs('/storage/data_pendaftaran/', $akumulasi_raport_baru, $filename);
            $prestasi->akumulasi_raport = $filename;
        }

        $menang_lomba_baru = $this->menang_lomba_baru;
        if ($menang_lomba_baru != null) {
            $filename = 'menang_lomba-' . $siswa_id. '.' . $menang_lomba_baru->getClientOriginalExtension();
            Storage::disk('public_uploads')->putFileAs('/storage/data_pendaftaran/', $menang_lomba_baru, $filename);
            $prestasi->menang_lomba = $filename;
        }

        $suket_rumah_tahfidz_baru = $this->suket_rumah_tahfidz_baru;
        if ($suket_rumah_tahfidz_baru != null) {
            $filename = 'suket_rumah_tahfidz-' . $siswa_id. '.' . $suket_rumah_tahfidz_baru->getClientOriginalExtension();
            Storage::disk('public_uploads')->putFileAs('/storage/data_pendaftaran/', $suket_rumah_tahfidz_baru, $filename);
            $prestasi->suket_rumah_tahfidz = $filename;
        }

        $sertifikat_kabupaten_baru = $this->sertifikat_kabupaten_baru;
        if ($sertifikat_kabupaten_baru != null) {
            $filename = 'sertifikat_kabupaten-' . $siswa_id. '.' . $sertifikat_kabupaten_baru->getClientOriginalExtension();
            Storage::disk('public_uploads')->putFileAs('/storage/data_pendaftaran/', $sertifikat_kabupaten_baru, $filename);
            $prestasi->sertifikat_kabupaten = $filename;
        }

        $sertifikat_provinsi_baru = $this->sertifikat_provinsi_baru;
        if ($sertifikat_provinsi_baru != null) {
            $filename = 'sertifikat_provinsi-' . $siswa_id. '.' . $sertifikat_provinsi_baru->getClientOriginalExtension();
            Storage::disk('public_uploads')->putFileAs('/storage/data_pendaftaran/', $sertifikat_provinsi_baru, $filename);
            $prestasi->sertifikat_provinsi = $filename;
        }

        $sertifikat_nasional_baru = $this->sertifikat_nasional_baru;
        if ($sertifikat_nasional_baru != null) {
            $filename = 'sertifikat_nasional-' . $siswa_id. '.' . $sertifikat_nasional_baru->getClientOriginalExtension();
            Storage::disk('public_uploads')->putFileAs('/storage/data_pendaftaran/', $sertifikat_nasional_baru, $filename);
            $prestasi->sertifikat_nasional = $filename;
        }

        $sertifikat_internasional_baru = $this->sertifikat_internasional_baru;
        if ($sertifikat_internasional_baru != null) {
            $filename = 'sertifikat_internasional-' . $siswa_id. '.' . $sertifikat_internasional_baru->getClientOriginalExtension();
            Storage::disk('public_uploads')->putFileAs('/storage/data_pendaftaran/', $sertifikat_internasional_baru, $filename);
            $prestasi->sertifikat_internasional = $filename;
        }
        $prestasi->save();
        session()->flash('success', 'Data berhasil diperbarui !');
        return redirect()->route('admin.prestasi.index');
    }
}
