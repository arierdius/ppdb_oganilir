<?php

namespace App\Http\Livewire\Sekolah\DayaTampung;

use Livewire\Component;
use App\Models\Admin\DayaTampung;
use App\Models\Admin\PorsiSiswa;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    public $daya_tampung, $rombel, $sekolah_id, $total_tampungan,$kalkulasi_rombel;

    public function render()
    {
        // get data from daya tampung
        $daya_tampung = DayaTampung::where('sekolah_id', auth()->user()->sekolah_id)->first();

        $porsi_siswa = PorsiSiswa::where('jenis_sekolah_id', auth()->user()->sekolah->jenis_sekolah_id)->first();
        if ($this->rombel == null) {
            $this->rombel = null;
        }
        $kalkulasi_rombel = $this->rombel * 32;
        // jika daya tampung lebih besar dari kalkulasi rombel maka tidak bisa

        if ($this->daya_tampung > $kalkulasi_rombel) {
            $this->total_tampungan = 'disabled';
        } else {
            $this->total_tampungan = '';
        }

        // dd($porsi_siswa);
        return view('livewire.sekolah.daya-tampung.index', [
            'daya_tampung' => $daya_tampung,
            'porsi_siswa' => $porsi_siswa
        ]);
    }

    // mount data from daya tampung
    public function mount()
    {
        $daya_tampung = DayaTampung::where('sekolah_id', auth()->user()->sekolah_id)->first();
        if ($daya_tampung == null) {
            $daya_tampung = new DayaTampung();
            $daya_tampung->sekolah_id = auth()->user()->sekolah_id;
            $daya_tampung->rombel = 0;
            $daya_tampung->daya_tampung = 0;
            $daya_tampung->save();
        }else{
            $this->sekolah_id = Auth::user()->sekolah_id;
            $this->rombel = $daya_tampung->rombel;
            $this->daya_tampung = $daya_tampung->daya_tampung;
        }
    }

    public function update()
    {
        $this->validate([
            'rombel' => 'required',
            'daya_tampung' => 'required',
        ]);

        $daya_tampung = DayaTampung::where('sekolah_id', auth()->user()->sekolah_id)->first();
        $daya_tampung->rombel = $this->rombel;
        $daya_tampung->daya_tampung = $this->daya_tampung;
        $daya_tampung->save();

        session()->flash('success', 'Data berhasil diperbarui !');
        return redirect()->route('sekolah.daya_tampung.index');
    }
}
