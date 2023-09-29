<?php

namespace App\Http\Livewire\Siswa\Prestasi;

use Livewire\Component;
use App\Models\Admin\Kontrol_jalur;
use App\Models\Admin\Pendaftar;
use App\Models\Admin\Persyaratan;
use App\Models\Admin\Prestasi;
use App\Models\Admin\Sekolah;
use App\Models\User;
use App\Models\Users_detail;
use Livewire\WithFileUploads;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Termwind\Components\Dd;


use Barryvdh\DomPDF\Facade\Pdf as DomPDFPDF;
use App\Models\Admin\Pendaftar as PendaftarM;

class Index extends Component
{
    public $jarak, $id_sekolah, $data_persyaratand;
    public $sk_bta, $surat_pengantar_sd;
    public $suket_rumah_tahfidz, $akumulasi_raport, $menang_lomba, $raport, $sertifikat_kabupaten, $sertifikat_provinsi, $sertifikat_nasional, $sertifikat_internasional;
    public $pesan_persyaratan, $pendaftarant, $agama_user, $sdk;
    public $dynamicMapping = [];

    use WithFileUploads;
    public function render()
    {
        // cek data user -> detail user
        $data_profil = Users_detail::where('user_id', Auth::user()->id)->first();
        if ($data_profil == null) {
            $this->agama_user = null;
        } else {
            $this->agama_user = $data_profil->agama;
        }

        if ($data_profil == null) {
            $kontrol_jalur_data = Kontrol_jalur::where('jenis_sekolah_id', '3')
                ->where('jalur', 'prestasi')
                ->where('tanggal_buka', '<=', date('Y-m-d'))
                ->where('tanggal_tutup', '>=', date('Y-m-d'))->get();
            $daftar_sekolah = [];
            $tanggal_buka = [];
            $status_pendaftaran = [];
            $persyaratan = [];
            session()->flash('error', 'Lengkapi data profil dahulu');
            redirect()->route('siswa.profil.index');
        } else {
            // get d
            // get data kontrol jalur
            if (Auth::user()->sekolah->jenis_sekolah_id == null) {
                $kontrol_jalur = Kontrol_jalur::where('jenis_sekolah_id', '1')->first();
            } else if (Auth::user()->sekolah->jenis_sekolah_id == 1) {
                $kontrol_jalur = Kontrol_jalur::where('jenis_sekolah_id', '2')->first();
            } else if (Auth::user()->sekolah->jenis_sekolah_id == 2) {
                $kontrol_jalur_data = Kontrol_jalur::where('jenis_sekolah_id', '3')
                    ->where('jalur', 'prestasi')
                    ->where('tanggal_buka', '<=', date('Y-m-d'))
                    ->where('tanggal_tutup', '>=', date('Y-m-d'))->get();

                // get data sekolah where jenis sekolah id 3
                $daftar_sekolah = Sekolah::where('jenis_sekolah_id', '3')->where('status_sekolah', 'negeri')->where('pendaftaran', 'buka')->get();

                $tanggal_buka = Kontrol_jalur::where('jenis_sekolah_id', '3')->first();

                // cek status_pendaftaran
                // get pendaftar where jalur prestasi dan siswa_id
                $status_pendaftaran_data = Pendaftar::where('jalur', 'prestasi')
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


        // dd($kontrol_jalur_data);
        $persyaratan = Persyaratan::where('sekolah_id', $this->id_sekolah)
            ->where('jalur', 'prestasi')->get();
        // dd($persyaratan);

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

        if ($this->id_sekolah) {
            // get data sekolah
            $sekolah = Sekolah::where('id', $this->id_sekolah)->first();
            // dd($sekolah->latitude,$sekolah->longitude);

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

        return view('livewire.siswa.prestasi.index', [
            'kontrol_jalur' => $kontrol_jalur_data,
            'daftar_sekolah' => $daftar_sekolah,
            'tanggal_buka' => $tanggal_buka,
            'status_pendaftaran' => $status_pendaftaran,
            'persyaratan' => $persyaratan,
        ]);
    }

    // store
    public function store()
    {

        $validasi =  $this->validate([
            'id_sekolah' => 'required',
            'surat_pengantar_sd' =>  'max:1024|required|mimes:pdf',
            'sk_bta' =>  'max:1024|required|mimes:pdf',
            'akumulasi_raport' =>  'max:1024|required|mimes:pdf',
            'raport' =>  'max:2048|required|mimes:pdf',
            'sk_bta' => 'max:1024' . ($this->agama_user == 'islam' ? ($this->sk_bta != null ? '|mimes:pdf' : 'required|mimes:pdf') : ''),
        ]);

        if ($validasi) {
            // cek jumlah persyaratan
            $total = count($this->data_persyaratan);
            // dd($total);
            if (count($this->dynamicMapping) != $total) {
                $this->pesan_persyaratan = 'Persyaratan harus diisi semua';
            } else {
                // dd($this->surat_pengantar_sd);
                $nomor_pendaftaran = 'PRESTASI-' . date('y') . '-' . rand(10000, 99999) . '-' . auth()->user()->id;
                $data = new Pendaftar();
                $data->siswa_id = Auth::user()->id;
                $data->no_pendaftaran = $nomor_pendaftaran;
                $data->sekolah_id = $this->id_sekolah;
                $data->jalur = 'prestasi';
                $data->status = 'menunggu';
                $data->tanggal_daftar = date('Y-m-d');
                $data->save();

                $data_prestasi = new Prestasi();
                $data_prestasi->pendaftaran_id = $data->id;
                $data_prestasi->jarak = $this->jarak;


                $surat_pengantar_sd = $this->surat_pengantar_sd;
                $filename = 'surat_pengantar_sd-' . Auth()->user()->id . '.' . $surat_pengantar_sd->getClientOriginalExtension();
                Storage::disk('public_uploads')->putFileAs('/storage/data_pendaftaran/', $surat_pengantar_sd, $filename);
                $data_prestasi->surat_pengantar_sd = $filename;

                if ($this->sk_bta != null) {
                    $sk_bta = $this->sk_bta;
                    $filename = 'sk_bta-' . Auth()->user()->id . '.' . $sk_bta->getClientOriginalExtension();
                    Storage::disk('public_uploads')->putFileAs('/storage/data_pendaftaran/', $sk_bta, $filename);
                    $data_prestasi->sk_bta = $filename;
                }

                // raport
                $raport = $this->raport;
                $filename = 'raport-' . Auth()->user()->id . '.' . $raport->getClientOriginalExtension();
                Storage::disk('public_uploads')->putFileAs('/storage/data_pendaftaran/', $raport, $filename);
                $data_prestasi->raport = $filename;

                // ===============>>>>>>>>AKADEMIK<<<<<<<<================
                // akumulasi_raport WAJIB
                $akumulasi_raport = $this->akumulasi_raport;
                $filename = 'akumulasi_raport-' . Auth()->user()->id . '.' . $akumulasi_raport->getClientOriginalExtension();
                Storage::disk('public_uploads')->putFileAs('/storage/data_pendaftaran/', $akumulasi_raport, $filename);
                $data_prestasi->akumulasi_raport = $filename;


                // menang_lomba
                // jika tidak null maka upload
                if ($this->menang_lomba != null) {
                    $menang_lomba = $this->menang_lomba;
                    $filename = 'menang_lomba-' . Auth()->user()->id . '.' . $menang_lomba->getClientOriginalExtension();
                    Storage::disk('public_uploads')->putFileAs('/storage/data_pendaftaran/', $menang_lomba, $filename);
                    $data_prestasi->menang_lomba = $filename;
                }
                // ===============>>>>>>>>TUTUP AKADEMIK<<<<<<<<================

                // ===============>>>>>>>>TAHFIDZ<<<<<<<<================
                // suket_rumah_tahfidz
                // jika tidak null
                if ($this->suket_rumah_tahfidz != null) {
                    $suket_rumah_tahfidz = $this->suket_rumah_tahfidz;
                    $filename = 'suket_rumah_tahfidz-' . Auth()->user()->id . '.' . $suket_rumah_tahfidz->getClientOriginalExtension();
                    Storage::disk('public_uploads')->putFileAs('/storage/data_pendaftaran/', $suket_rumah_tahfidz, $filename);
                    $data_prestasi->suket_rumah_tahfidz = $filename;
                }
                // ===============>>>>>>>>TUTUP TAHFIDZ<<<<<<<<================

                // ===============>>>>>>>>NON AKADEMIK<<<<<<<<================
                // sertifikat_kabupaten
                if ($this->sertifikat_kabupaten != null) {
                    $sertifikat_kabupaten = $this->sertifikat_kabupaten;
                    $filename = 'sertifikat_kabupaten-' . Auth()->user()->id . '.' . $sertifikat_kabupaten->getClientOriginalExtension();
                    Storage::disk('public_uploads')->putFileAs('/storage/data_pendaftaran/', $sertifikat_kabupaten, $filename);
                    $data_prestasi->sertifikat_kabupaten = $filename;
                }

                // sertifikat_provinsi
                if ($this->sertifikat_provinsi != null) {
                    $sertifikat_provinsi = $this->sertifikat_provinsi;
                    $filename = 'sertifikat_provinsi-' . Auth()->user()->id . '.' . $sertifikat_provinsi->getClientOriginalExtension();
                    Storage::disk('public_uploads')->putFileAs('/storage/data_pendaftaran/', $sertifikat_provinsi, $filename);
                    $data_prestasi->sertifikat_provinsi = $filename;
                }

                // sertifikat_nasional
                if ($this->sertifikat_nasional != null) {
                    $sertifikat_nasional = $this->sertifikat_nasional;
                    $filename = 'sertifikat_nasional-' . Auth()->user()->id . '.' . $sertifikat_nasional->getClientOriginalExtension();
                    Storage::disk('public_uploads')->putFileAs('/storage/data_pendaftaran/', $sertifikat_nasional, $filename);
                    $data_prestasi->sertifikat_nasional = $filename;
                }

                // sertifikat_internasional
                if ($this->sertifikat_internasional != null) {
                    $sertifikat_internasional = $this->sertifikat_internasional;
                    $filename = 'sertifikat_internasional-' . Auth()->user()->id . '.' . $sertifikat_internasional->getClientOriginalExtension();
                    Storage::disk('public_uploads')->putFileAs('/storage/data_pendaftaran/', $sertifikat_internasional, $filename);
                    $data_prestasi->sertifikat_internasional = $filename;
                }
                // ===============>>>>>>>>TUTUP NON AKADEMIK<<<<<<<<================

                // dd($this->data_persyaratan);
                foreach ($this->data_persyaratan as $key) {
                    $files = $this->dynamicMapping[$key->nama_surat];

                    // ORIGINAL
                    $fileName =  'afirmasi-' . $key->nama_surat . '-' . Auth()->user()->id . '.' . $files->getClientOriginalExtension();
                    Storage::disk('public_uploads')->putFileAs('/storage/data_pendaftaran/', $files, $filename);
                    $aww[] = $fileName;
                    $data_prestasi->file = json_encode($aww);
                }

                $data_prestasi->save();
                $this->emit('closeModal');
                session()->flash('success', 'Pendaftaran Anda Berhasil Dikirim');
                return redirect()->route('siswa.prestasi.index');
            }
        }
    }

    public function cetak($id)
    {
        // get PendaftaraM where jalur zonasi dan siswa id
        $pendaftar = PendaftarM::where('jalur', 'prestasi')
            ->where('siswa_id', Auth::user()->id)
            ->first();

        $user = User::where('id', Auth::user()->id)->select('pendukung_jarak')->first();


        // dd($data_daya_tampung);
        $pdf = DomPDFPDF::loadView(
            'livewire.siswa.cetak.cetak-pendaftaran-prestasi',
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
