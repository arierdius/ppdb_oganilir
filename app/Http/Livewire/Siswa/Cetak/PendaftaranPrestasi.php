<?php

namespace App\Http\Livewire\Siswa\Cetak;

use App\Models\Admin\Pendaftar;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PendaftaranPrestasi extends Component
{
    public $id_siswa;
    public function render()
    {

        // dd($_GET['id_siswa']);
        if (isset($_GET['id_siswa'])) {
            $pendaftar = Pendaftar::where('jalur', 'prestasi')
                ->where('siswa_id', $_GET['id_siswa'])
                ->first();
        } else {
            $pendaftar = Pendaftar::where('jalur', 'prestasi')
                ->where('siswa_id', Auth::user()->id)
                ->first();
        }


        return view('livewire.siswa.cetak.pendaftaran-prestasi', [
            'pendaftaran' => $pendaftar
        ]);
    }

}
