<?php

namespace App\Http\Livewire\Admin\Mutasi;

use Livewire\Component;
use App\Models\Admin\DayaTampung;
use App\Models\Admin\Pendaftar as PendaftarM;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class Lulus extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $dataId,$search,$jenis_verifikasi;
    public function render()
    {
        // get data Pendaftar where jalur zonasi relasi to zonasi where status menunggu
        if($this->search != null){
            $pendaftar = PendaftarM::join('users', 'users.id', '=', 'pendaftaran.siswa_id')
            ->join('users_detail', 'users_detail.user_id', '=', 'users.id')
            ->join('sekolah', 'sekolah.id', '=', 'pendaftaran.sekolah_id')
            ->select('pendaftaran.id', 'pendaftaran.no_pendaftaran', 'pendaftaran.status', 'pendaftaran.jalur', 'pendaftaran.tanggal_daftar', 'pendaftaran.sekolah_id', 'pendaftaran.siswa_id', 'pendaftaran.created_at', 'pendaftaran.updated_at', 'users.id as id_siswa', 'users_detail.nama_lengkap', 'users_detail.jenis_kelamin', 'users_detail.tempat_lahir', 'users_detail.tanggal_lahir', 'users_detail.agama', 'users_detail.alamat', 'users_detail.no_hp', 'users_detail.foto', 'sekolah.id as id_sekolah', 'sekolah.nama_sekolah')
            ->where('pendaftaran.jalur', 'mutasi')
            ->where('pendaftaran.status', 'diterima')
            ->where('users_detail.nama_lengkap', 'like', '%'.$this->search.'%')
            ->where('pendaftaran.sekolah_id', Auth::user()->sekolah_id)
            ->paginate(10);
        }else{
            $pendaftar = PendaftarM::join('users', 'users.id', '=', 'pendaftaran.siswa_id')
            ->join('users_detail', 'users_detail.user_id', '=', 'users.id')
            ->join('sekolah', 'sekolah.id', '=', 'pendaftaran.sekolah_id')
            ->select('pendaftaran.id', 'pendaftaran.no_pendaftaran', 'pendaftaran.status', 'pendaftaran.jalur', 'pendaftaran.tanggal_daftar', 'pendaftaran.sekolah_id', 'pendaftaran.siswa_id', 'pendaftaran.created_at', 'pendaftaran.updated_at', 'users.id as id_siswa', 'users_detail.nama_lengkap', 'users_detail.jenis_kelamin', 'users_detail.tempat_lahir', 'users_detail.tanggal_lahir', 'users_detail.agama', 'users_detail.alamat', 'users_detail.no_hp', 'users_detail.foto', 'sekolah.id as id_sekolah', 'sekolah.nama_sekolah')
            ->where('pendaftaran.jalur', 'mutasi')
            ->where('pendaftaran.status', 'diterima')
            ->where('pendaftaran.sekolah_id', Auth::user()->sekolah_id)
            ->paginate(10);
        }

        // get data from daya tampung
        $daya_tampung = DayaTampung::where('sekolah_id', auth()->user()->sekolah_id)->first();

        return view('livewire.admin.mutasi.lulus', ['data_mutasi' => $pendaftar, 'daya_tampung' => $daya_tampung]);
    }


    public function dataId($id)
    {
        $this->dataId = $id;
    }

    // return menunggu
    public function returnVerifikasi()
    {
        $validasi = $this->validate([
            'jenis_verifikasi' => 'required',
        ],[
            'jenis_verifikasi.required' => 'Pilih salah satu',
        ]);
        $zonasi = PendaftarM::find($this->dataId);
        $zonasi->status = $this->jenis_verifikasi;
        $zonasi->save();
        session()->flash('success', 'Pendaftaran di kembalikan ke fase verifikasi');
        return redirect()->route('admin.prestasi.lulus.index');
    }

    // return menunggu
    public function returnMenunggu($id)
    {
        $zonasi = PendaftarM::find($id);
        $zonasi->status = 'diverifikasi';
        $zonasi->save();
        session()->flash('success', 'Pendaftaran di kembalikan ke menunggu');
        return redirect()->route('admin.zonasi.lulus.index');
    }
}
