<?php

namespace App\Http\Livewire\Siswa\Cetak;

use App\Models\Admin\Pendaftar;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Barryvdh\DomPDF\Facade\Pdf as DomPDFPDF;
use App\Models\Admin\Pendaftar as PendaftarM;

class PendaftaranAfirmasi extends Component
{
    public function render()
    {
        if (isset($_GET['id_siswa'])) {
            $pendaftar = Pendaftar::where('jalur', 'afirmasi')
                ->where('siswa_id', $_GET['id_siswa'])
                ->first();
        } else {
            $pendaftar = Pendaftar::where('jalur', 'afirmasi')
                ->where('siswa_id', Auth::user()->id)
                ->first();
        }

        return view('livewire.siswa.cetak.pendaftaran-afirmasi', [
            'pendaftaran' => $pendaftar
        ]);
    }

    public function cetak($id)
    {
        // get PendaftaraM where jalur zonasi dan siswa id
        $pendaftar = PendaftarM::where('jalur', 'afirmasi')
            ->where('siswa_id', Auth::user()->id)
            ->first();

        $user = User::where('id', Auth::user()->id)->select('pendukung_jarak')->first();


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
}
