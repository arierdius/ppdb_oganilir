<?php

namespace App\Http\Livewire\Admin\Zonasi;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Admin\Pendaftar as PendaftarM;

class Verifikasi extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $dataId,$search;

    public function render()
    {
        // get data Pendaftar where jalur zonasi relasi to zonasi where status menunggu
        if($this->search != null){
            $zonasi = PendaftarM::join('zonasi', 'zonasi.pendaftaran_id', '=', 'pendaftaran.id')
            ->join('sekolah', 'sekolah.id', '=', 'pendaftaran.sekolah_id')
            ->join('users', 'users.id', '=', 'pendaftaran.siswa_id')
            ->join('sekolah as sekolah_asal', 'sekolah_asal.id', '=', 'users.sekolah_id')
            ->join('users_detail', 'users_detail.user_id', '=', 'users.id')
            ->select('pendaftaran.no_pendaftaran', 'pendaftaran.id as id_pendaftaran','pendaftaran.status','pendaftaran.jalur', 'pendaftaran.tanggal_daftar'
            ,'zonasi.id as id_zonasi','zonasi.jarak','zonasi.latitude_siswa','zonasi.longitude_siswa'
            ,'sekolah.id as id_sekolah','sekolah.nama_sekolah','sekolah.latitude','sekolah.jenis_sekolah_id','sekolah.latitude','sekolah.longitude'
            ,'users.id as id_siswa','sekolah_asal.nama_sekolah as sekolah_asal',
            'users_detail.nama_lengkap','users_detail.jenis_kelamin','users_detail.tempat_lahir','users_detail.tanggal_lahir','users_detail.agama','users_detail.alamat','users_detail.no_hp','users_detail.foto')
            ->where('pendaftaran.sekolah_id', auth()->user()->sekolah_id)
            ->where('pendaftaran.status', 'diverifikasi')
            ->where('users_detail.nama_lengkap', 'like', '%'.$this->search.'%')
            ->where('pendaftaran.jalur', 'zonasi')
            ->orderBy('zonasi.jarak', 'asc')
            ->paginate(10);
        }else{
            $zonasi = PendaftarM::join('zonasi', 'zonasi.pendaftaran_id', '=', 'pendaftaran.id')
            ->join('sekolah', 'sekolah.id', '=', 'pendaftaran.sekolah_id')
            ->join('users', 'users.id', '=', 'pendaftaran.siswa_id')
            ->join('sekolah as sekolah_asal', 'sekolah_asal.id', '=', 'users.sekolah_id')
            ->join('users_detail', 'users_detail.user_id', '=', 'users.id')
            ->select('pendaftaran.no_pendaftaran', 'pendaftaran.id as id_pendaftaran','pendaftaran.status','pendaftaran.jalur', 'pendaftaran.tanggal_daftar'
            ,'zonasi.id as id_zonasi','zonasi.jarak','zonasi.latitude_siswa','zonasi.longitude_siswa'
            ,'sekolah.id as id_sekolah','sekolah.nama_sekolah','sekolah.latitude','sekolah.jenis_sekolah_id','sekolah.latitude','sekolah.longitude'
            ,'users.id as id_siswa','sekolah_asal.nama_sekolah as sekolah_asal',
            'users_detail.nama_lengkap','users_detail.jenis_kelamin','users_detail.tempat_lahir','users_detail.tanggal_lahir','users_detail.agama','users_detail.alamat','users_detail.no_hp','users_detail.foto')
            ->where('pendaftaran.sekolah_id', auth()->user()->sekolah_id)
            ->where('pendaftaran.status', 'diverifikasi')
            ->where('pendaftaran.jalur', 'zonasi')
            ->orderBy('zonasi.jarak', 'asc')
            ->paginate(10);
        }


        // dd($zonasi);

        return view(
            'livewire.admin.zonasi.verifikasi',['data_zonasi' => $zonasi]
        );
    }

    public function dataId($id)
    {
        $this->dataId = $id;
    }

    // make verifikasi diterima zonasi
    public function verifikasiDiterima()
    {
        $zonasi = PendaftarM::find($this->dataId);
        $zonasi->status = 'diterima';
        $zonasi->save();
        session()->flash('success', 'Pendaftaran Diterima');
        return redirect()->route('admin.zonasi.verifikasi.index');
    }

    // make verifikasi diterima zonasi
    public function verifikasiDitolak()
    {
        $zonasi = PendaftarM::find($this->dataId);
        $zonasi->status = 'ditolak';
        $zonasi->save();
        session()->flash('success', 'Pendaftaran Ditolak');
        return redirect()->route('admin.zonasi.verifikasi.index');
    }

}
