<?php

namespace App\Http\Livewire\Admin\Prestasi;

use App\Models\Admin\Pendaftar as PendaftarM;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;
use Livewire\Component;

class Verifikasi extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $dataId,$search;
    public function render()
    {
        if($this->search != null){
        $pendaftar = PendaftarM::join('users', 'users.id', '=', 'pendaftaran.siswa_id')
            ->join('users_detail', 'users_detail.user_id', '=', 'users.id')
            ->join('sekolah', 'sekolah.id', '=', 'pendaftaran.sekolah_id')
            ->join('sekolah as sekolah_asal', 'sekolah_asal.id', '=', 'users.sekolah_id')
            ->join('prestasi', 'prestasi.pendaftaran_id', '=', 'pendaftaran.id')
            ->select('pendaftaran.id', 'pendaftaran.no_pendaftaran', 'pendaftaran.status', 'pendaftaran.jalur', 'pendaftaran.tanggal_daftar', 'pendaftaran.sekolah_id', 'pendaftaran.siswa_id', 'pendaftaran.created_at', 'pendaftaran.updated_at', 'users.id as id_siswa', 'users_detail.nama_lengkap', 'users_detail.jenis_kelamin', 'users_detail.tempat_lahir', 'users_detail.tanggal_lahir', 'users_detail.agama', 'users_detail.alamat', 'users_detail.no_hp', 'users_detail.foto', 'sekolah.id as id_sekolah', 'sekolah.nama_sekolah', 'sekolah_asal.nama_sekolah as sekolah_asal')
            ->where('pendaftaran.jalur', 'prestasi')
            // order by prestasi.total_nilai_akademik
            ->orderBy('prestasi.total_nilai_akademik', 'desc')
            ->where('pendaftaran.status', 'diverifikasi')
            ->where('users_detail.nama_lengkap', 'like', '%'.$this->search.'%')
            ->where('pendaftaran.sekolah_id', Auth::user()->sekolah_id)
            ->paginate(10);
        }else{
            $pendaftar = PendaftarM::join('users', 'users.id', '=', 'pendaftaran.siswa_id')
            ->join('users_detail', 'users_detail.user_id', '=', 'users.id')
            ->join('sekolah', 'sekolah.id', '=', 'pendaftaran.sekolah_id')
            ->join('sekolah as sekolah_asal', 'sekolah_asal.id', '=', 'users.sekolah_id')
            ->join('prestasi', 'prestasi.pendaftaran_id', '=', 'pendaftaran.id')
            ->select('pendaftaran.id', 'pendaftaran.no_pendaftaran', 'pendaftaran.status', 'pendaftaran.jalur', 'pendaftaran.tanggal_daftar', 'pendaftaran.sekolah_id', 'pendaftaran.siswa_id', 'pendaftaran.created_at', 'pendaftaran.updated_at', 'users.id as id_siswa', 'users_detail.nama_lengkap', 'users_detail.jenis_kelamin', 'users_detail.tempat_lahir', 'users_detail.tanggal_lahir', 'users_detail.agama', 'users_detail.alamat', 'users_detail.no_hp', 'users_detail.foto', 'sekolah.id as id_sekolah', 'sekolah.nama_sekolah', 'sekolah_asal.nama_sekolah as sekolah_asal')
            ->where('pendaftaran.jalur', 'prestasi')
            // order by prestasi.total_nilai_akademik
            ->orderBy('prestasi.total_nilai_akademik', 'desc')
            ->where('pendaftaran.status', 'diverifikasi')
            ->where('pendaftaran.sekolah_id', Auth::user()->sekolah_id)
            ->paginate(10);
        }
        // dd($pendaftar);

        return view('livewire.admin.prestasi.verifikasi', [
            'data_prestasi' => $pendaftar
        ]);
    }

    public function showToastr($icon, $text, $title)
    {
        $this->emit('swal:alert', [
            'icon' => $icon,
            'title' => $title,
            'text' => $text,
            'timeout'   => 1000
        ]);
    }

    public function dataId($id)
    {
        $this->dataId = $id;
    }

    // make verifikasi diterima prestasi
    public function verifikasiDiterima()
    {
        $prestasi = PendaftarM::find($this->dataId);
        $prestasi->status = 'diterima';
        $prestasi->save();
        session()->flash('success', 'Pendaftaran Diterima');
        return redirect()->route('admin.prestasi.verifikasi.index');
    }

    // make verifikasi diterima prestasi
    public function verifikasiDitolak()
    {
        $prestasi = PendaftarM::find($this->dataId);
        $prestasi->status = 'ditolak';
        $prestasi->save();
        session()->flash('success', 'Pendaftaran Ditolak');
        return redirect()->route('admin.prestasi.verifikasi.index');
    }
}
