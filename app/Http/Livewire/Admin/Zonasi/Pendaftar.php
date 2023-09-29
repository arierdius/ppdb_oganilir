<?php

namespace App\Http\Livewire\Admin\Zonasi;

use Livewire\Component;
use App\Models\Admin\Pendaftar as PendaftarM;
use App\Models\Admin\Sekolah;
use App\Models\Admin\Zonasi;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use Intervention\Image\Facades\Image;

class Pendaftar extends Component
{
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';

    public $file_persyaratan, $dataId, $status_data, $search, $persyaratan_sekolah = [];
    public $dynamicMapping = [];



    // get data inputan
    public $latitude_siswa, $longitude_siswa, $usia_kk, $sk_bta ,$jarak, $kartu_keluarga, $surat_pengantar_sd;
    public $sk_bta_baru, $kartu_keluarga_baru, $surat_pengantar_sd_baru;

    public function render()
    {
        // dd(Auth::user()->sekolah_id);
        // get data Pendaftar where jalur zonasi relasi to zonasi where status menunggu
        if ($this->search != null) {
            $zonasi = PendaftarM::join('zonasi', 'zonasi.pendaftaran_id', '=', 'pendaftaran.id')
                ->join('sekolah', 'sekolah.id', '=', 'pendaftaran.sekolah_id')
                ->join('users', 'users.id', '=', 'pendaftaran.siswa_id')
                ->join('sekolah as sekolah_asal', 'sekolah_asal.id', '=', 'users.sekolah_id')
                ->join('users_detail', 'users_detail.user_id', '=', 'users.id')
                ->select(
                    'pendaftaran.no_pendaftaran',
                    'pendaftaran.id as id_pendaftaran',
                    'pendaftaran.status',
                    'pendaftaran.jalur',
                    'pendaftaran.tanggal_daftar',
                    'zonasi.id as id_zonasi',
                    'zonasi.jarak',
                    'zonasi.latitude_siswa',
                    'zonasi.longitude_siswa',
                    'zonasi.usia_kk',
                    'sekolah.id as id_sekolah',
                    'sekolah.nama_sekolah',
                    'sekolah.latitude',
                    'sekolah.jenis_sekolah_id',
                    'sekolah.latitude',
                    'sekolah.longitude',
                    'users.id as id_siswa',
                    'sekolah_asal.nama_sekolah as sekolah_asal',
                    'users_detail.nama_lengkap',
                    'users_detail.jenis_kelamin',
                    'users_detail.tempat_lahir',
                    'users_detail.tanggal_lahir',
                    'users_detail.agama',
                    'users_detail.alamat',
                    'users_detail.no_hp',
                    'users_detail.foto'
                )
                ->where('pendaftaran.status', 'menunggu')
                ->where('users_detail.nama_lengkap', 'like', '%' . $this->search . '%')
                ->where('pendaftaran.sekolah_id', auth()->user()->sekolah_id)
                ->orderBy('zonasi.jarak', 'asc')
                ->paginate(10);
        } else {
            $zonasi = PendaftarM::join('zonasi', 'zonasi.pendaftaran_id', '=', 'pendaftaran.id')
                ->join('sekolah', 'sekolah.id', '=', 'pendaftaran.sekolah_id')
                ->join('users', 'users.id', '=', 'pendaftaran.siswa_id')
                ->join('sekolah as sekolah_asal', 'sekolah_asal.id', '=', 'users.sekolah_id')
                ->join('users_detail', 'users_detail.user_id', '=', 'users.id')
                ->select(
                    'pendaftaran.no_pendaftaran',
                    'pendaftaran.id as id_pendaftaran',
                    'pendaftaran.status',
                    'pendaftaran.jalur',
                    'pendaftaran.tanggal_daftar',
                    'zonasi.id as id_zonasi',
                    'zonasi.jarak',
                    'zonasi.latitude_siswa',
                    'zonasi.longitude_siswa',
                    'zonasi.usia_kk',
                    'sekolah.id as id_sekolah',
                    'sekolah.nama_sekolah',
                    'sekolah.latitude',
                    'sekolah.jenis_sekolah_id',
                    'sekolah.latitude',
                    'sekolah.longitude',
                    'users.id as id_siswa',
                    'sekolah_asal.nama_sekolah as sekolah_asal',
                    'users_detail.nama_lengkap',
                    'users_detail.jenis_kelamin',
                    'users_detail.tempat_lahir',
                    'users_detail.tanggal_lahir',
                    'users_detail.agama',
                    'users_detail.alamat',
                    'users_detail.no_hp',
                    'users_detail.foto'
                )
                ->where('pendaftaran.status', 'menunggu')
                ->where('pendaftaran.sekolah_id', auth()->user()->sekolah_id)
                ->orderBy('zonasi.jarak', 'asc')
                ->paginate(10);
        }

        // dd($zonasi);
        return view(
            'livewire.admin.zonasi.pendaftar',
            ['data_zonasi' => $zonasi]
        );
    }

    public function dataId($id)
    {
        $this->dataId = $id;
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

    // make verifikasi diterima zonasi
    public function verifikasi()
    {
        $zonasi = PendaftarM::find($this->dataId);
        $zonasi->status = 'diverifikasi';
        $zonasi->save();
        session()->flash('success', 'Pendaftaran Diverifikasi');
        return redirect()->route('admin.zonasi.index');
    }

    // make verifikasi diterima zonasi
    public function verifikasiDitolak()
    {
        $zonasi = PendaftarM::find($this->dataId);
        $zonasi->status = 'ditolak';
        $zonasi->save();
        session()->flash('success', 'Pendaftaran Ditolak');
        return redirect()->route('admin.zonasi.index');
    }

    // lihat lampiran
    public function lihatLampiran($id)
    {
        $zonasi = PendaftarM::find($id);
        // dd($zonasi->zonasi->file);
        $this->file_persyaratan = $zonasi->zonasi->file;
    }

    public function perbaruiData($id)
    {
        $zonasi = PendaftarM::find($id);
        $this->latitude_siswa = $zonasi->zonasi->latitude_siswa;
        $this->longitude_siswa = $zonasi->zonasi->longitude_siswa;
        $this->usia_kk = $zonasi->zonasi->usia_kk;
        $this->jarak = $zonasi->zonasi->jarak;
        $this->kartu_keluarga = $zonasi->zonasi->file_kk;
        $this->sk_bta = $zonasi->zonasi->sk_bta;
        $this->surat_pengantar_sd = $zonasi->zonasi->surat_pengantar_sd;
    }

    // make reset fields
    public function resetInputFields()
    {

    }

    public function cek_jarak()
    {
        // dd($this->latitude_siswa, $this->longitude_siswa);
        // get data sekolah
        $sekolah = Sekolah::where('id', auth()->user()->sekolah_id)->first();
        // dd($sekolah->latitude,$sekolah->longitude);

        // ambil latitude dan longitude siswa
        // get data user

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
        // make reset input fields

        // data zonasi
        $zonasi = Zonasi::where('pendaftaran_id', $this->dataId)->first();
        $zonasi->latitude_siswa = $this->latitude_siswa;
        $zonasi->longitude_siswa = $this->longitude_siswa;
        $zonasi->jarak = $this->jarak;
        // $zonasi->save();
        if($this->sk_bta != null){
            $files = $this->sk_bta;
            $fileNameBTA =  'zonasi-sk-bta-' . Auth()->user()->id . '.' . $files->getClientOriginalExtension();
            // ORIGINAL
            $destinationPathBTA = public_path('/storage/data_pendaftaran/');
            $img = Image::make($files->getRealPath());
            $QuploadImage = $img->resize(1080, 1080, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPathBTA . $fileNameBTA, 100);
            $zonasi->sk_bta = $fileNameBTA;
        }

        if($this->kartu_keluarga != null){
            $files = $this->kartu_keluarga;
            $fileNameKK =  'zonasi-kartu-keluarga-' . Auth()->user()->id . '.' . $files->getClientOriginalExtension();
            // ORIGINAL
            $destinationPathKK = public_path('/storage/data_pendaftaran/');
            $img = Image::make($files->getRealPath());
            $QuploadImage = $img->resize(1080, 1080, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPathKK . $fileNameKK, 100);
            $zonasi->file_kk = $fileNameKK;
        }

        if($this->surat_pengantar_sd != null){
            $files = $this->surat_pengantar_sd;
            $fileNameSP =  'zonasi-surat-pengantar-sd-' . Auth()->user()->id . '.' . $files->getClientOriginalExtension();
            // ORIGINAL
            $destinationPathSP = public_path('/storage/data_pendaftaran/');
            $img = Image::make($files->getRealPath());
            $QuploadImage = $img->resize(1080, 1080, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPathSP . $fileNameSP, 100);
            $zonasi->surat_pengantar_sd = $fileNameSP;
        }
        // save data zonasi
        $zonasi->save();


        // $zonasi = PendaftarM::find($this->dataId);
        // // explode file
        // $arr_pendaftaran = $zonasi->zonasi->file;

        // if ($arr_pendaftaran != null) {

        //     $potong_awal = substr($arr_pendaftaran, 2);
        //     $potong_akhir = substr($potong_awal, 0, -2);
        //     $datas = explode('","', $potong_akhir);
        //     $aww = [];
        //         foreach ($datas as $key => $value) {
        //             $aww[] = $value;
        //         }


        // $arrPersyaratan = [];
        // foreach ($this->dynamicMapping as $key_a) {
        //     $files = $key_a;
        //     // dd($files);
        //     $fileName = $value->getClientOriginalName();
        //     // ORIGINAL
        //     $destinationPath = public_path('/storage/test_doang/');
        //     $img = Image::make($files->getRealPath());
        //     $QuploadImage = $img->resize(1080, 1080, function ($constraint) {
        //         $constraint->aspectRatio();
        //     })->save($destinationPath . $fileName, 100);
        // }

        // // hitung jumlah array
        // $jumlah_array = count($datas);
        // if ($jumlah_array == 1) {
        //     dd('satu');
        // } elseif ($jumlah_array == 2) {
        //     dd('dua');
        // } elseif ($jumlah_array == 3) {
        //     dd($this->dynamicMapping);
        // } elseif ($jumlah_array == 4) {
        //     dd('empat');
        // } elseif ($jumlah_array == 5) {
        //     dd('lima');
        // }
        // }

        // exit;


        // // statis maks 5 persyaratan

        // // ambil nama yang pertama
        // $files = $this->dynamicMapping[0];
        // $fileName =  'afirmasi-' . $key->nama_surat . '-' . Auth()->user()->id . '.' . $files->getClientOriginalExtension();

        // // ORIGINAL
        // $destinationPath = public_path('/storage/data_pendaftaran/');
        // $img = Image::make($files->getRealPath());
        // $QuploadImage = $img->resize(1080, 1080, function ($constraint) {
        //     $constraint->aspectRatio();
        // })->save($destinationPath . $fileName, 100);
        // $aww[] = $fileName;
        // $data_afirmasi->file = json_encode($aww);
    }
}
