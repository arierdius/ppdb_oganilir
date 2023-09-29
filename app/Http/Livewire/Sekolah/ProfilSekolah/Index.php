<?php

namespace App\Http\Livewire\Sekolah\ProfilSekolah;

use Livewire\Component;
use App\Models\Admin\Sekolah;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use Intervention\Image\Facades\Image;
use Termwind\Components\Dd;

class Index extends Component
{
    use WithFileUploads;
    public $nama_sekolah, $alamat, $npsn, $kepala_sekolah, $telepon, $latitude, $longitude, $faksmili, $akreditasi, $surel, $situs_web,
        $foto, $logo, $visi_misi, $prev_photo;
    public function render()
    {
        // dd(auth()->user()->role_id);
        // get data from sekolah where Auth::user()->sekolah_id
        $sekolah = Sekolah::where('id', Auth::user()->sekolah_id)->first();

        return view('livewire.sekolah.profil-sekolah.index', ['sekolah' => $sekolah]);
    }

    // mount data sekolah
    public function mount()
    {
        $sekolah = Sekolah::where('id', Auth::user()->sekolah_id)->first();
        $this->nama_sekolah = $sekolah->nama_sekolah;
        $this->npsn = $sekolah->npsn;
        $this->kepala_sekolah = $sekolah->kepala_sekolah;
        $this->telepon = $sekolah->telepon;
        $this->latitude = $sekolah->latitude;
        $this->longitude = $sekolah->longitude;
        $this->faksmili = $sekolah->faksmili;
        $this->akreditasi = $sekolah->akreditasi;
        $this->surel = $sekolah->surel;
        $this->alamat = $sekolah->alamat;
        $this->situs_web = $sekolah->situs_web;
        $this->prev_photo = $sekolah->logo;
        $this->visi_misi = $sekolah->visi_misi;
    }

    // updated data sekolah
    public function update()
    {

        $validasi = $this->validate([
            'nama_sekolah' => 'required',
            'npsn' => 'required',
            'kepala_sekolah' => 'required',
            'telepon' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'faksmili' => 'required',
            'akreditasi' => 'required',
            'surel' => 'required',
            'alamat' => 'required',
            'situs_web' => 'required',
            'logo' => 'required',
            'visi_misi' => 'required',
        ], [
            'nama_sekolah.required' => 'Nama Sekolah Tidak Boleh Kosong',
            'npsn.required' => 'NPSN Tidak Boleh Kosong',
            'kepala_sekolah.required' => 'Kepala Sekolah Tidak Boleh Kosong',
            'telepon.required' => 'Telepon Tidak Boleh Kosong',
            'latitude.required' => 'Latitude Tidak Boleh Kosong',
            'longitude.required' => 'Longitude Tidak Boleh Kosong',
            'faksmili.required' => 'Faksimile Tidak Boleh Kosong',
            'akreditasi.required' => 'Akreditasi Tidak Boleh Kosong',
            'surel.required' => 'Surel Tidak Boleh Kosong',
            'alamat.required' => 'Alamat Tidak Boleh Kosong',
            'situs_web.required' => 'Situs Web Tidak Boleh Kosong',
            'logo.required' => 'Logo Tidak Boleh Kosong',
            'visi_misi.required' => 'Visi Misi Tidak Boleh Kosong',
        ]);

        if ($validasi) {
            $sekolah = Sekolah::where('id', Auth::user()->sekolah_id)->first();
            $sekolah->nama_sekolah = $this->nama_sekolah;
            $sekolah->npsn = $this->npsn;
            $sekolah->kepala_sekolah = $this->kepala_sekolah;
            $sekolah->telepon = $this->telepon;
            $sekolah->latitude = $this->latitude;
            $sekolah->longitude = $this->longitude;
            $sekolah->faksmili = $this->faksmili;
            $sekolah->akreditasi = $this->akreditasi;
            $sekolah->surel = $this->surel;
            $sekolah->alamat = $this->alamat;

            if ($this->logo) {
                $files = $this->logo;
                $fileName =  'logo_sekolah-' . Auth::user()->sekolah_id . '.' . $files->getClientOriginalExtension();

                // ORIGINAL
                $destinationPath = public_path('/storage/data_sekolah/');

                $img = Image::make($files->getRealPath());
                $QuploadImage = $img->resize(1080, 1080, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath . $fileName, 100);
                $sekolah->logo = $fileName;
            }

            $sekolah->situs_web = $this->situs_web;
            $sekolah->visi_misi = $this->visi_misi;
            $sekolah->save();

            session()->flash('success', 'Data Sekolah Berhasil Diperbarui !');
            return redirect()->route('sekolah.profil_sekolah.index');
        }
    }
}
