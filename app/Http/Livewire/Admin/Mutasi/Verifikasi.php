<?php

namespace App\Http\Livewire\Admin\Mutasi;

use Livewire\Component;
use App\Models\Admin\Pendaftar as PendaftarM;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class Verifikasi extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $dataId,$search;
    public function render()
    {
        if ($this->search != null) {
        $pendaftar = PendaftarM::join('users', 'users.id', '=', 'pendaftaran.siswa_id')
            ->join('users_detail', 'users_detail.user_id', '=', 'users.id')
            ->join('sekolah', 'sekolah.id', '=', 'pendaftaran.sekolah_id')
            ->select('pendaftaran.id', 'pendaftaran.no_pendaftaran', 'pendaftaran.status', 'pendaftaran.jalur', 'pendaftaran.tanggal_daftar', 'pendaftaran.sekolah_id', 'pendaftaran.siswa_id', 'pendaftaran.created_at', 'pendaftaran.updated_at', 'users.id as id_siswa', 'users_detail.nama_lengkap', 'users_detail.jenis_kelamin', 'users_detail.tempat_lahir', 'users_detail.tanggal_lahir', 'users_detail.agama', 'users_detail.alamat', 'users_detail.no_hp', 'users_detail.foto', 'sekolah.id as id_sekolah', 'sekolah.nama_sekolah')
            ->where('pendaftaran.jalur', 'mutasi')
            ->where('pendaftaran.status', 'diverifikasi')
            ->where('users_detail.nama_lengkap', 'like', '%' . $this->search . '%')
            ->where('pendaftaran.sekolah_id', Auth::user()->sekolah_id)
            ->paginate(10);
        }else{
            $pendaftar = PendaftarM::join('users', 'users.id', '=', 'pendaftaran.siswa_id')
            ->join('users_detail', 'users_detail.user_id', '=', 'users.id')
            ->join('sekolah', 'sekolah.id', '=', 'pendaftaran.sekolah_id')
            ->select('pendaftaran.id', 'pendaftaran.no_pendaftaran', 'pendaftaran.status', 'pendaftaran.jalur', 'pendaftaran.tanggal_daftar', 'pendaftaran.sekolah_id', 'pendaftaran.siswa_id', 'pendaftaran.created_at', 'pendaftaran.updated_at', 'users.id as id_siswa', 'users_detail.nama_lengkap', 'users_detail.jenis_kelamin', 'users_detail.tempat_lahir', 'users_detail.tanggal_lahir', 'users_detail.agama', 'users_detail.alamat', 'users_detail.no_hp', 'users_detail.foto', 'sekolah.id as id_sekolah', 'sekolah.nama_sekolah')
            ->where('pendaftaran.jalur', 'mutasi')
            ->where('pendaftaran.status', 'diverifikasi')
            ->where('pendaftaran.sekolah_id', Auth::user()->sekolah_id)
            ->paginate(10);
        }
        return view('livewire.admin.mutasi.verifikasi',['data_mutasi' => $pendaftar]);
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

    // make verifikasi diterima mutasi
    public function verifikasiDiterima()
    {
        $mutasi = PendaftarM::find($this->dataId);
        $mutasi->status = 'diterima';
        $mutasi->save();
        session()->flash('success', 'Pendaftaran Diterima');
        return redirect()->route('admin.mutasi.verifikasi.index');
    }

    // make verifikasi diterima mutasi
    public function verifikasiDitolak()
    {
        $mutasi = PendaftarM::find($this->dataId);
        $mutasi->status = 'ditolak';
        $mutasi->save();
        session()->flash('success', 'Pendaftaran Ditolak');
        return redirect()->route('admin.mutasi.verifikasi.index');
    }
}
