<?php

namespace App\Http\Livewire\Sekolah\Perubahan;

use Livewire\Component;
use App\Models\Admin\Zonasi as AdminZonasi;
use App\Models\Admin\Pendaftar as PendaftarM;
use App\Models\Admin\Sekolah;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Intervention\Image\Facades\Image;

class Zonasi extends Component
{

    use WithFileUploads;
    public $pendaftaran_id;
    public $latitude_siswa, $longitude_siswa, $usia_kk, $jarak, $file_kk, $sk_bta, $surat_pengantar_sd;
    public $nama_lengkap, $nomor_pendaftaran;
    public $sk_bta_baru, $kartu_keluarga_baru, $surat_pengantar_sd_baru;


    public function mount($id = null)
    {
        $this->pendaftaran_id = $id;
        $zonasi = PendaftarM::find($id);
        $this->latitude_siswa = $zonasi->zonasi->latitude_siswa;
        $this->longitude_siswa = $zonasi->zonasi->longitude_siswa;
        $this->usia_kk = $zonasi->zonasi->usia_kk;
        $this->jarak = $zonasi->zonasi->jarak;
        $this->file_kk = $zonasi->zonasi->file_kk;
        $this->sk_bta = $zonasi->zonasi->sk_bta;
        $this->surat_pengantar_sd = $zonasi->zonasi->surat_pengantar_sd;
        $this->nama_lengkap = $zonasi->detail->nama_lengkap;
        $this->nomor_pendaftaran = $zonasi->no_pendaftaran;
    }

    public function render()
    {
        $data = AdminZonasi::where('pendaftaran_id', $this->pendaftaran_id)->get();
        return view('livewire.sekolah.perubahan.zonasi');
    }

    public function cek_jarak()
    {
        $sekolah = Sekolah::where('id', auth()->user()->sekolah_id)->first();

        $latitude_sekolah = $sekolah->latitude;
        $longitude_sekolah = $sekolah->longitude;
        $latitude_siswa = $this->latitude_siswa;
        $longitude_siswa = $this->longitude_siswa;

        $theta = $longitude_sekolah - $longitude_siswa;
        $miles = (sin(deg2rad($latitude_sekolah)) * sin(deg2rad($latitude_siswa))) + (cos(deg2rad($latitude_sekolah)) * cos(deg2rad($latitude_siswa)) * cos(deg2rad($theta)));
        $miles = acos($miles);
        $miles = rad2deg($miles);
        $miles = $miles * 60 * 1.1515;
        $kilometers = $miles * 1.609344;
        $meters = $kilometers * 1000;
        $this->jarak = $meters;
    }



    public function perbaruiData_proses()
    {
        // validasi
        $this->validate([
            'latitude_siswa' => 'required',
            'longitude_siswa' => 'required',
            'jarak' => 'required',
            'sk_bta_baru' => 'max:1024' . ($this->sk_bta_baru != null ? '|mimes:pdf' : ''),
            'kartu_keluarga_baru' => 'max:1024' . ($this->kartu_keluarga_baru != null ? '|mimes:pdf' : ''),
            'surat_pengantar_sd_baru' => 'max:1024' . ($this->surat_pengantar_sd_baru != null ? '|mimes:pdf' : ''),
        ]);

        // cek $this->jarak explode .
        $jarak_detail_temp = explode('.', $this->jarak);
        // jika satu maka tidak ada koma
        if (count($jarak_detail_temp) == 1) {
            $jarak_detail = $jarak_detail_temp[0];
        } else {
            // ambil 3 char dari $jarak_detail_temp[1]
            $jarak_detail = $jarak_detail_temp[0] . '.' . substr($jarak_detail_temp[1], 0, 3);
        }

        // data zonasi
        $zonasi = AdminZonasi::where('pendaftaran_id', $this->pendaftaran_id)->first();
        // get id pendaftar
        $pendaftar = PendaftarM::where('id', $this->pendaftaran_id)->first();
        $siswa_id = $pendaftar['siswa_id'];

        // jika ada koma pada $this->latitude_siswa maka diganti jadi titik
        $this->latitude_siswa = str_replace(',', '.', $this->latitude_siswa);
        $this->longitude_siswa = str_replace(',', '.', $this->longitude_siswa);

        $zonasi->latitude_siswa = $this->latitude_siswa;
        $zonasi->longitude_siswa = $this->longitude_siswa;
        $zonasi->jarak = $this->jarak;
        $zonasi->jarak_detail = $jarak_detail;
        // $zonasi->save();

        // if ($this->sk_bta_baru == null && $this->kartu_keluarga_baru == null && $this->surat_pengantar_sd_baru == null) {
        //     return $this->showToastr('error', '', 'Tidak ada data yang diperbarui.');
        // }

        $surat = $this->sk_bta_baru;
        if ($this->sk_bta_baru != null) {
            if ($surat != null) {
                $filename = 'surat_pengantar_sd-' . $siswa_id . '.' . $surat->getClientOriginalExtension();
                Storage::disk('public_uploads')->putFileAs('/storage/data_pendaftaran/', $surat, $filename);
                $zonasi->sk_bta = $filename;
            }
        }


        $kartu_keluarga_baru = $this->kartu_keluarga_baru;
        if ($this->kartu_keluarga_baru != null) {
            if ($kartu_keluarga_baru != null) {
                $filename = 'surat_pengantar_sd-' . $siswa_id . '.' . $kartu_keluarga_baru->getClientOriginalExtension();
                Storage::disk('public_uploads')->putFileAs('/storage/data_pendaftaran/', $kartu_keluarga_baru, $filename);
                $zonasi->file_kk = $filename;
            }
        }

        $surat_pengantar_sd_baru = $this->surat_pengantar_sd_baru;
        if ($this->surat_pengantar_sd_baru != null) {
            if ($surat_pengantar_sd_baru != null) {
                $filename = 'surat_pengantar_sd-' . $siswa_id . '.' . $surat_pengantar_sd_baru->getClientOriginalExtension();
                Storage::disk('public_uploads')->putFileAs('/storage/data_pendaftaran/', $surat_pengantar_sd_baru, $filename);
                $zonasi->surat_pengantar_sd = $filename;
            }
        }

        // save data zonasi
        $zonasi->save();
        session()->flash('success', 'Data berhasil diperbarui !');
        return redirect()->route('admin.zonasi.index');
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
