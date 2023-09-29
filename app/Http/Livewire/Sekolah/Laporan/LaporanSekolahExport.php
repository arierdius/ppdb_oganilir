<?php

namespace App\Http\Livewire\Sekolah\Laporan;

use Livewire\Component;
use App\Models\Admin\DayaTampung;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin\Pendaftar as LivewirePendaftar;
use App\Models\Admin\PorsiSiswa;
use illuminate\contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class LaporanSekolahExport implements FromView
{
    public $data_jalur, $jenis_data;


    public function view(): View
    {
        $tarikan = 'seluruh';
        $arrData = [
            'data_jalur' => $tarikan,
        ];

        // jika seluruh
        if ($tarikan == 'seluruh') {
            $jenis_tarikan = 'seluruh';

            $porsi_siswa = PorsiSiswa::where('jenis_sekolah_id', auth()->user()->sekolah->jenis_sekolah_id)->first();

            $daya_tampung = DayaTampung::where('sekolah_id', Auth::user()->sekolah_id)
                ->first();
            // dd($daya_tampung);
            $total_diterima_zonasi = null;
            $data_pendaftar_zonasi = LivewirePendaftar::where('sekolah_id', Auth::user()->sekolah_id)
                ->join('zonasi', 'zonasi.pendaftaran_id', '=', 'pendaftaran.id')
                ->where('jalur', 'zonasi')
                ->where('status', 'diterima')
                ->orderBy('zonasi.jarak', 'asc')
                ->get();
            // dd($data_pendaftar_zonasi);
            $total_diterima_zonasi = count($data_pendaftar_zonasi);
            $data_diterima_zonasi = ($total_diterima_zonasi == 0) ? 0 : $total_diterima_zonasi;
            $daya_tampung_zonasi = $daya_tampung['daya_tampung'];
            $porsi_zonasi = ($data_diterima_zonasi / $daya_tampung_zonasi) * 100;
            // dd(number_format($porsi_zonasi, 2, ',', '.'));

            // dd($data_pendaftar_zonasi);
            // exit;
            $total_diterima_afirmasi = null;
            $data_pendaftar_afirmasi = LivewirePendaftar::where('sekolah_id', Auth::user()->sekolah_id)
                ->join('afirmasi', 'afirmasi.pendaftaran_id', '=', 'pendaftaran.id')
                ->where('jalur', 'afirmasi')
                ->where('status', 'diterima')
                ->orderBy('afirmasi.jarak', 'asc')
                ->get();
            // dd($data_pendaftar_afirmasi);

            $total_diterima_afirmasi = count($data_pendaftar_afirmasi);
            $data_diterima_afirmasi = ($total_diterima_afirmasi == 0) ? 0 : $total_diterima_afirmasi;
            $daya_tampung_afirmasi = $daya_tampung['daya_tampung'];
            $porsi_afirmasi = ($data_diterima_afirmasi / $daya_tampung_afirmasi) * 100;
            // dd(number_format($porsi_afirmasi, 2, ',', '.'));

            $total_diterima_mutasi = null;
            $data_pendaftar_mutasi = LivewirePendaftar::where('sekolah_id', Auth::user()->sekolah_id)
                ->join('mutasi', 'mutasi.pendaftaran_id', '=', 'pendaftaran.id')
                ->where('jalur', 'mutasi')
                ->where('status', 'diterima')
                ->orderBy('mutasi.jarak', 'asc')
                ->get();

            // dd($data_pendaftar_mutasi);

            $total_diterima_mutasi = count($data_pendaftar_mutasi);
            $data_diterima_mutasi = ($total_diterima_mutasi == 0) ? 0 : $total_diterima_mutasi;
            $daya_tampung_mutasi = $daya_tampung['daya_tampung'];
            $porsi_mutasi = ($data_diterima_mutasi / $daya_tampung_mutasi) * 100;
            // dd(number_format($porsi_mutasi, 2, ',', '.'));

            $data_pendaftar_prestasi = LivewirePendaftar::where('sekolah_id', Auth::user()->sekolah_id)
                ->join('prestasi', 'prestasi.pendaftaran_id', '=', 'pendaftaran.id')
                ->where('jalur', 'prestasi')
                ->where('status', 'diterima')
                ->orderBy('prestasi.jarak', 'asc')
                ->get();

            $total_diterima_prestasi = count($data_pendaftar_prestasi);
            $data_diterima_prestasi = ($total_diterima_prestasi == 0) ? 0 : $total_diterima_prestasi;
            $daya_tampung_prestasi = $daya_tampung['daya_tampung'];
            $porsi_prestasi = ($data_diterima_prestasi / $daya_tampung_prestasi) * 100;
            // dd(number_format($porsi_prestasi, 2, ',', '.'));


            $data_daya_tampung = [
                'porsi_afirmasi' => number_format($porsi_afirmasi, 2, ',', '.'),
                'porsi_zonasi' => number_format($porsi_zonasi, 2, ',', '.'),
                'porsi_mutasi' => number_format($porsi_mutasi, 2, ',', '.'),
                'porsi_prestasi' => number_format($porsi_prestasi, 2, ',', '.'),
            ];

            // jika seluruh
            $atribut_jalur = [
                'total_zonasi' => $total_diterima_zonasi,
                'total_afirmasi' => $total_diterima_afirmasi,
                'total_mutasi' => $total_diterima_mutasi,
                'total_prestasi' => $total_diterima_prestasi,
            ];
        }

        return view(
            'livewire.sekolah.laporan.laporan-sekolah-export',
            [
                'jenis_tarikan' => $jenis_tarikan,
                'data_pendaftar_zonasi' => $data_pendaftar_zonasi,
                'data_pendaftar_afirmasi' => $data_pendaftar_afirmasi,
                'data_pendaftar_mutasi' => $data_pendaftar_mutasi,
                'data_pendaftar_prestasi' => $data_pendaftar_prestasi,
                'arrdata' => $arrData,
                'data_daya_tampung' => $data_daya_tampung,
                'atribut_jalur' => $atribut_jalur,
            ]
        );
    }
}
