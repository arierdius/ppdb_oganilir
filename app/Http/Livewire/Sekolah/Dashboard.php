<?php

namespace App\Http\Livewire\Sekolah;

use Illuminate\Support\Facades\Auth;
use App\Models\Admin\Pendaftar;
use App\Models\Admin\Pengumuman;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {

        // get data pendaftaran
        $data_zonasi_diterima = Pendaftar::where('sekolah_id', Auth::user()->sekolah->id)
            ->where('jalur', 'zonasi')
            ->where('status', 'diterima')
            ->get();

        $data_prestasi_diterima = Pendaftar::where('sekolah_id', Auth::user()->sekolah->id)
            ->where('jalur', 'prestasi')
            ->where('status', 'diterima')
            ->get();

        $data_afirmasi_diterima = Pendaftar::where('sekolah_id', Auth::user()->sekolah->id)
            ->where('jalur', 'afirmasi')
            ->where('status', 'diterima')
            ->get();

        $data_mutas_diterima = Pendaftar::where('sekolah_id', Auth::user()->sekolah->id)
            ->where('jalur', 'mutasi')
            ->where('status', 'diterima')
            ->get();

        $total_pendaftar = Pendaftar::where('sekolah_id', Auth::user()->sekolah->id)->get();

        // get pengumuman
        $pengumuman = Pengumuman::where('status', 'aktif')->get();
        // dd($pengumuman);


        return view('livewire.sekolah.dashboard', [
            'data_zonasi_diterima' => $data_zonasi_diterima,
            'data_prestasi_diterima' => $data_prestasi_diterima,
            'data_afirmasi_diterima' => $data_afirmasi_diterima,
            'data_mutasi_diterima' => $data_mutas_diterima,
            'total_pendaftar' => $total_pendaftar,
            'pengumuman' => $pengumuman
        ]);
    }
}
