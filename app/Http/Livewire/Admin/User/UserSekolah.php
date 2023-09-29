<?php

namespace App\Http\Livewire\Admin\User;

use App\Models\Admin\Sekolah;
use Livewire\Component;
use App\Models\User;
use App\Models\Users_detail;
use Illuminate\Support\Facades\Hash;
use Livewire\WithPagination;

class UserSekolah extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $dataId, $search;


    public function render()
    {
        //get data user
        // search
        if ($this->search != null) {
            $users = User::where('role_id', '1')
                ->where('name', 'like', '%' . $this->search . '%')
                ->paginate(10);
        } else {
            $users = User::where('role_id', '1')->paginate(10);
        }

        return view('livewire.admin.user.user-sekolah', ['users' => $users]);
    }

    public function dataId($id)
    {
        $this->dataId = $id;
    }

    public function update($id)
    {
        $user = User::find($id);
        $data_nama_sekolah = $user->sekolah->nama_sekolah;
        // replace chart nama sekolah
        $nama_sekolah_temp = str_replace(' ', '', $data_nama_sekolah);
        $nama_sekolah = strtolower($nama_sekolah_temp);
        $user->password = Hash::make($nama_sekolah);
        $user->save();
        session()->flash('success', 'Password User Sekolah di Reset');
        return redirect()->route('sekolah.user.index');
    }

    public function delete()
    {
        $user = User::find($this->dataId);
        $user->delete();
        session()->flash('success', 'User Sekolah di Hapus');
        return redirect()->route('sekolah.user.index');
    }

    // create user createUser
    public function createUser()
    {

        $user = Sekolah::where('jenis_sekolah_id', '3')
            ->where('status_sekolah', 'negeri')
            ->get();

        // dd($user);
        foreach ($user as $key) {
            $nama_sekolah_temp = str_replace(' ', '', $key->nama_sekolah);
            $nama_sekolah = strtolower($nama_sekolah_temp);
            $user_password = bcrypt($nama_sekolah);
            // echo $user_password . '<br>';

            // echo $key->nama_sekolah . '<br>';
            $user = new User();
            $user->sekolah_id = $key->id;
            $user->diknas_id = '1';
            $user->name = $key->nama_sekolah;
            $user->email = $nama_sekolah;
            $user->password = $user_password;
            $user->role_id = '1';
            $user->save();

            // dd($user->name, $user->email, $user->password, $user->role_id);

            $user_detail = new Users_detail();
            $user_detail->user_id = $user->id;
            $user_detail->nik = '00';
            $user_detail->nama_lengkap = $key->nama_sekolah;
            $user_detail->save();
        }

        session()->flash('success', 'User Sekolah Berhasil di Tambahkan');
        return redirect()->route('sekolah.user.index');
        // $user = Sekolah::where('jenis_sekolah_id', '3')
        //     ->where('status_sekolah', 'swasta')
        //     ->get();
        // dd($user);
        // $user->name = $this->nama;
        // $user->email = $this->email;
        // $user->password = Hash::make($this->password);
        // $user->role_id = '1';
        // $user->save();

        // session()->flash('success', 'User Sekolah Berhasil di Tambahkan');
        // return redirect()->route('sekolah.user.index');
    }
}
