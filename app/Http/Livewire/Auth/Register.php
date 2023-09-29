<?php

namespace App\Http\Livewire\Auth;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Register extends Component
{
    public $email, $password, $show_message, $status_pendaftaran;

    // make render
    public function render()
    {
        // get data from user where email
        if ($this->email != null) {
            $user = User::where('email', $this->email)->first();
            // jika user kosong maka validasi username bisa digunakan
            if (!empty($user)) {
                $this->show_message = 'username telah digunakan';
            } else {
                $this->show_message = 'username bisa digunakan';
            }
        }
        return view('livewire.auth.register')->layout('layouts.login');
    }

    // store
    public function store()
    {
        $validasi = $this->validate(
            [
                'email' => 'required',
                'password' => 'required',
            ],
            [
                'email.required' => 'Nik tidak boleh kosong',
                'password.required' => 'Password tidak boleh kosong',
            ]
        );

        // jika email sudah ada maka kasih pesan error
        if (User::where('email', $this->email)->first()) {
            $validasi_username = 'username telah digunakan';
        } else {
            $validasi_username = 'username bisa digunakan';
        }

        // jika validasi username bisa digunakan maka buat akun
        if ($validasi_username == 'username bisa digunakan') {
            $user = new User();
            $user->email = $this->email;
            $user->password = bcrypt($this->password);
            $user->role_id = 2;
            $user->save();

            // jika berhasil buat akun maka langsung login
            // if ($user) {
            // Auth::login($user);
            $this->status_pendaftaran = '1';

            // session()->flash('success', 'Pendaftaran berhasil Silahkan Login!');
            // return redirect()->route('auth.register.index');
            // }
        }

    }
}
