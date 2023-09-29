<?php

namespace App\Http\Livewire\Admin\Afirmasi;

use App\Models\Admin\Afirmasi;
use Livewire\Component;
use App\Models\Admin\Pendaftar as PendaftarM;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class Pendaftar extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $dataId, $dataEdit = null, $area_sekolah = [] ,$search;
    public $surat_pengantar_sd, $sk_bta, $pkh_kip, $file;

    public function render()
    {
        if($this->search != null){
            $pendaftar = PendaftarM::join('users', 'users.id', '=', 'pendaftaran.siswa_id')
            ->join('users_detail', 'users_detail.user_id', '=', 'users.id')
            ->join('sekolah', 'sekolah.id', '=', 'pendaftaran.sekolah_id')
            ->join('sekolah as sekolah_asal', 'sekolah_asal.id', '=', 'users.sekolah_id')
            ->select('pendaftaran.id', 'pendaftaran.no_pendaftaran', 'pendaftaran.status', 'pendaftaran.jalur', 'pendaftaran.tanggal_daftar', 'pendaftaran.sekolah_id', 'pendaftaran.siswa_id', 'pendaftaran.created_at', 'pendaftaran.updated_at', 'users.id as id_siswa', 'users_detail.nama_lengkap', 'users_detail.jenis_kelamin', 'users_detail.tempat_lahir', 'users_detail.tanggal_lahir', 'users_detail.agama', 'users_detail.alamat', 'users_detail.no_hp', 'users_detail.foto', 'sekolah.id as id_sekolah', 'sekolah.nama_sekolah','sekolah_asal.nama_sekolah as sekolah_asal')
            ->where('pendaftaran.jalur', 'afirmasi')
            ->where('users_detail.nama_lengkap', 'like', '%'.$this->search.'%')
            ->where('pendaftaran.status', 'menunggu')
            ->where('pendaftaran.sekolah_id', Auth::user()->sekolah_id)
            ->paginate(10);
        }else{
            $pendaftar = PendaftarM::join('users', 'users.id', '=', 'pendaftaran.siswa_id')
            ->join('users_detail', 'users_detail.user_id', '=', 'users.id')
            ->join('sekolah', 'sekolah.id', '=', 'pendaftaran.sekolah_id')
            ->join('sekolah as sekolah_asal', 'sekolah_asal.id', '=', 'users.sekolah_id')
            ->select('pendaftaran.id', 'pendaftaran.no_pendaftaran', 'pendaftaran.status', 'pendaftaran.jalur', 'pendaftaran.tanggal_daftar', 'pendaftaran.sekolah_id', 'pendaftaran.siswa_id', 'pendaftaran.created_at', 'pendaftaran.updated_at', 'users.id as id_siswa', 'users_detail.nama_lengkap', 'users_detail.jenis_kelamin', 'users_detail.tempat_lahir', 'users_detail.tanggal_lahir', 'users_detail.agama', 'users_detail.alamat', 'users_detail.no_hp', 'users_detail.foto', 'sekolah.id as id_sekolah', 'sekolah.nama_sekolah','sekolah_asal.nama_sekolah as sekolah_asal',)
            ->where('pendaftaran.jalur', 'afirmasi')
            ->where('pendaftaran.status', 'menunggu')
            ->where('pendaftaran.sekolah_id', Auth::user()->sekolah_id)
            ->paginate(10);
        }


        // dd($pendaftar);
        return view('livewire.admin.afirmasi.pendaftar', ['data_afirmasi' => $pendaftar]);
    }

    public function dataId($id)
    {
        $this->dataId = $id;
    }

    public function dataEdit($id)
    {
        $this->dataEdit = $id;
        // $data_pendaftaran = PendaftarM::find($id);
        // $this->surat_pengantar_sd = $data_pendaftaran->surat_pengantar_sd;
        // $this->sk_bta = $data_pendaftaran->sk_bta;
        // $this->pkh_kip = $data_pendaftaran->pkh_kip;
        // $this->file = $data_pendaftaran->file;
    }

    // delete
    public function hapuspendaftaran()
    {
        $data = PendaftarM::where('id', $this->dataEdit);
        $data->delete();

        $data_atribut = Afirmasi::where('pendaftaran_id', $data->id)->first();
        $data_atribut->delete();

        $this->emit('closeModal');
        $this->showToastr('success', 'Data Berhasil Dihapus', 'Berhasil');

    }

    // make verifikasi diterima afirmasi
    public function verifikasi()
    {
        // dd($id);
        $afirmasi = PendaftarM::find($this->dataId);
        $afirmasi->status = 'diverifikasi';
        $afirmasi->save();
        session()->flash('success', 'Pendaftaran Diverifikasi');
        return redirect()->route('admin.afirmasi.index');
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

    // make verifikasi diterima afirmasi
    public function verifikasiDitolak()
    {
        $afirmasi = PendaftarM::find($this->dataId);
        $afirmasi->status = 'ditolak';
        $afirmasi->save();
        session()->flash('success', 'Pendaftaran Ditolak');
        return redirect()->route('admin.afirmasi.index');
    }
}
