<?php

namespace App\Http\Livewire\Sekolah\Operator;

use Livewire\Component;
use App\Models\Siswa\Profil as ProfilSiswa;
use App\Models\User;
use Livewire\WithFileUploads;
use Intervention\Image\Facades\Image;

class Profil extends Component
{
    use WithFileUploads;

    public $nama_lengkap, $nik, $jenis_kelamin, $tempat_lahir, $tanggal_lahir, $agama, $no_hp, $alamat, $foto, $prev_photo;
    public function render()
    {
        return view('livewire.sekolah.operator.profil');
    }

    public function mount()
    {
        // get data profil Siswa where id = auth()->user()->id
        $data_siswa = ProfilSiswa::where('user_id', auth()->user()->id)->first();
        $data_user = User::where('id', auth()->user()->id)->first();
        // jika data siswa null
        if ($data_siswa == null) {
            $this->nama_lengkap = '';
            $this->jenis_kelamin = '';
            $this->nik = '';
            $this->tempat_lahir = '';
            $this->tanggal_lahir = '';
            $this->agama = '';
            $this->no_hp = '';
            $this->alamat = '';
            $this->prev_photo = '';
        } else {
            // dd($data_siswa);
            $this->nama_lengkap = $data_siswa->nama_lengkap;
            $this->jenis_kelamin = $data_siswa->jenis_kelamin;
            $this->nik = $data_siswa->nik;
            $this->tempat_lahir = $data_siswa->tempat_lahir;
            $this->tanggal_lahir = $data_siswa->tanggal_lahir;
            $this->agama = $data_siswa->agama;
            $this->no_hp = $data_siswa->no_hp;
            $this->alamat = $data_siswa->alamat;
            $this->prev_photo = $data_siswa->foto;
        }
    }

    // update
    public function update()
    {
        $validasi = $this->validate([
            'nama_lengkap' => 'required',
            'jenis_kelamin' => 'required',
            'nik' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'agama' => 'required',
            'no_hp' => 'required',
            'alamat' => 'required',
            'foto' => 'image|max:1024',
        ]);

        if ($validasi) {


            // get data profil Siswa where id = auth()->user()->id
            $data_siswa = ProfilSiswa::where('user_id', auth()->user()->id)->first();

            $data_siswa->nama_lengkap = $this->nama_lengkap;
            $data_siswa->jenis_kelamin = $this->jenis_kelamin;
            $data_siswa->nik = $this->nik;
            $data_siswa->tempat_lahir = $this->tempat_lahir;
            $data_siswa->tanggal_lahir = $this->tanggal_lahir;
            $data_siswa->agama = $this->agama;
            $data_siswa->no_hp = $this->no_hp;
            $data_siswa->alamat = $this->alamat;

            if ($this->foto) {
                $file = $this->foto;
                $fileName =  $data_siswa->nama_lengkap . '-' . $data_siswa->tanggal_lahir . '.' . $file->getClientOriginalExtension();

                // ORIGINAL
                $destinationPath = public_path('/storage/foto_siswa/');
                $img = Image::make($file->getRealPath());
                $QuploadImage = $img->resize(1080, 1080, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath . $fileName, 100);

                $data_siswa->foto = $fileName;
            }
            $data_siswa->save();

            // update user
            $data_user = User::where('id', auth()->user()->id)->first();
            $data_user->save();

            session()->flash('success', 'Data berhasil di ubah');
            return redirect()->route('sekolah.profil.index');
        } else {
            session()->flash('error', 'Data Gagal di Update');
            return redirect()->route('sekolah.profil.index');
        }
    }
}
