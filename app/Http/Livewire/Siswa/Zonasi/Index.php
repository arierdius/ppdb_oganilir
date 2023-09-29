<?php

namespace App\Http\Livewire\Siswa\Zonasi;

use Livewire\Component;
use App\Models\Admin\Kontrol_jalur;
use App\Models\Admin\Sekolah;
use App\Models\Admin\Zonasi;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin\Persyaratan;
use App\Models\Admin\Pendaftar;
use App\Models\User;
use App\Models\Users_detail;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Intervention\Image\Facades\Image;


use Barryvdh\DomPDF\Facade\Pdf as DomPDFPDF;
use App\Models\Admin\Pendaftar as PendaftarM;


class Index extends Component
{
    use WithFileUploads;
    public $id_sekolah, $latitude_siswa, $longitude_siswa, $agama_user, $jarak, $file, $usia_kk = null, $surat_pengantar_sd, $data_aw, $file_kk;
    public $data_persyaratan, $surat_keterangan_bta, $sk_bta;
    public $pesan_persyaratan, $pendaftaran, $usia_kk_detail, $sdk;
    public $jarak_detail;
    public $dynamicMapping = [];

    public function render()
    {

        dd(Auth::user()->sekolah->jenis_sekolah_id);
        // cek data user -> detail user
        $data_profil = Users_detail::where('user_id', Auth::user()->id)->first();
        if ($data_profil == null) {
            $this->agama_user = null;
        } else {
            $this->agama_user = $data_profil->agama;
        }
        if ($data_profil == null) {
            $kontrol_jalur_data = Kontrol_jalur::where('jenis_sekolah_id', '3')
                ->where('jalur', 'zonasi')
                ->where('tanggal_buka', '<=', date('Y-m-d'))
                ->where('tanggal_tutup', '>=', date('Y-m-d'))->get();
            $daftar_sekolah = [];
            $tanggal_buka = [];
            $status_pendaftaran = [];
            $persyaratan = [];
            session()->flash('error', 'Lengkapi data profil dahulu');
            redirect()->route('siswa.profil.index');
        } else {
            // get data kontrol jalur
            if (Auth::user()->sekolah->jenis_sekolah_id == null) {
                $kontrol_jalur = Kontrol_jalur::where('jenis_sekolah_id', '1')->first();
            } else if (Auth::user()->sekolah->jenis_sekolah_id == 1) {
                $kontrol_jalur = Kontrol_jalur::where('jenis_sekolah_id', '2')->first();
            } else if (Auth::user()->sekolah->jenis_sekolah_id == 2) {
                $kontrol_jalur_data = Kontrol_jalur::where('jenis_sekolah_id', '3')
                    ->where('jalur', 'zonasi')
                    ->where('tanggal_buka', '<=', date('Y-m-d'))
                    ->where('tanggal_tutup', '>=', date('Y-m-d'))->get();

                // get data sekolah where jenis sekolah id 3
                $daftar_sekolah = Sekolah::where('jenis_sekolah_id', '3')->where('status_sekolah', 'negeri')->get();

                $tanggal_buka = Kontrol_jalur::where('jenis_sekolah_id', '3')->first();

                // cek status_pendaftaran
                // get pendaftar where jalur zonasi dan siswa_id
                $status_pendaftaran_data = Pendaftar::where('jalur', 'zonasi')
                    ->where('siswa_id', Auth::user()->id)
                    ->first();


                // cek sudah daftar atau belum
                if ($status_pendaftaran_data != null) {
                    $status_pendaftaran = 'sudah';
                } else {
                    $status_pendaftaran = 'belum';
                }
            }
        }
        $persyaratan = Persyaratan::where('sekolah_id', $this->id_sekolah)
            ->where('jalur', 'zonasi')->get();
        $this->data_persyaratan = $persyaratan; // for dynamic variable persyaratan

        $this->emit('reinitializeSelect2');

        // cek apakah sudah mendaftar atau belum
        $jalur = Kontrol_jalur::where('jenis_sekolah_id', '3')
            ->where('tanggal_buka', '<=', date('Y-m-d'))
            ->where('tanggal_tutup', '>=', date('Y-m-d'))->get();

        $jenis_jalur = [];
        foreach ($jalur as $key => $value) {
            $jenis_jalur[] = $value->jalur;
        }

        $pendaftaran = Pendaftar::where('siswa_id', Auth::user()->id)
            ->whereIn('jalur', $jenis_jalur)
            ->get();

        $this->pendaftaran = $pendaftaran;
        // tutup cek apakah sudah mendaftar atau belum


        $user = User::where('id', Auth::user()->id)->first();
        $this->latitude_siswa =  $user->latitude;
        $this->longitude_siswa =  $user->longitude;

        if ($this->id_sekolah) {
            // get data sekolah
            $sekolah = Sekolah::where('id', $this->id_sekolah)->first();
            // dd($sekolah->latitude,$sekolah->longitude);

            // ambil latitude dan longitude siswa
            // get data user
            $user = User::where('id', Auth::user()->id)->first();

            $latitude_sekolah = $sekolah->latitude;
            $longitude_sekolah = $sekolah->longitude;
            $latitude_siswa = $user->latitude;
            $longitude_siswa = $user->longitude;

            $theta = $longitude_sekolah - $longitude_siswa;
            $miles = (sin(deg2rad($latitude_sekolah)) * sin(deg2rad($latitude_siswa))) + (cos(deg2rad($latitude_sekolah)) * cos(deg2rad($latitude_siswa)) * cos(deg2rad($theta)));
            $miles = acos($miles);
            $miles = rad2deg($miles);
            $miles = $miles * 60 * 1.1515;
            $kilometers = $miles * 1.609344;
            $meters = $kilometers * 1000;
            $this->jarak = $meters;

            // $file_upload =
            // get table persyaratan
        }

        // cek berapa usia kk
        // if($this->usia_kk == null){
        //     $this->usia_kk = 0;
        // }
        $birthDate = new DateTime($this->usia_kk);
        $today = new DateTime("today");
        if ($birthDate > $today) {
            $this->usia_kk_detail = 0;
        } else {
            $this->usia_kk_detail = $today->diff($birthDate)->y;
        }

        return view('livewire.siswa.zonasi.index', [
            'kontrol_jalur' => $kontrol_jalur_data,
            'tanggal_buka'  => $tanggal_buka,
            'daftar_sekolah' => $daftar_sekolah,
            'persyaratan' => $persyaratan,
            'status_pendaftaran' => $status_pendaftaran,
        ]);
    }

    // make store
    public function store()
    {

        // cek $this->jarak explode .
        $jarak_detail_temp = explode('.', $this->jarak);
        // jika satu maka tidak ada koma
        if (count($jarak_detail_temp) == 1) {
            $jarak_detail = $jarak_detail_temp[0];
        } else {
            // ambil 3 char dari $jarak_detail_temp[1]
            $jarak_detail = $jarak_detail_temp[0] . '.' . substr($jarak_detail_temp[1], 0, 3);
        }

        $validasi = $this->validate([
            'id_sekolah' => 'required',
            'usia_kk' => 'required',
            'latitude_siswa' => 'required',
            'longitude_siswa' => 'required',
            'surat_pengantar_sd' =>  'max:1024|required|mimes:pdf',
            'file_kk' => 'max:1024|required|mimes:pdf',
            'sk_bta' => 'max:1024' . ($this->agama_user == 'islam' ? ($this->sk_bta != null ? '|mimes:pdf' :'max:1024|required|mimes:pdf') : ''),
        ]);

        if ($validasi) {
            // cek jumlah persyaratan
            $total = count($this->data_persyaratan);
            if (count($this->dynamicMapping) != $total) {
                $this->pesan_persyaratan = 'Persyaratan harus diisi semua';
            } else {

                $nomor_pendaftaran = 'ZONASI-' . date('y') . '-' . rand(10000, 99999) . '-' . auth()->user()->id;
                $data = new Pendaftar();
                $data->siswa_id = Auth::user()->id;
                $data->no_pendaftaran = $nomor_pendaftaran;
                $data->sekolah_id = $this->id_sekolah;
                $data->jalur = 'zonasi';
                $data->status = 'menunggu';
                $data->tanggal_daftar = date('Y-m-d');
                $data->save();


                $data_zonasi = new Zonasi();
                $data_zonasi->pendaftaran_id = $data->id;
                $data_zonasi->latitude_siswa = $this->latitude_siswa;
                $data_zonasi->longitude_siswa = $this->longitude_siswa;
                $data_zonasi->jarak = $this->jarak;
                $data_zonasi->jarak_detail = $jarak_detail;
                $data_zonasi->usia_kk = $this->usia_kk;


                $surat_pengantar_sd = $this->surat_pengantar_sd;
                if ($this->surat_pengantar_sd != null) {
                    $filename = 'surat_pengantar_sd-' . Auth()->user()->id . '.' . $surat_pengantar_sd->getClientOriginalExtension();
                    Storage::disk('public_uploads')->putFileAs('/storage/data_pendaftaran/', $surat_pengantar_sd, $filename);
                    $data_zonasi->surat_pengantar_sd = $filename;
                }

                $sk_bta = $this->sk_bta;
                if ($this->sk_bta != null) {
                    $filename = 'sk_bta-' . Auth()->user()->id . '.' . $sk_bta->getClientOriginalExtension();
                    Storage::disk('public_uploads')->putFileAs('/storage/data_pendaftaran/', $sk_bta, $filename);
                    $data_zonasi->sk_bta = $filename;
                }

                $file_kk = $this->file_kk;
                if ($this->file_kk != null) {
                    $filename = 'file_kk-' . Auth()->user()->id . '.' . $file_kk->getClientOriginalExtension();
                    Storage::disk('public_uploads')->putFileAs('/storage/data_pendaftaran/', $file_kk, $filename);
                    $data_zonasi->file_kk = $filename;
                }

                foreach ($this->data_persyaratan as $key) {
                    $files = $this->dynamicMapping[$key->nama_surat];

                    // ORIGINAL
                    $fileName =  'zonasi-' . $key->nama_surat . '-' . Auth()->user()->id . '.' . $files->getClientOriginalExtension();
                    Storage::disk('public_uploads')->putFileAs('/storage/data_pendaftaran/', $files, $filename);
                    $aww[] = $fileName;
                    $data_zonasi->file = json_encode($aww);
                }


                $data_zonasi->save();
                $this->emit('closeModal');
                session()->flash('success', 'Pendaftaran Anda Berhasil Dikirim');
                return redirect()->route('siswa.zonasi.index');
            }
        }
    }

    public function cetak($id)
    {
        // get PendaftaraM where jalur zonasi dan siswa id
        $pendaftar = PendaftarM::where('jalur', 'zonasi')
            ->where('siswa_id', Auth::user()->id)
            ->first();

        $user = User::where('id', Auth::user()->id)->select('pendukung_jarak')->first();


        // dd($data_daya_tampung);
        $pdf = DomPDFPDF::loadView(
            'livewire.siswa.cetak.cetak-pendaftaran',
            [
                'pendaftaran' => $pendaftar,
                'user' => $user
            ]
        )
            ->setPaper('a4', 'potrait')
            ->output();

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf;
        }, 'Kartu Pendaftaran - .pdf');
    }
}
