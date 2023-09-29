<?php

namespace App\Http\Livewire\Siswa\Mutasi;

use App\Models\Admin\Kontrol_jalur;
use App\Models\Admin\Mutasi;
use App\Models\Admin\Pendaftar;
use App\Models\Admin\Persyaratan;
use App\Models\Admin\Sekolah;
use App\Models\User;
use App\Models\Users_detail;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Livewire\WithFileUploads;


use Barryvdh\DomPDF\Facade\Pdf as DomPDFPDF;
use App\Models\Admin\Pendaftar as PendaftarM;



class Index extends Component
{
    public $jarak, $latitude_siswa, $longitude_siswa, $id_sekolah, $data_persyaratan, $surat_pengantar_sd;
    public $dynamicMapping = [];
    public $sk_mutasi_orang_tua, $pendaftaran;
    public $pesan_persyaratan, $sdk;
    public $sk_bta, $agama_user;
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
            // get d
            // get data kontrol jalur
            if (Auth::user()->sekolah->jenis_sekolah_id == null) {
                $kontrol_jalur = Kontrol_jalur::where('jenis_sekolah_id', '1')->first();
            } else if (Auth::user()->sekolah->jenis_sekolah_id == 1) {
                $kontrol_jalur = Kontrol_jalur::where('jenis_sekolah_id', '2')->first();
            } else if (Auth::user()->sekolah->jenis_sekolah_id == 2) {
                $kontrol_jalur_data = Kontrol_jalur::where('jenis_sekolah_id', '3')
                    ->where('jalur', 'mutasi')
                    ->where('tanggal_buka', '<=', date('Y-m-d'))
                    ->where('tanggal_tutup', '>=', date('Y-m-d'))->get();

                // get data sekolah where jenis sekolah id 3
                $daftar_sekolah = Sekolah::where('jenis_sekolah_id', '3')->where('status_sekolah', 'negeri')->where('pendaftaran', 'buka')->get();

                $tanggal_buka = Kontrol_jalur::where('jenis_sekolah_id', '3')->first();

                // cek status_pendaftaran
                // get pendaftar where jalur mutasi dan siswa_id
                $status_pendaftaran_data = Pendaftar::where('jalur', 'mutasi')
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
            ->where('jalur', 'mutasi')->get();
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

        return view('livewire.siswa.mutasi.index', [
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
        $validasi = $this->validate([
            'id_sekolah' => 'required',
            'surat_pengantar_sd' => 'max:1024|required|mimes:pdf',
            'sk_mutasi_orang_tua' => 'max:1024|required|mimes:pdf',
            'sk_bta' => 'max:1024' . ($this->agama_user == 'islam' ? ($this->sk_bta != null ? '|mimes:pdf' : 'max:1024|required|mimes:pdf') : ''),
        ]);

        if ($validasi) {
            // cek jumlah persyaratan
            $total = count($this->data_persyaratan);
            if (count($this->dynamicMapping) != $total) {
                $this->pesan_persyaratan = 'Persyaratan harus diisi semua';
            } else {
                $nomor_pendaftaran = 'MUTASI-' . date('y') . '-' . rand(10000, 99999) . '-' . auth()->user()->id;
                $data = new Pendaftar();
                $data->siswa_id = Auth::user()->id;
                $data->no_pendaftaran = $nomor_pendaftaran;
                $data->sekolah_id = $this->id_sekolah;
                $data->jalur = 'mutasi';
                $data->status = 'menunggu';
                $data->tanggal_daftar = date('Y-m-d');
                $data->save();


                $data_mutasi = new Mutasi();
                $data_mutasi->pendaftaran_id = $data->id;
                $data_mutasi->jarak = $this->jarak;

                $surat_pengantar_sd = $this->surat_pengantar_sd;
                $filename = 'surat_pengantar_sd-' . Auth()->user()->id . '.' . $surat_pengantar_sd->getClientOriginalExtension();
                Storage::disk('public_uploads')->putFileAs('/storage/data_pendaftaran/', $surat_pengantar_sd, $filename);
                $data_mutasi->surat_pengantar_sd = $filename;

                $sk_mutasi_orang_tua = $this->sk_mutasi_orang_tua;
                $filename = 'sk_mutasi_orang_tua-' . Auth()->user()->id . '.' . $sk_mutasi_orang_tua->getClientOriginalExtension();
                Storage::disk('public_uploads')->putFileAs('/storage/data_pendaftaran/', $sk_mutasi_orang_tua, $filename);
                $data_mutasi->sk_mutasi_orang_tua = $filename;

                $sk_bta = $this->sk_bta;
                if ($sk_bta != null) {
                    $filename = 'sk_mutasi_orang_tua-' . Auth()->user()->id . '.' . $sk_mutasi_orang_tua->getClientOriginalExtension();
                    Storage::disk('public_uploads')->putFileAs('/storage/data_pendaftaran/', $sk_mutasi_orang_tua, $filename);
                    $data_mutasi->sk_bta = $filename;
                }

                foreach ($this->data_persyaratan as $key) {
                    $files = $this->dynamicMapping[$key->nama_surat];
                    // ORIGINAL
                    $fileName =  'zonasi-' . $key->nama_surat . '-' . Auth()->user()->id . '.' . $files->getClientOriginalExtension();
                    Storage::disk('public_uploads')->putFileAs('/storage/data_pendaftaran/', $files, $filename);
                    $aww[] = $fileName;
                    $data_mutasi->file = json_encode($aww);
                }

                $data_mutasi->save();
                $this->emit('closeModal');
                session()->flash('success', 'Pendaftaran Anda Berhasil Dikirim');
                return redirect()->route('siswa.mutasi.index');
            }
        }
    }

    public function cetak($id)
    {
        // get PendaftaraM where jalur zonasi dan siswa id
        $pendaftar = PendaftarM::where('jalur', 'mutasi')
            ->where('siswa_id', Auth::user()->id)
            ->first();

        $user = User::where('id', Auth::user()->id)->select('pendukung_jarak')->first();


        // dd($data_daya_tampung);
        $pdf = DomPDFPDF::loadView(
            'livewire.siswa.cetak.cetak-pendaftaran-mutasi',
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
