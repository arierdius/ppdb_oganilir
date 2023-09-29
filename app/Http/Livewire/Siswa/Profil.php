<?php

namespace App\Http\Livewire\Siswa;

use App\Models\Admin\Kabupaten;
use App\Models\Admin\Kecamatan;
use App\Models\Admin\Kelurahan;
use App\Models\Admin\Provinsi;
use App\Models\Admin\Sekolah;
use App\Models\Siswa\Profil as ProfilSiswa;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Termwind\Components\Dd;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Intervention\Image\Facades\Image;


class Profil extends Component
{
    use WithFileUploads;
    public $nama_lengkap, $nik, $jenis_kelamin, $tempat_lahir, $tanggal_lahir, $agama, $no_hp, $alamat, $foto, $prev_photo;
    public $sekolah_id, $latitude_siswa, $longitude_siswa, $generate_lokasi, $file_lokasi;
    public $provinsi_id, $kabupaten_id, $kecamatan_id, $kelurahan_id, $rt, $rw, $kode_pos;
    public $tambah_sekolah, $sekolah_baru;
    public $metode_lokasi, $foto_rumah;
    public $latitude, $longitude;
    public function render()
    {
        // get data sekolah where
        $sekolah = Sekolah::where('jenis_sekolah_id', '2')->get();
        // dd(auth()->user()->users_detail->foto);
        // dd($sekolah);
        // get data provinsi
        $provinsi = Provinsi::get();
        // get kabupaten where provinsi_id
        $kabupaten = Kabupaten::where('provinsi_id', $this->provinsi_id)->get();

        // get kecamatan where kabupaten id
        $kecamatan = Kecamatan::where('kabupaten_id', $this->kabupaten_id)->get();

        $kelurahan = Kelurahan::where('kecamatan_id', $this->kecamatan_id)->get();

        $this->emit('reinitializeSelect2');

        return view('livewire.siswa.profil', [
            'sekolah' => $sekolah,
            'arrprovinsi' => $provinsi,
            'arrkabupaten' => $kabupaten,
            'arrkecamatan' => $kecamatan,
            'arrkelurahan' => $kelurahan,
        ]);
    }

    public function mount()
    {
        // get data profil Siswa where id = auth()->user()->id
        $data_siswa = ProfilSiswa::where('user_id', auth()->user()->id)->first();
        $data_user = User::where('id', auth()->user()->id)->first();
        // dd($data_user);
        // jika data siswa null
        if ($data_siswa == null) {
            $this->nama_lengkap = '';
            $this->sekolah_id = '';
            $this->jenis_kelamin = '';
            $this->nik = '';
            $this->tempat_lahir = '';
            $this->tanggal_lahir = '';
            $this->agama = '';
            $this->no_hp = '';
            $this->provinsi_id = '';
            $this->kabupaten_id = '';
            $this->kecamatan_id = '';
            $this->kelurahan_id = '';
            $this->rt = '';
            $this->rw = '';
            $this->kode_pos = '';
            $this->alamat = '';
            $this->prev_photo = '';
            $this->metode_lokasi = $data_user->metode_lokasi;
            $this->latitude_siswa = $data_user->latitude;
            $this->longitude_siswa = $data_user->longitude;
            $this->generate_lokasi = $data_user->generate_lokasi;
            $this->file_lokasi = $data_user->pendukung_jarak;
        } else {
            // dd($data_siswa);
            $this->latitude_siswa = $data_user->latitude;
            $this->longitude_siswa = $data_user->longitude;
            $this->nama_lengkap = $data_siswa->nama_lengkap;
            $this->sekolah_id = $data_user->sekolah_id;
            $this->jenis_kelamin = $data_siswa->jenis_kelamin;
            $this->nik = $data_siswa->nik;
            $this->tempat_lahir = $data_siswa->tempat_lahir;
            $this->tanggal_lahir = $data_siswa->tanggal_lahir;
            $this->agama = $data_siswa->agama;
            $this->no_hp = $data_siswa->no_hp;
            $this->provinsi_id = $data_siswa->provinsi_id;
            $this->kabupaten_id = $data_siswa->kabupaten_id;
            $this->kecamatan_id = $data_siswa->kecamatan_id;
            $this->kelurahan_id = $data_siswa->kelurahan_id;
            $this->rt = $data_siswa->rt;
            $this->rw = $data_siswa->rw;
            $this->kode_pos = $data_siswa->kode_pos;
            $this->alamat = $data_siswa->alamat;
            $this->prev_photo = $data_siswa->foto;
            $this->metode_lokasi = $data_user->metode_lokasi;
            $this->generate_lokasi = $data_user->generate_lokasi;
            $this->file_lokasi = $data_user->pendukung_jarak;
        }
    }

    public function metode_lokasi()
    {
        if ($this->metode_lokasi == true) {
            $this->metode_lokasi = false;
        } else {
            $this->metode_lokasi = true;
        }
    }


    public function tambah_sekolah()
    {
        // dd('tambah sekolah');
        $this->tambah_sekolah = true;
    }

    public function pilih_sekolah()
    {
        // reset field tambah sekolah
        $this->reset('sekolah_baru');
        $this->tambah_sekolah = false;
    }

    public function save_sekolah()
    {
        // dd($this->sekolah_baru);
        $this->validate([
            'sekolah_baru' => 'required'
        ]);
        // dd($this->sekolah_baru);
        $sekolah = new Sekolah();
        $sekolah->nama_sekolah = $this->sekolah_baru;
        $sekolah->jenis_sekolah_id = 2;
        $sekolah->save();
        $this->sekolah_id = $sekolah->id;
        $this->tambah_sekolah = false;
    }

    // update
    public function update()
    {
        // dd('awd');
        // dd($this->metode_lokasi,$this->foto_rumah);
        // dd($this->longitude_siswa, $this->latitude_siswa);
        $validasi = $this->validate(
            [
                'nama_lengkap' => 'required',
                'sekolah_id' => 'required',
                'jenis_kelamin' => 'required',
                'nik' => 'required',
                'latitude_siswa' => 'required',
                'longitude_siswa' => 'required',
                'tempat_lahir' => 'required',
                'tanggal_lahir' => 'required',
                'agama' => 'required',
                'no_hp' => 'required',
                'provinsi_id' => 'required',
                'kabupaten_id' => 'required',
                'kecamatan_id' => 'required',
                'kelurahan_id' => 'required',
                'rt' => 'required',
                'rw' => 'required',
                'kode_pos' => 'required',
                'alamat' => 'required',
                'foto' => 'max:1024' . ($this->prev_photo ? '' : '|image|required'),
                'foto_rumah' => 'max:1024' . ($this->metode_lokasi == 'manual' ? ($this->generate_lokasi == '1' ? '' : '|image|required') : ''),
            ],
            [
                'nama_lengkap.required' => 'Nama Lengkap tidak boleh kosong',
                'sekolah_id.required' => 'Sekolah tidak boleh kosong',
                'jenis_kelamin.required' => 'Jenis Kelamin tidak boleh kosong',
                'nik.required' => 'NIK tidak boleh kosong',
                'tempat_lahir.required' => 'Tempat Lahir tidak boleh kosong',
                'tanggal_lahir.required' => 'Tanggal Lahir tidak boleh kosong',
                'agama.required' => 'Agama tidak boleh kosong',
                'no_hp.required' => 'No HP tidak boleh kosong',
                'provinsi_id.required' => 'Provinsi tidak boleh kosong',
                'kabupaten_id.required' => 'Kabupaten tidak boleh kosong',
                'kecamatan_id.required' => 'Kecamatan tidak boleh kosong',
                'kelurahan_id.required' => 'Kelurahan tidak boleh kosong',
                'rt.required' => 'RT tidak boleh kosong',
                'rw.required' => 'RW tidak boleh kosong',
                'kode_pos.required' => 'Kode Pos tidak boleh kosong',
                'alamat.required' => 'Alamat tidak boleh kosong',
                'foto.image' => 'Foto harus berupa gambar',
                'foto.max' => 'Foto maksimal 1 MB',
                'foto_rumah.image' => 'Foto Rumah harus berupa gambar',
                'foto_rumah.max' => 'Foto Rumah maksimal 1 MB',
            ]
        );

        // dd($this->provinsi_id,$this->kecamatan_id, $this->kelurahan_id, $this->rt, $this->rw, $this->kode_pos);
        if ($validasi) {
            // get data profil Siswa where id = auth()->user()->id
            $data_siswa = ProfilSiswa::where('user_id', auth()->user()->id)->first();
            // jika data siswa null maka insert jika ada maka update
            if ($data_siswa == null) { // insert
                $data_siswa = new ProfilSiswa();
                $data_siswa->user_id = auth()->user()->id;
            }
            $data_siswa->nama_lengkap = $this->nama_lengkap;
            $data_siswa->jenis_kelamin = $this->jenis_kelamin;
            $data_siswa->nik = $this->nik;
            $data_siswa->tempat_lahir = $this->tempat_lahir;
            $data_siswa->tanggal_lahir = $this->tanggal_lahir;
            $data_siswa->agama = $this->agama;
            $data_siswa->no_hp = $this->no_hp;
            $data_siswa->provinsi_id = $this->provinsi_id;
            $data_siswa->kabupaten_id = $this->kabupaten_id;
            $data_siswa->kecamatan_id = $this->kecamatan_id;
            $data_siswa->kelurahan_id = $this->kelurahan_id;
            $data_siswa->rt = $this->rt;
            $data_siswa->rw = $this->rw;
            $data_siswa->kode_pos = $this->kode_pos;
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
            $data_user->sekolah_id = $this->sekolah_id;
            if ($this->metode_lokasi == 'manual') {
                // jika ada koma pada $this->latitude_siswa maka diganti jadi titik
                $this->latitude_siswa = str_replace(',', '.', $this->latitude_siswa);
                $this->longitude_siswa = str_replace(',', '.', $this->longitude_siswa);

                // cek jumlah . pada $this->latitude_siswa jika lebih dari 1 maka alert error
                $jumlah_koma_latitude = substr_count($this->latitude_siswa, '.');
                $jumlah_koma_longitude = substr_count($this->longitude_siswa, '.');
                if ($jumlah_koma_latitude > 1 || $jumlah_koma_longitude > 1) {
                    session()->flash('error', 'Latitude dan Longitude tidak boleh lebih dari 1 koma');
                    // return redirect()->route('siswa.profil');
                }

                $data_user->latitude = $this->latitude_siswa;
                $data_user->longitude = $this->longitude_siswa;
                $data_user->metode_lokasi = 'manual';
                $data_user->generate_lokasi = '1';

                if ($this->foto_rumah != null) {
                    $foto_rumah = $this->foto_rumah;
                    $filename = 'foto_rumah-' . Auth()->user()->id . '.' . $foto_rumah->getClientOriginalExtension();
                    Storage::disk('public_uploads')->putFileAs('/storage/pendukung_koordinat/', $foto_rumah, $filename);
                    $data_user->pendukung_jarak = $filename;
                }
            } else {
                $data_user->metode_lokasi = 'aplikasi';
            }
            $data_user->save();

            session()->flash('success', 'Data berhasil di ubah');
            return redirect()->route('siswa.profil.index');
        }
    }
}
