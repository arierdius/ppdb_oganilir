<?php

namespace App\Http\Livewire\Siswa\Afirmasi;

use App\Models\Admin\Afirmasi;
use App\Models\Admin\Kontrol_jalur;
use App\Models\Admin\Pendaftar;
use App\Models\Admin\Persyaratan;
use App\Models\Admin\Sekolah;
use App\Models\User;
use App\Models\Users_detail;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
// use QrCode
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Intervention\Image\Facades\Image;

// cetak atribut

use Barryvdh\DomPDF\Facade\Pdf as DomPDFPDF;
use App\Models\Admin\Pendaftar as PendaftarM;
use Termwind\Components\Dd;

class Index extends Component
{
    use WithFileUploads;
    public $data_persyaratan, $id_sekolah, $jarak, $latitude_siswa, $longitude_siswa, $surat_pengantar_sd;
    public $dynamicMapping = [];
    public $pesan_persyaratan, $pendaftaran;
    public $sk_bta, $agama_user;
    public $pkh_kip, $sdk;
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
            // get data kontrol jalur
            if (Auth::user()->sekolah->jenis_sekolah_id == null) {
                $kontrol_jalur = Kontrol_jalur::where('jenis_sekolah_id', '1')->first();
            } else if (Auth::user()->sekolah->jenis_sekolah_id == 1) {
                $kontrol_jalur = Kontrol_jalur::where('jenis_sekolah_id', '2')->first();
            } else if (Auth::user()->sekolah->jenis_sekolah_id == 2) {
                $kontrol_jalur_data = Kontrol_jalur::where('jenis_sekolah_id', '3')
                    ->where('jalur', 'afirmasi')
                    ->where('tanggal_buka', '<=', date('Y-m-d'))
                    ->where('tanggal_tutup', '>=', date('Y-m-d'))->get();

                // get data sekolah where jenis sekolah id 3
                $daftar_sekolah = Sekolah::where('jenis_sekolah_id', '3')->where('status_sekolah', 'negeri')->where('pendaftaran', 'buka')->get();

                $tanggal_buka = Kontrol_jalur::where('jenis_sekolah_id', '3')->first();

                // cek status_pendaftaran
                // get pendaftar where jalur afirmasi dan siswa_id
                $status_pendaftaran_data = Pendaftar::where('jalur', 'afirmasi')
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
            ->where('jalur', 'afirmasi')->get();
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

        return view('livewire.siswa.afirmasi.index', [
            'kontrol_jalur' => $kontrol_jalur_data,
            'daftar_sekolah' => $daftar_sekolah,
            'tanggal_buka' => $tanggal_buka,
            'persyaratan'   => $persyaratan,
            'status_pendaftaran' => $status_pendaftaran,
        ]);
    }

    // store
    public function store()
    {
        // dd($this->jarak);
        $validasi = $this->validate(
            [
                'id_sekolah' => 'required',
                'surat_pengantar_sd' => 'max:1024|required|mimes:pdf',
                'pkh_kip' => 'max:1024|required|mimes:pdf',
                'sk_bta' => 'max:1024' . ($this->agama_user == 'islam' ? ($this->sk_bta != null ? '|mimes:pdf' : 'max:1024|required|mimes:pdf') : ''),
            ]
        );

        if ($validasi) {
            // cek jumlah persyaratan
            $total = count($this->data_persyaratan);
            if (count($this->dynamicMapping) != $total) {
                $this->pesan_persyaratan = 'Persyaratan harus diisi semua';
            } else {

                $nomor_pendaftaran = 'AFIRMASI-' . date('y') . '-' . rand(10000, 99999) . '-' . auth()->user()->id;
                $data = new Pendaftar();
                $data->siswa_id = Auth::user()->id;
                $data->no_pendaftaran = $nomor_pendaftaran;
                $data->sekolah_id = $this->id_sekolah;
                $data->jalur = 'afirmasi';
                $data->status = 'menunggu';
                $data->tanggal_daftar = date('Y-m-d');
                $data->save();

                $data_afirmasi = new Afirmasi();
                $data_afirmasi->pendaftaran_id = $data->id;
                $data_afirmasi->jarak = $this->jarak;


                $surat_pengantar_sd = $this->surat_pengantar_sd;
                $filename = 'surat_pengantar_sd-' . Auth()->user()->id . '.' . $surat_pengantar_sd->getClientOriginalExtension();
                Storage::disk('public_uploads')->putFileAs('/storage/data_pendaftaran/', $surat_pengantar_sd, $filename);
                $data_afirmasi->surat_pengantar_sd = $filename;


                $pkh_kip = $this->pkh_kip;
                $filename = 'pkh_kip-' . Auth()->user()->id . '.' . $pkh_kip->getClientOriginalExtension();
                Storage::disk('public_uploads')->putFileAs('/storage/data_pendaftaran/', $pkh_kip, $filename);
                $data_afirmasi->pkh_kip = $filename;

                $sk_bta = $this->sk_bta;
                if ($this->sk_bta != null) {
                    $filename = 'sk_bta-' . Auth()->user()->id . '.' . $sk_bta->getClientOriginalExtension();
                    Storage::disk('public_uploads')->putFileAs('/storage/data_pendaftaran/', $sk_bta, $filename);
                    $data_afirmasi->sk_bta = $filename;
                }


                foreach ($this->data_persyaratan as $key) {
                    $files = $this->dynamicMapping[$key->nama_surat];

                    // ORIGINAL
                    $fileName =  'afirmasi-' . $key->nama_surat . '-' . Auth()->user()->id . '.' . $files->getClientOriginalExtension();
                    Storage::disk('public_uploads')->putFileAs('/storage/data_pendaftaran/', $files, $filename);
                    $aww[] = $fileName;
                    $data_afirmasi->file = json_encode($aww);
                }


                $data_afirmasi->save();
                $this->emit('closeModal');
                session()->flash('success', 'Pendaftaran Anda Berhasil Dikirim');
                return redirect()->route('siswa.afirmasi.index');
            }
        }
    }

    // public function cetak($id)
    // {
    //     // get PendaftaraM where jalur zonasi dan siswa id
    //     $pendaftar = PendaftarM::where('jalur', 'afirmasi')
    //         ->where('siswa_id', Auth::user()->id)
    //         ->first();
    //     // dd($pendaftar['no_pendaftaran']);

    //     $user = User::where('id', Auth::user()->id)->select('pendukung_jarak')->first();
    //     // $dataqr =  QrCode::generate('Welcome to Makitweb');

    //     // Store QR code for download
    //     // chmod(public_path('storage\qr_code'), 0777);
    //     // $nomor_pendaftaran = $pendaftar['no_pendaftaran'];
    //     // dd($nomor_pendaftaran);
    //     // QrCode::generate('Welcome to Makitweb', public_path('storage\qr_code\213a.svg'));

    //     // dd($data_daya_tampung);
    //     $pdf = DomPDFPDF::loadView(
    //         'livewire.siswa.cetak.cetak-pendaftaran-afirmasi',
    //         [
    //             'pendaftaran' => $pendaftar,
    //             'user' => $user
    //         ]
    //     )
    //         ->setPaper('a4', 'potrait')
    //         ->output();

    //     return response()->streamDownload(function () use ($pdf) {
    //         echo $pdf;
    //     }, 'Kartu Pendaftaran - .pdf');
    // }

    public function cetak($id)
    {
        // get PendaftaraM where jalur zonasi dan siswa id
        $pendaftar = PendaftarM::where('jalur', 'afirmasi')
            ->where('siswa_id', Auth::user()->id)
            ->first();

        $user = User::where('id', Auth::user()->id)->select('pendukung_jarak')->first();

        $nomor_pendaftaran = $pendaftar['no_pendaftaran'];
        // dd($nomor_pendaftaran);
        QrCode::generate($nomor_pendaftaran, public_path('storage\qr_code\ ' . $nomor_pendaftaran . '.svg'));

        // dd($data_daya_tampung);
        $pdf = DomPDFPDF::loadView(
            'livewire.siswa.cetak.cetak-pendaftaran-afirmasi',
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

    public function qrcode()
    {
        $data['qrcode'] = QrCode::generate('Welcome to Makitweb');

        // Store QR code for download
        QrCode::generate('Welcome to Makitweb', public_path('storage\test_doang\qrcode.svg'));

        return view('livewire.siswa.afirmasi.cetakqr', $data);
        // return view('index', $data);
    }
}
