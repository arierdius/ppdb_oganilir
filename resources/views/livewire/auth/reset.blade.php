<div>

    <div class="wrap-login100">
        <form wire:submit.prevent="resetPassword()" class="login100-form validate-form">
            <span class="login100-form-logo">
                <img src="{{ asset('assets_umum/images/logo-oi.png') }}" width="100" alt="">
            </span>

            <span class="login100-form-title p-b-34 p-t-27" style="font-weight:700;">
                RESET PASSWORD
            </span>
            {{-- <p class="mb-5 text-dark fw-800 text-center" style="font-weight:700;">Bagi peserta didik yang telah terdaftar, silahkan masuk
                mengunakan akun yang telah di daftarkan.</p> --}}


            <div class="wrap-input100 validate-input" data-validate="Enter username">
                <input class="input100" wire:model="email" type="text" placeholder="NIK">
                <span class="focus-input100" data-placeholder="NIK"></span>
            </div>

            <div class="wrap-input100 validate-input mb-0" data-validate="Enter No WhatsApp">
                <input class="input100" type="number" wire:model="no_hp" placeholder="No WhatsApp" id="myInput">
                <span class="focus-input100" data-placeholder="No WhatsApp"></span>
            </div>

            {{$respons}}
            <div class="container-login100-form-btn mt-3">
                <button class="login100-form-btn">
                    Reset Password
                </button>
            </div>
            <div class="footer-log">
                <!-- <div class="text-center mt-2">
                <a class="txt1" href="#">
                    Forgot Password?
                </a>
            </div> -->
                <div class="text-center mt-3">
                    <p>Silahkan Login! <a href="{{ route('auth.login.index') }}" class="linked">Masuk di sini</a></p>
                    </p>
                </div>
            </div>
        </form>
    </div>
</div>

