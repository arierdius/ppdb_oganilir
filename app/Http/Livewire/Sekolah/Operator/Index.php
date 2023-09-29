<?php

namespace App\Http\Livewire\Sekolah\Operator;

use Livewire\Component;
use App\Models\User;
use App\Models\Users_detail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $dataId, $search;
    public $nama_lengkap, $nik, $username, $password, $nama_sekolah_input;

    public function render()
    {
        $nama_sekolah_temp = str_replace(' ', '', auth()->user()->sekolah->nama_sekolah);
        $nama_sekolah = strtolower($nama_sekolah_temp);

        $this->nama_sekolah_input = $nama_sekolah;
        $this->username = $this->username;

        $users = User::where('sekolah_id', Auth::user()->sekolah_id)
            ->paginate(10);

        return view('livewire.sekolah.operator.index', ['users' => $users]);
    }

    public function dataId($id)
    {
        $this->dataId = $id;
    }

    // CreateUser
    public function CreateUser()
    {
        $validasi = $this->validate([
            'nama_lengkap' => 'required',
            'nik' => 'required',
            'username' => 'required',
            'password' => 'required',
        ]);

        if ($validasi) {

            $data_nama_sekolah = auth()->user()->sekolah->nama_sekolah;
            $nama_sekolah_temp = str_replace(' ', '', $data_nama_sekolah);
            $nama_sekolah = strtolower($nama_sekolah_temp);
            $new_username = $nama_sekolah.'_'.$this->username;

            $user = new User();
            $user->sekolah_id = Auth::user()->sekolah_id;
            $user->name = $this->nama_lengkap;
            $user->email = $new_username;
            $user->password = bcrypt($this->password);
            $user->role_id = 1;
            $user->created_at = now();
            $user->save();

            $user_detail = new Users_detail();
            $user_detail->user_id = $user->id;
            $user_detail->nama_lengkap = $this->nama_lengkap;
            $user_detail->nik = $this->nik;
            $user_detail->save();
            session()->flash('success', 'User Operator Sekolah Berhasil di Tambahkan');
            return redirect()->route('sekolah.operator.index');
        }
    }

    public function update()
    {
        $user = User::find($this->dataId);
        $data_nama_sekolah = auth()->user()->sekolah->nama_sekolah;
        $nama_sekolah_temp = str_replace(' ', '', $data_nama_sekolah);
        $nama_sekolah = strtolower($nama_sekolah_temp);

        $user->password = Hash::make($nama_sekolah);
        $user->save();
        session()->flash('success', 'Password User Sekolah di Reset');
        return redirect()->route('sekolah.operator.index');
    }


    public function perbaruipassword(){
        // dd($this->dataId);
        // perbarui password bycrypt
        $data_user = User::find($this->dataId);
        $data_user->password = bcrypt($this->password);
        $data_user->save();
        session()->flash('success', 'Password User Sekolah di Reset');
        return redirect()->route('sekolah.operator.index');
    }

}
