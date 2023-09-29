<?php

namespace App\Http\Livewire\Siswa\Cetak;

use App\Models\Admin\Pendaftar as PendaftarM;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PendaftaranZonasi extends Component
{
    public function render()
    {
        if (isset($_GET['id_siswa'])) {
            $pendaftar = PendaftarM::where('jalur', 'zonasi')
                ->where('siswa_id', $_GET['id_siswa'])
                ->first();
            $user = User::where('id', $_GET['id_siswa'])->first();
        } else {
            // get PendaftaraM where jalur zonasi dan siswa id
            $pendaftar = PendaftarM::where('jalur', 'zonasi')
                ->where('siswa_id', Auth::user()->id)
                ->first();

            $user = User::where('id', Auth::user()->id)->select('pendukung_jarak')->first();
        }

        return view('livewire.siswa.cetak.pendaftaran-zonasi', [
            'pendaftaran' => $pendaftar,
            'user' => $user
        ]);
    }


}
