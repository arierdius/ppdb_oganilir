<?php

namespace App\Http\Livewire\Sekolah\Reset;

use Livewire\Component;
use App\Models\User;
use App\Models\Users_detail;

class Siswa extends Component
{
    public $email, $no_hp, $respons;
    public function render()
    {
        return view('livewire.sekolah.reset.siswa');
    }


    // reset no_hp
    public function resetPassword()
    {
        $this->validate([
            'email' => 'required',
            'no_hp' => 'required',
        ]);

        $token = "y7Tqu!+Jz1P19ZcsH+#T";
        // $target = "082372648810"; // pak ferdy
        // $target = "082377246021"; // mama
        // $target = "081270644470"; // aku
        // $target = "082380778099"; // kak aris

        $user = User::where('email', $this->email)->first();
        // make get user raw
        if ($user) {
            $id = $user->id;
            // get user detail
            $data_user = Users_detail::where('user_id', $id)->where('no_hp', $this->no_hp)->first();
            if($data_user != null){
                $no_hp_terdaftar = $data_user->no_hp;
            }else{
                $no_hp_terdaftar = '';
            }
            if ($no_hp_terdaftar == $this->no_hp) {
                // update password
                $user = User::find($id);

                $password = rand();
                $user_akun = User::where('email', $this->email)->first();
                // dd($user_akun->users_detail->nama_lengkap);
                $user_akun->password = bcrypt($password);
                $user_akun->save();
                $nama_lengkap = $user_akun->users_detail->nama_lengkap;

                $curl = curl_init();

                $data = [
                    'target' => $data_user->no_hp,
                    'message' => "Hallo *$nama_lengkap*,
Password baru anda *$password*
Silahkan login kembali ke aplikasi !!

@PPDB KAB OGAN ILIR 2023/2024"
                ];

                curl_setopt(
                    $curl,
                    CURLOPT_HTTPHEADER,
                    array(
                        "Authorization: $token",
                    )
                );
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
                curl_setopt($curl, CURLOPT_URL, "https://api.fonnte.com/send");
                curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
                $result = curl_exec($curl);
                curl_close($curl);

                // echo $result;
                $this->respons = 'Password Berhasil Di Reset <br> silahkan beritahu kepada siswa untuk mengecek password yang dikirim whatsapp';
            }else{
                $this->respons = 'Nomor Hp Tidak Terdaftar';
            }
        } else {
            $this->respons = 'Nik Tidak Terdaftar';
        }
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
}
